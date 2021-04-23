<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CabangController;
use App\Models\Cabang;
use App\Models\Propinsi;
use App\Models\Province;
use App\Models\Kota;
use App\Models\City;
use App\Models\User;

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
        $dt_props = Province::all();
        // $dt_kota = City::all();
        $dt_cabang = Cabang::orderBy('id')->get();
        return view('AdmPelatihan.Cabang.create', compact('dt_props','dt_cabang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
            $y = $request->name;
            $x = Cabang::where('name', $request->name)->first();
            $e = $request->email;
            $i = User::where('email', $request->email)->first();
            
            if ($x!==null) {
                # code...
                
                if ($i!==null) {
                    # code...
                    return redirect()->back()->with('danger', 'email cabang tersebut sudah digunakan cabang lain, silahkan gunakan email lain');
                } else {
                    # code...
                    return redirect()->back()->with('danger', 'Cabang tersebut sudah terdata sebelumnya');
                }
                

            } else {
                # code...
                if ($i !==null) {
                    # code...
                    return redirect()->back()->with('danger', 'email cabang tersebut sudah tersimpan sebelumnya, silahkan gunakan email lain');
                } else {
                    # code...
                    $dt_cabang = new User;
                    $dt_cabang->username = $request->name;
                    $dt_cabang->role = $request->status;
                    $dt_cabang->email = $request->email;
                    $dt_cabang->password = bcrypt($request->status);
                    $dt_cabang->save();
                    
                    $dt_cb = new Cabang;

                    $dt_cb->user_id = $dt_cabang->id;
                    $dt_cb->name = $request->name;
                    $dt_cb->status = $request->status;
                    $dt_cb->kepala = $request->kepala;
                    $dt_cb->jabatan = $request->jabatan;
                    $dt_cb->province_id = $request->province_id;
                    $dt_cb->city_id = $request->city_id;
                    $dt_cb->alamat = $request->alamat;
                    $dt_cb->pos = $request->pos;
                    $dt_cb->telp = $request->telp;
                    $dt_cb->ekspedisi = $request->ekspedisi;
                    $dt_cb->kecamatan = $request->kecamatan;
                    $dt_cb->teritorial = $request->teritorial;
                    $dt_cb->save();

                    return redirect('/pelatihan-cabang')->with('success', ' ( '.$y.' ) Ditambahkan Sebagai Cabang Baru');
                }
            }
            
        // } catch (\Throwable $th) {
        //     dd("error", $th);
        // }
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
