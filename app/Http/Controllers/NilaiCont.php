<?php

namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Program;
use DB;
use File;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Http\Request;

class NilaiCont extends Controller
{
    public function store(Request $request)
    {
        $peserta_id = $request->peserta_id;
        $id= $request->id;
        if (count($request->nominal) > 0) {
            # code...
            foreach ($request->nominal as $key => $value) {
                # code...
                $data = array(
                    'peserta_id'=> $peserta_id,
                    'penilaian_id'=> $request->penilaian_id[$key],
                    'nominal'=>$request->nominal[$key],
                    'kategori'=>$request->kategori[$key]
                );
                $nilai = Nilai::insert($data);
            }
        }
        $total  = Nilai::where('peserta_id',$peserta_id)->where("kategori","al-qur'an")->sum('nominal');
        $total2 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->sum('nominal');
        $total3 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->count();
        $rata2  = ($total + $total2)/($total3+1);
        $syahadah;
        if ($rata2 > 74) {
            # code...
            $syahadah = '1';
        } else {
            # code...
            $syahadah = '0';
        }
        $data2  = Peserta::updateOrCreate(
            [
              'id' => $peserta_id
            ],
            [
                'kriteria_id'=>$request->kriteria_id,
                'kriteria'=>$request->mykriteria,
                'bersyahadah' => $syahadah,
            ]
        );     
        return response()->json(
            [
               $data,$data2,
              'success' => 'Peserta Telah Dinilai!',
              'message' => 'Peserta Telah Dinilai!'
            ]
        );
    }

    public function update(Request $request){
        
        $peserta_id = $request->peserta_id;
        // update nilai
        foreach ($request->nominal as $key => $value) {
            # code...
            if (isset($request->id[$key])) {
                # code...
                Nilai::where('id',$request->id[$key])->where('penilaian_id',$request->penilaian_id[$key])->update(
                    ['nominal'=>$request->nominal[$key]]
                );
            }
        }

        // update keterangan bersyahadah
        $total  = Nilai::where('peserta_id',$peserta_id)->where("kategori","al-qur'an")->sum('nominal');
        $total2 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->sum('nominal');
        $total3 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->count();
        $rata2  = ($total + $total2)/($total3+1);
        $syahadah;
        $hasil_syahadah;
        if ($rata2 > 74) {
            # code...
            $syahadah = '1';
            $hasil_syahadah = 'BERSYAHADAH';
        } else {
            # code...
            $syahadah = '0';
            $hasil_syahadah = 'BELUM BERSYAHADAH';
        }
        $krit = $request->mykriteria;
        $data_peserta = DB::table('pesertas')
        ->where('id', $peserta_id)  // find your user by their id
        ->update(array('bersyahadah' => $syahadah,'kriteria' => $request->mykriteria));  // update the record in the DB. 
        $data_peserta2= DB::table('pesertas')->where('id',$peserta_id)->first();

        // cetak qr code
        if ($data_peserta2->bersyahadah == 1) {
            # code...
            $qr = \QrCode::size(200)
            ->format('png')
            ->generate('https://www.profile.tilawatipusat.com/'.$data_peserta2->slug, public_path('images/'.$data_peserta2->slug.'.png'));
        }

        return redirect()->back()->with(['success' => 'NILAI '.strtoupper($data_peserta2->name).' BERHASIL DI UPDATE '.$hasil_syahadah.' '.strtoupper($request->mykriteria)]);
    }

    public function edit($id)
    {
        $peserta    = Peserta::find($id);
        if ($peserta->pelatihan->kategori == 'instruktur') {
            # code...
            if ($peserta->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI') {
                #code...
                $total  = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $penilaian2 = $peserta->nilai->where('penilaian_id', 31)->sum('nominal');
                $penilaian3 = $peserta->nilai->where('penilaian_id', 32)->sum('nominal');
                $rata2 = ($total + $penilaian2 + $penilaian3)/3;
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria'));

            }elseif($peserta->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI'){
                $total  = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $penilaian1 = $peserta->nilai->where('penilaian_id', 30)->sum('nominal');
                $penilaian3 = $peserta->nilai->where('penilaian_id', 32)->sum('nominal');
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                $rata2 = ($total + $penilaian1 + $penilaian3)/3;
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria'));
            }else{
                $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
                $total3     = $peserta->nilai->where("kategori","skill")->count();
                $rata2      = ($total + $total2)/($total3+1);
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria'));
            }
            
        } else {
            # code...
            $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
            $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
            $total3     = $peserta->nilai->where("kategori","skill")->count();
            $rata2      = ($total + $total2)/($total3+1);
            $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
            return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria'));
        }
    }
}
