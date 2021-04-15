<?php

namespace App\Http\Controllers;
use App\Models\Cabang;
use App\Models\Jenis;
use App\Models\Lembaga;
use App\Models\Propinsi;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt_lembaga = Lembaga::all();
        return view('AdmPelatihan.Lembaga.index', compact('dt_lembaga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dt_cabang = Cabang::all();
        $dt_jenis = Jenis::all();
        $dt_props = Propinsi::all();
        return view('AdmPelatihan.Lembaga.create', compact('dt_props','dt_cabang','dt_jenis'));
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
            $dt_lem = new Lembaga;
            $dt_lem->cabang_id = $request->cabang_id;
            $dt_lem->name = $request->name;
            $dt_lem->kepala = $request->kepala;
            $dt_lem->jenis_id = $request->jenis_id;
            $dt_lem->alamat = $request->alamat;
            $dt_lem->propinsi_id = $request->propinsi_id;
            $dt_lem->kota_id = $request->kota_id;
            $dt_lem->pos = $request->pos;
            $dt_lem->telp = $request->telp;
            $dt_lem->pengelola = $request->pengelola;
            $dt_lem->totguru = $request->totguru;
            $dt_lem->totsantri = $request->totsantri;
            $dt_lem->waktubelajar = $request->waktubelajar;
            $dt_lem->tahunberdiri = $request->tahunberdiri;
            $dt_lem->tglmasuk = $request->tglmasuk;
            $dt_lem->keanggotaan = $request->keanggotaan;
            $dt_lem->save();

            return redirect('/pelatihan-lembaga')->with('success', ' ( '.$y.' ) Ditambahkan Sebagai Lembaga Baru');
            
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
        //
    }
}
