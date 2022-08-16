<?php

namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Program;
use App\Models\Penilaian;
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
        $lulus_tak='';
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
                $penil = Penilaian::find($request->penilaian_id[$key]);
                if ($request->nominal[$key] < $penil->min) {
                    # code...
                    $lulus_tak = $key+1; 
                }
            }
        }
        $total  = Nilai::where('peserta_id',$peserta_id)->where("kategori","al-qur'an")->sum('nominal');
        $total2 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->sum('nominal');
        $total3 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->count();
        // $rata2  = ($total + $total2)/($total3+1);
        $rata2  = $total;
        $syahadah;
        $hasil_syahadah;
        if ($total2 !== 0 || $total2 !== null) {
            # code...
            if ($rata2 > 74) {
                # code...
                if ($lulus_tak > 0) {
                    # code...
                    $syahadah = '0';
                    $hasil_syahadah = 'BELUM BERSYAHADAH';
                }else {
                    # code...
                    $syahadah = '1';
                    $hasil_syahadah = 'BERSYAHADAH';
                }
                
            } else {
                # code...
                $syahadah = '0';
                $hasil_syahadah = 'BELUM BERSYAHADAH';
            }
        }else {
            # code...
            $syahadah = '0';
            $hasil_syahadah = 'BELUM BERSYAHADAH';
        }
        
        $pes = Peserta::where('id', $peserta_id)->first();
        $pro = $pes->program->name;
        $krits = '';
        if ($pro == "standarisasi guru al qur'an level 1") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        } elseif ($pro == "standarisasi guru al qur'an level 2") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 2 GURU AL QURAN METODE TILAWATI";
        } elseif ( $pro =="munaqosyah santri"){
            # code...
            $krits = "SEBAGAI SANTRI KHATAM AL QURAN 30 JUZ";
        } elseif ( $pro =="diklat guru tahfidz"){
            # code...
            $krits = "SEBAGAI GURU TAHFIDZ AL QURAN METODE TILAWATI";
        } elseif ( $pro =="diklat guru tahfidz"){
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }elseif ($pro == "pembinaan & munaqosyah ulang") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }elseif ($pro == "Diklat Munaqisy Cabang") {
            # code...
            $krits = "SEBAGAI MUNAQISY CABANG METODE TILAWATI";
        }
        else {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }
        
        if ($syahadah == 1) {
            # code...
            $data_peserta = DB::table('pesertas')
            ->where('id', $peserta_id)  // find your user by their id
            ->update(array('bersyahadah' => $syahadah,'kriteria' => $krits,'jilid' =>''));  // update the record in the DB. 
            // ->update(array('bersyahadah' => $syahadah,'kriteria' => $request->mykriteria));  // update the record in the DB. 
        }else {
            # code...
                $data_peserta = DB::table('pesertas')
            ->where('id', $peserta_id)  // find your user by their id
            ->update(array('bersyahadah' => $syahadah,'kriteria' => '','jilid' =>$request->jilid));  // update the record in the DB. 
            // ->update(array('bersyahadah' => $syahadah,'kriteria' => $request->mykriteria));  // update the record in the DB. 
        }    
        return response()->json(
            [
              
              'success' => 'Peserta Telah Dinilai!',
              'message' => 'Peserta Telah Dinilai!'
            ]
        );
        
    }

    public function update(Request $request){
        
        

        $peserta_id = $request->peserta_id;
        $lulus_tak='';
        // update nilai
        foreach ($request->nominal as $key => $value) {
            # code...
            if (isset($request->id[$key])) {
                # code...
                Nilai::where('id',$request->id[$key])->where('penilaian_id',$request->penilaian_id[$key])->update(
                    ['nominal'=>$request->nominal[$key]]
                );
                $penil = Penilaian::find($request->penilaian_id[$key]);
                if ($request->nominal[$key] < $penil->min) {
                    # code...
                    $lulus_tak = $key+1; 
                }
            }
        }
        

        $krits = '';
        $pes = Peserta::where('id', $peserta_id)->first();
        $pro = $pes->program->name;

        // update keterangan bersyahadah
        $total  = Nilai::where('peserta_id',$peserta_id)->where("kategori","al-qur'an")->sum('nominal');
        $total2 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->sum('nominal');
        $total3 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->count();
        // $rata2  = ($total + $total2)/($total3+1);
        $rata2  = $total; 
        $syahadah;
        $hasil_syahadah;
        
        if ($pro =="munaqosyah santri") {
            # code...
            if ($total2 !== null) {
                # code...
                if ($rata2 > 69) {
                    # code...
                    if ($lulus_tak > 0) {
                        # code...
                        $syahadah = '0';
                        $hasil_syahadah = 'BELUM BERSYAHADAH';
                    }else {
                        # code...
                        $syahadah = '1';
                        $hasil_syahadah = 'BERSYAHADAH';
                    }

                } else {
                    # code...
                    if ($lulus_tak > 0) {
                    # code...
                    $syahadah = '0';
                    $hasil_syahadah = 'BELUM BERSYAHADAH';
                    }else {
                        # code...
                        $syahadah = '1';
                        $hasil_syahadah = 'BERSYAHADAH';
                    }
                }
            }else {
                # code...
                $syahadah = '0';
                $hasil_syahadah = 'BELUM BERSYAHADAH';
            }
        }else {
            # code...
            if ($total2 !== null) {
                # code...
                if ($rata2 > 74) {
                    # code...
                    if ($lulus_tak > 0) {
                        # code...
                        $syahadah = '0';
                        $hasil_syahadah = 'BELUM BERSYAHADAH';
                    }else {
                        # code...
                        $syahadah = '1';
                        $hasil_syahadah = 'BERSYAHADAH';
                    }
                } else {
                    # code...
                    if ($lulus_tak > 0) {
                        # code...
                        $syahadah = '0';
                        $hasil_syahadah = 'BELUM BERSYAHADAH';
                    }else {
                        # code...
                        $syahadah = '1';
                        $hasil_syahadah = 'BERSYAHADAH';
                    }
                }
            }else {
                # code...
                $syahadah = '0';
                $hasil_syahadah = 'BELUM BERSYAHADAH';
            }
        }

        // $krit = $request->mykriteria;
        

        if ($pro == "standarisasi guru al qur'an level 1") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        } elseif ($pro == "standarisasi guru al qur'an level 2") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 2 GURU AL QURAN METODE TILAWATI";
        } elseif ( $pro =="munaqosyah santri"){
            # code...
            $krits = "SEBAGAI SANTRI KHATAM AL QURAN 30 JUZ";
        } elseif ( $pro =="diklat guru tahfidz"){
            # code...
            $krits = "SEBAGAI GURU TAHFIDZ AL QURAN METODE TILAWATI";
        } elseif ( $pro =="diklat guru tahfidz"){
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }elseif ($pro == "pembinaan & munaqosyah ulang") {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }else {
            # code...
            $krits = "LULUS DIKLAT LEVEL 1 GURU AL QURAN METODE TILAWATI";
        }
        
        if ($syahadah == 1) {
            # code...
            $data_peserta = DB::table('pesertas')
            ->where('id', $peserta_id)  // find your user by their id
            ->update(array('bersyahadah' => $syahadah,'kriteria' => $krits,'jilid' =>''));  // update the record in the DB. 
            // ->update(array('bersyahadah' => $syahadah,'kriteria' => $request->mykriteria));  // update the record in the DB. 
        }else {
            # code...
                $data_peserta = DB::table('pesertas')
            ->where('id', $peserta_id)  // find your user by their id
            ->update(array('bersyahadah' => $syahadah,'kriteria' => '','jilid' =>$request->jilid));  // update the record in the DB. 
            // ->update(array('bersyahadah' => $syahadah,'kriteria' => $request->mykriteria));  // update the record in the DB. 
        }

        $data_peserta2= DB::table('pesertas')->where('id',$peserta_id)->first();

        // cetak qr code
        // if ($data_peserta2->bersyahadah == 1) {
        //     # code...
        //     $qr = \QrCode::size(200)
        //     ->format('png')
        //     ->generate('https://www.profile.tilawatipusat.com/'.$data_peserta2->slug, public_path('images/'.$data_peserta2->slug.'.png'));
        // }

        return redirect()->back()->with(['success' => 'NILAI '.strtoupper($data_peserta2->name).' BERHASIL DI UPDATE '.$hasil_syahadah.' '.strtoupper($request->mykriteria)]);
    }

    public function edit($id)
    {
        $peserta    = Peserta::find($id);
        if ($peserta->pelatihan->keterangan == 'instruktur') {
            # code...
            if ($peserta->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI') {
                #code...
                $total  = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $penilaian2 = $peserta->nilai->where('penilaian_id', 31)->sum('nominal');
                $penilaian3 = $peserta->nilai->where('penilaian_id', 32)->sum('nominal');
                $rata1 = $total;
                $rata2 = ($total + $penilaian2 + $penilaian3)/3;
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria','rata1'));

            }elseif($peserta->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI'){
                $total  = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $penilaian1 = $peserta->nilai->where('penilaian_id', 30)->sum('nominal');
                $penilaian3 = $peserta->nilai->where('penilaian_id', 32)->sum('nominal');
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                $rata1 = $total;
                $rata2 = ($total + $penilaian1 + $penilaian3)/3;
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria','rata1'));
            }else{
                $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
                $total3     = $peserta->nilai->where("kategori","skill")->count();
                $rata1 = $total;
                $rata2      = ($total + $total2)/($total3+1);
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria','rata1'));
            }
            
        } else {
            # code...
            if ($peserta->program->name == 'Diklat Munaqisy Cabang') {
                # code...
                $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
                $total3     = $peserta->nilai->where("kategori","skill")->count();
                $x          = $total2 / $total3;
                $y          = $total + $total2;
                $rata2      = ($x + $y) / 2;
                $rata1      = $total;
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria','rata1'));
            }else{
                $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
                $total3     = $peserta->nilai->where("kategori","skill")->count();
                $rata2      = ($total + $total2)/($total3+1);
                $rata1      = $total;
                $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria','rata1'));
            }
        }
    }
}
