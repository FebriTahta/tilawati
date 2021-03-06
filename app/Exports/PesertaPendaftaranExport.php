<?php
 
namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use DateTime;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;


// class PesertaPendaftaranExport implements FromView, ShouldAutoSize, WithColumnFormatting
class PesertaPendaftaranExport implements FromQuery, WithHeadings, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    use Exportable;

    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }

    public function query(){
        return Peserta::query()->where('pelatihan_id', $this->pelatihan_id)
            ->select('name','gelar','alamat','kabupaten_id','kecamatan_id','kelurahan_id','telp','tmptlahir','tgllahir');
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function nama_gelar($str){
        $string = ucwords(strtolower($str));
        $tanda	= array('-',',','.');
        foreach ($tanda as $key => $delimiter) {
            if (strpos($string, $delimiter) !== FALSE) {
                $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
            }
        }
        if
        (      substr($str,0,2) == 'hj' || substr($str,0,2) == 'Hj' || substr($str,0,2) == 'HJ' || substr($str,0,2) == 'hJ' 
            || substr($str,0,2) == 'Dr' || substr($str,0,2) == 'dr' || substr($str,0,2) == 'dR' || substr($str,0,2) == 'DR'
            || substr($str,0,2) == 'Ir' || substr($str,0,2) == 'ir' || substr($str,0,2) == 'iR' || substr($str,0,2) == 'IR'
        )
        {
            return substr($string,0,2).strtoupper(substr($string,2,-5)).substr($string,-5);
        }else{
            return strtoupper(substr($string,0,-5)).substr($string,-5);
        }
    }

    public function map($row): array{
        if ($row->kabupaten !== null) {
            # code...
            $kab = substr($row->kabupaten->nama,5);
        } else {
            # code...
            $kab = '-';
        }

        if ($row->gelar !== null) {
            # code...
            $nama = $row->name.', '.$row->gelar;
        } else {
            # code...
            $nama = $row->name;
        }
        
        
        if ($row->kecamatan !== null) {
            # code...
            $kec = strtoupper($row->kecamatan->nama);
        }else {
            # code...
            $kec = '-';
        }

        if ($row->kelurahan !== null) {
            # code...
            $kel = strtoupper($row->kelurahan->nama);
        }else {
            # code...
            $kel = '-';
        }
        
        if (DateTime::createFromFormat('Y-m-d', $row->tgllahir) !== false) {
            # code...
            $tgl_lahir = Carbon::parse($row->tgllahir)->format('d/M/Y');
        }else{
            $tgl_lahir = $row->tgllahir;
        }

        return [
            
            $nama,
            strtoupper($row->alamat.' '.$kel.' '.$kec),
            // $kel,
            // $kec,
            $kab,
            $row->telp,
            $row->tmptlahir,
            // $row->tgllahir,
            // $tgl_lahir,
            // Carbon::parse($row->tgllahir)->format('d/m/Y')
            // Date::dateTimeToExcel(Carbon::parse($row->tgllahir)),
            $tgl_lahir
        ];
    }

    public function headings(): array{
        return [
            "NAMA",
            "ALAMAT",
            // "KEL",
            // "KEC",
            "KOTA",
            "TELP",
            "TEMPAT LAHIR",
            "TANGGAL LAHIR"
        ];
    }
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
            // 'F' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
