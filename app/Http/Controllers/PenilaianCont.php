<?php

namespace App\Http\Controllers;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianCont extends Controller
{
    public function store(Request $request){
        Penilaian::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'program_id' => $request->program_id,
                'name' => $request->name,
                'min' => $request->min,
                'max' => $request->max,
                'kategori' => $request->kategori,
            ]
        );
      
        return response()->json(
            [
              'success' => 'Penilaian Baru Berhasil Ditambahkan!',
              'message' => 'Penilaian Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Penilaian::find(
            $id
        )->delete();
      
        return response()->json(
            [
              'success' => 'Penilaian Baru Berhasil Dihapus!',
              'message' => 'Penilaian Baru Berhasil Dihapus!'
            ]
        );
    }
}
