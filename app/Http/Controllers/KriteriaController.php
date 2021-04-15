<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $krtr = Kriteria::all();
        return view('AdmPelatihan.KriteriaSyahadah.index', compact('krtr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $krtr = new Kriteria;
            $krtr->name = $request->name;
            $krtr->untuk = $request->untuk;
            
            $krtr->save();

            return redirect()->back()->with('success', ' ( '.$y.' ) Ditambahkan Sebagai Kriteria Baru');
            
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
    public function destroy(Request $request, $id)
    {
        $krtr = Kriteria::where('id',$request->id)->first();
        $krtr->delete();
        return redirect()->back()->with('danger', 'DATA BERHASIL DIHAPUS');
    }

    public function hapus(Request $request)
    {
        $krtr = Kriteria::where('id',$request->id)->first();
        $krtr->delete();
        return redirect()->back()->with('danger', 'DATA BERHASIL DIHAPUS');
    }
}
