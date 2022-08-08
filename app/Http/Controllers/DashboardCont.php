<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Cabang;
use App\Models\Lembaga;
use App\Models\Trainer;
use App\Models\Peserta;
use App\Models\Kpa;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Response;
use Illuminate\Http\Request;

class DashboardCont extends Controller
{
    public function index()
    {
        $cabang  = Cabang::count();
        $lembaga = Lembaga::count();
        $santri  = Peserta::whereHas('pelatihan',function($query){
            $query->where('keterangan','santri');
        })->count();
        $guru    = Peserta::whereHas('pelatihan',function($query){
            $query->where('keterangan','guru');
        })->count();
        $trainer = Trainer::count();
        $kpa     = Kpa::count();
        $diklat = Pelatihan::orderBy('tanggal','desc')->limit(5)->get();
        $diklat_ini = $diklat->count();
        return view('tilawatipusat.dashboard.index',compact('diklat','diklat_ini','cabang','santri','guru','lembaga','trainer','kpa'));
    }

    public function generate(Request $request){

        $user = User::updateOrCreate([
            'username' => 'test'
        ],
        [
            'username' => 'test',
            'role' => 'pusat',
            'email' => 'admin@admin.com',
            'password' => Hash::make('tester'),
        ]);

        return redirect()->back();
    }

    public function generate_qr_tilawati(Request $request)
    {
        \QrCode::size(150)
        ->format('png') 
        ->generate('https://www.tilawatipusat.com/', public_path('images/tilawati_qr.png'));

            return response()->json(
                [
                  'success' => 'QR Dibuat',
                  'message' => 'QR Dibuat'
                ]
            );
    }

    public function download_qr_tilawati(Request $request)
    {
        $filepath = public_path('images/tilawati_qr.png');
        return Response::download($filepath);
    }

    public function lembaga_formal(Request $request)
    {
        if ($request->ajax()) {
            $formal_tk = Lembaga::where('jenjang','PAUD/KB')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUD')
                    ->orWhere('jenjang','TK-TPA')
                    ->orWhere('jenjang','TK - TPA')
                    ->orWhere('jenjang','TK,MI')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','PG/TK')
                    ->orWhere('jenjang','TK/KB')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUDQU')
                    ->orWhere('jenjang','TK PAUD')
                    ->count();
            $formal_sd = Lembaga::where('jenjang','SD/MI')
                    ->orWhere('jenjang','SD')
                    ->orWhere('jenjang','MI')
                    ->orWhere('jenjang','MI/MTs/MA')
                    ->orWhere('jenjang','MI.')
                    ->orWhere('jenjang','MINU')
                    ->orWhere('jenjang','MIT')
                    ->orWhere('jenjang','SDI')
                    ->orWhere('jenjang','SEKOLAH DASAR ISLAM')
                    ->count();
            $formal_smp = Lembaga::where('jenjang','SMP')
                    ->orWhere('jenjang','SMP/MTs')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMP/SMA')
                    ->orWhere('jenjang','MTSN')
                    ->orWhere('jenjang','MTS')
                    ->orWhere('jenjang','MI/MTS/MA')
                    ->count();
            $formal_sma = Lembaga::where('jenjang','SMA')
                    ->orWhere('jenjang','SMA/MA')
                    ->orWhere('jenjang','SMA IT')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMK')
                    ->count();
            $formal_ptn = Lembaga::where('jenjang','Perguruan Tinggi')
                    ->orWhere('jenjang','Perguruai Tinggi')
                    ->orWhere('jenjang','PT')
                    ->orWhere('jenjang','PTS')
                    ->orWhere('jenjang','UIN')
                    ->count();
            
            $formal_total = $formal_tk + $formal_sd + $formal_smp + $formal_sma + $formal_ptn;
            $tk     = ($formal_tk / $formal_total) * 100;
            $sd     = ($formal_sd / $formal_total) * 100;
            $smp    = ($formal_smp / $formal_total) * 100;
            $sma    = ($formal_sma / $formal_total) * 100;
            $ptn    = ($formal_ptn / $formal_total) * 100;

            return response()->json(
                [
                    'status'        => 200,
                    'formal_tk'     => $tk,
                    'formal_sd'     => $sd,
                    'formal_smp'    => $smp,
                    'formal_sma'    => $sma,
                    'formal_ptn'    => $ptn,
                    'message'       => 'chart lembaga formal'
                ]
            );
        }
    }

    public function lembaga_non_formal(Request $request)
    {
        if ($request->ajax()) {                
            
            //FORMAL
            $formal_tk = Lembaga::where('jenjang','PAUD/KB')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUD')
                    ->orWhere('jenjang','TK-TPA')
                    ->orWhere('jenjang','TK - TPA')
                    ->orWhere('jenjang','TK,MI')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','PG/TK')
                    ->orWhere('jenjang','TK/KB')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUDQU')
                    ->orWhere('jenjang','TK PAUD')
                    ->count();
            $formal_sd = Lembaga::where('jenjang','SD/MI')
                    ->orWhere('jenjang','SD')
                    ->orWhere('jenjang','MI')
                    ->orWhere('jenjang','MI/MTs/MA')
                    ->orWhere('jenjang','MI.')
                    ->orWhere('jenjang','MINU')
                    ->orWhere('jenjang','MIT')
                    ->orWhere('jenjang','SDI')
                    ->orWhere('jenjang','SEKOLAH DASAR ISLAM')
                    ->count();
            $formal_smp = Lembaga::where('jenjang','SMP')
                    ->orWhere('jenjang','SMP/MTs')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMP/SMA')
                    ->orWhere('jenjang','MTSN')
                    ->orWhere('jenjang','MTS')
                    ->orWhere('jenjang','MI/MTS/MA')
                    ->count();
            $formal_sma = Lembaga::where('jenjang','SMA')
                    ->orWhere('jenjang','SMA/MA')
                    ->orWhere('jenjang','SMA IT')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMK')
                    ->count();
            $formal_ptn = Lembaga::where('jenjang','Perguruan Tinggi')
                    ->orWhere('jenjang','Perguruai Tinggi')
                    ->orWhere('jenjang','PT')
                    ->orWhere('jenjang','PTS')
                    ->orWhere('jenjang','UIN')
                    ->count();
            
            $formal_total = $formal_tk + $formal_sd + $formal_smp + $formal_sma + $formal_ptn;

            $non_formal_pondok = Lembaga::where('jenjang','PONDOK')
                    ->orWhere('jenjang','PONDOK PESANTREN')
                    ->orWhere('jenjang','PONPES')
                    ->orWhere('jenjang','RUMAH TAHFIDZ')
                    ->orWhere('jenjang',"RUMAH QUR'AN")
                    ->orWhere('jenjang','PONPES')
                    ->orWhere('jenjang','RUMAH TAHFIZH')
                    ->orWhere('jenjang','PON-PES')
                    ->orWhere('jenjang','BBAQ')
                    ->count();
            $non_formal_madrasah = Lembaga::where('jenjang','MADRASAH DINIYAH')
                    ->orWhere('jenjang','DINIYAH')
                    ->count();
            $non_formal_majlis   = Lembaga::where('jenjang',"Majlis Ta'lim")
                    ->orWhere('jenjang','KELOMPOK PENGAJIAN/MAJLIS')
                    ->orWhere('jenjang','MASJID')
                    ->orWhere('jenjang','MT. IBU-IBU')
                    ->orWhere('jenjang','MT.IBU - IBU')
                    ->orWhere('jenjang','MT.BAPAK')
                    ->orWhere('jenjang','MT.')
                    ->orWhere('jenjang','MT')
                    ->count();
            $non_formal_tpq     = Lembaga::where('jenjang','TPQ')
                    ->orWhere('jenjang','TPA')
                    ->orWhere('jenjang','TPQ/RA')
                    ->orWhere('jenjang','RA')
                    ->orWhere('jenjang','TPQ/TPA')
                    ->orWhere('jenjang','TPA/TPQ')
                    ->orWhere('jenjang','TPQ , UMUM')
                    ->orWhere('jenjang','TPQ/TPA')
                    ->orWhere('jenjang','UMUM')
                    ->count();
            $non_formal_private = Lembaga::where('jenjang','LES PRIVAT')
                    ->orWhere('jenjang','BBAQ')
                    ->count();

            $semua    = Lembaga::whereNotNull('jenjang')->count();
            $nonformal_total        = $non_formal_pondok + $non_formal_madrasah + $non_formal_majlis + $non_formal_tpq +  $non_formal_private;
            $non_formal_lainnya    = $semua - $nonformal_total;
            $total_lembaga_non_formal = $non_formal_pondok + $non_formal_madrasah + $non_formal_majlis + $non_formal_tpq +  $non_formal_private + $non_formal_lainnya;

            $pondok = ($non_formal_pondok / $total_lembaga_non_formal) * 100;
            $madrasah = ($non_formal_madrasah / $total_lembaga_non_formal) * 100;
            $majlis = ($non_formal_majlis / $total_lembaga_non_formal) * 100;
            $tpq = ($non_formal_tpq / $total_lembaga_non_formal) * 100;
            $private = ($non_formal_private / $total_lembaga_non_formal) * 100;
            $lainnya = ($non_formal_lainnya / $total_lembaga_non_formal) * 100;            

            return response()->json(
                [
                    'status'    => 200,
                    'pondok'    => $pondok,
                    'madrasah'  => $madrasah,
                    'majlis'    => $majlis,
                    'tpq'       => $tpq,
                    'private'   => $private,
                    'lainnya'   => $lainnya,
                    'message'   => 'chart lembaga non formal'
                ]
            );
        }
    }

    public function perkembangan_pengguna(Request $request)
    {
        if ($request->ajax()) {

            $tahun = Peserta::orderBy('tanggal','asc')->select(\DB::raw("YEAR(tanggal) as year"))->distinct()->get();
            $years = $tahun->pluck('year');
            $value_an_year = [];
            $bulanan = [];
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse(date('Y').'-'.$value.'-01')->format('M');
            })->toArray();
    
            $cetak_bulanan = [];
            foreach($years as $key => $thn){
                $value_an_year[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"),$thn)->count();
                
                
                foreach($month as $key => $bln){
                    $bulanan[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"),$thn)->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$bln)->count();
                }
                $cetak_bulanan[] = implode(',',$bulanan);
            }
    
            $data[] = $value_an_year;
            $hasil_bulanan = implode('<br>',$cetak_bulanan);
            $hasil_tahunan = implode(',',$value_an_year);
            $nama_bulan = implode(',',$monthNames);

            return response()->json(
                [
                    'status'    => 200,
                    'tahunan'   => $value_an_year,
                    'tahun'     => $years,
                    'array'     => $data,
                    'message'   => 'chart perkembangan pengguna tilawati'
                ]
            );   
        }
    }

    public function perkembangan_pengguna_bulanan(Request $request)
    {
        if ($request->ajax()) {
            $tahun = Peserta::orderBy('tanggal','asc')->select(\DB::raw("YEAR(tanggal) as year"))->distinct()->get();
            $years = $tahun->pluck('year');
            $value_an_year = [];
            $bulanan = [];
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse(date('Y').'-'.$value.'-01')->format('M');
            })->toArray();
    
            $cetak_bulanan = [];
            
            if ($request->thn == null) {
                # code...
                $tahun_sekarang = date('Y');
                foreach($month as $key => $bln){
                    $bulanan[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"), $tahun_sekarang)->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"), $bln)->count();
                }
            }

            return response()->json(
                [
                    'status'    => 200,
                    'totalbulanan'  => $bulanan,
                    'namabulan'     => $monthNames,
                    'message'   => 'chart perkembangan pengguna tilawati'
                ]
            );         
        }
    }

    public function maps()
    {
        // return view('tilawatipusat.dashboard.map');
    }

    public function maps_data_cabang(Request $request)
    {
        if ($request->ajax()) {
            $maps_cabang = Cabang::whereNotNull('lng')->whereNotNull('lat')
                            ->select('id','name','kepalacabang','alamat','lng','lat','telp')
                            ->get();
            if (count($maps_cabang) > 0) {
                # code...
                return response()->json(
                    [
                        'status'        => 200,
                        'maps_cabang'   => $maps_cabang,
                        'message'       => 'menampilkan data cabang tilawati & nurul falah'
                    ]
                );   
            }
        }
    }
}
