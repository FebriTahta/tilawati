<?php

namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Program;
use DB;
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
                'kriteria'=>$request->kriteria,
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
        // $peserta_id = $request->peserta_id;
        // if (count($request->nominal) > 0) {
        //     # code...
        //     foreach ($request->nominal as $key => $value) {
        //         # code...
        //         $data = array(
        //             'peserta_id'=> $peserta_id,
        //             'penilaian_id'=> $request->penilaian_id[$key],
        //             'nominal'=>$request->nominal[$key],
        //             'kategori'=>$request->kategori[$key]
        //         );
        //         Nilai::where('peserta_id',$peserta_id)->update($data);
        //     }
        // }
        // $data2 = Peserta::updateOrCreate(
        //     [
        //       'id' => $peserta_id
        //     ],
        //     [
        //         'name'=>$request->name,
        //         'tanggal'=>$request->tanggal,
        //         'pelatihan_id' => $request->pelatihan_id,
        //         'kriteria_id'=>$request->kriteria_id,
        //         'kriteria'=>$request->kriteria
        //     ]
        // );
        // return response()->json(
        //     [
        //        $data,$data2,
        //       'success' => 'Peserta Telah Dinilai!',
        //       'message' => 'Peserta Telah Dinilai!'
        //     ]
        // );

        // $peserta_id = $request->peserta_id;
        // $id= $request->id;
        // if (count($request->nominal) > 0) {
        //     # code...
        //     foreach ($request->nominal as $key => $value) {
        //         # code...
        //         $data = array(
        //             'peserta_id'=> $peserta_id,
        //             // 'penilaian_id'=> $request->penilaian_id[$key],
        //             'nominal'=>$request->nominal[$key],
        //             // 'kategori'=>$request->kategori[$key]
        //         );
        //         $nilai = Nilai::where('peserta_id',$peserta_id)->update($data);
        //         // Nilai::updateOrCreate(
        //         //     [
        //         //         'peserta_id'=>$peserta_id,
        //         //         'penilaian_id'=>$request->penilaian_id[$key],
        //         //     ],
        //         //     [
        //         //         'nominal'=>$request->nominal[$key],
        //         //     ]
        //         // );
        //     }
        // }
        // $total  = Nilai::where('peserta_id',$peserta_id)->where("kategori","al-qur'an")->sum('nominal');
        // $total2 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->sum('nominal');
        // $total3 = Nilai::where('peserta_id',$peserta_id)->where("kategori","skill")->count();
        // $rata2  = ($total + $total2)/($total3+1);
        // $syahadah;
        // if ($rata2 > 74) {
        //     # code...
        //     $syahadah = '1';
        // } else {
        //     # code...
        //     $syahadah = '0';
        // }
        // $data2  = Peserta::updateOrCreate(
        //     [
        //       'id' => $peserta_id
        //     ],
        //     [
        //         // 'kriteria_id'=>$request->kriteria_id,
        //         'kriteria'=>$request->kriteria,
        //         'bersyahadah' => $syahadah,
        //     ]
        // );     
        // // return response()->json(
        // //     [
        // //        $data,$data2,
        // //       'success' => 'Peserta Telah Dinilai!',
        // //       'message' => 'Peserta Telah Dinilai!'
        // //     ]
        // // );

        // return redirect()->back();

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
        return redirect()->back()->with(['success' => 'NILAI '.strtoupper($data_peserta2->name).' BERHASIL DI UPDATE '.$hasil_syahadah.' '.strtoupper($request->mykriteria)]);
    }

    public function edit($id)
    {
        $peserta    = Peserta::find($id);
        $total      = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
        $total2     = $peserta->nilai->where("kategori","skill")->sum('nominal');
        $total3     = $peserta->nilai->where("kategori","skill")->count();
        // $rata2 = $data->nilai->sum('nominal');
        $rata2      = ($total + $total2)/($total3+1);

        $kriteria   = Kriteria::where('program_id', $peserta->program_id)->get();
        return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2','kriteria'));
        
        
    }
}
