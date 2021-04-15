<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CabangController;
use App\Models\Cabang;
use App\Models\Propinsi;
use App\Models\Kota;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt_cabang = Cabang::all();   
        return view('AdmPelatihan.Cabang.index',compact('dt_cabang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dt_props = Propinsi::all();
        $dt_kota = Kota::all();
        $dt_cabang = Cabang::orderBy('id')->get();
        return view('AdmPelatihan.Cabang.create', compact('dt_props','dt_kota','dt_cabang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $y = $request->name;
            $dt_cabang = new Cabang;
            $dt_cabang->name = $request->name;
            $dt_cabang->status = $request->status;
            $dt_cabang->kepala = $request->kepala;
            $dt_cabang->jabatan = $request->jabatan;
            $dt_cabang->propinsi_id = $request->propinsi_id;
            $dt_cabang->kota_id = $request->kota_id;
            $dt_cabang->alamat = $request->alamat;
            $dt_cabang->pos = $request->pos;
            $dt_cabang->telp = $request->telp;
            $dt_cabang->email = $request->email;
            $dt_cabang->ekspedisi = $request->ekspedisi;
            $dt_cabang->save();

            return redirect('/pelatihan-cabang')->with('success', ' ( '.$y.' ) Ditambahkan Sebagai Cabang Baru');
            
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dt_cabang = Cabang::find($id)->delete();
        return redirect()->back()->with('danger', 'Cabang Berhasil Dihapus');
    }

}
