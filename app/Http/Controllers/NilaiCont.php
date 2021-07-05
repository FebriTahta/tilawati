<?php

namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Program;
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
        $peserta_id = $request->peserta_id;
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
                Nilai::where('peserta_id',$peserta_id)->update($data);
            }
        }
        $data2 = Peserta::updateOrCreate(
            [
              'id' => $peserta_id
            ],
            [
                'name'=>$request->name,
                'tanggal'=>$request->tanggal,
                'pelatihan_id' => $request->pelatihan_id,
                'kriteria_id'=>$request->kriteria_id,
                'kriteria'=>$request->kriteria
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

    public function edit($id)
    {
        $peserta = Peserta::find($id);
        $total = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
                                $total2 = $peserta->nilai->where("kategori","skill")->sum('nominal');
                                $total3 = $peserta->nilai->where("kategori","skill")->count();
                                // $rata2 = $data->nilai->sum('nominal');
                                $rata2 = ($total + $total2)/($total3+1);
                                return view('tilawatipusat.nilai.edit',compact('peserta','total','rata2',));
        
        
    }
}
