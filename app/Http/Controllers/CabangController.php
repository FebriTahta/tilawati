<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CabangController;
use App\Models\Cabang;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kepala;
use App\Models\Kabupaten;
use DataTables;

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
        $dt_props2 = Provinsi::all();
        return view('AdmPelatihan.Cabang.index',compact('dt_cabang','dt_props2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $dt_props2 = Provinsi::all();
        // $dt_kabupaten = Kabupaten::where('provinsi_id', 11)->first();
        $dt_cabang = Cabang::orderBy('id')->get();
        return view('AdmPelatihan.Cabang.create', compact('dt_cabang','dt_props2'));
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
            $k = $request->kepala_id;

            
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
                    $dt_cabang->role = 'cabang';
                    $dt_cabang->email = $request->email;
                    $dt_cabang->password = bcrypt('cabang');
                    $dt_cabang->save();
                    
                    $dt_cb = new Cabang;

                    $dt_cb->user_id = $dt_cabang->id;
                    $dt_cb->name = $request->name;
                    $dt_cb->alamat = $request->alamat;
                    $dt_cb->provinsi_id = $request->pro_id;
                    $dt_cb->kabupaten_id = $request->kab_id;
                    $dt_cb->kecamatan_id = $request->kec_id;
                    $dt_cb->kelurahan_id = $request->kel_id;
                    $dt_cb->pos = $request->pos;
                    $dt_cb->telp = $request->telp;
                    $dt_cb->ekspedisi = $request->ekspedisi;
                    // $dt_cb->email = $request->email;
                    $dt_cb->teritorial = $request->teritorial;
                    $dt_cb->save();

                    $dt_kepala = Kepala::where('id', $k)->update(
                        [
                            'cabang_id'=>$dt_cb->id,
                        ]
                    );

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
        $dt_kp = Kepala::where('cabang_id', $id)->first();
        $dt_props2 = Provinsi::all();
        $dt_cb = Cabang::find($id);
        return view('AdmPelatihan.Cabang.edit', compact('dt_kp','dt_props2','dt_cb'));
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
        $ada_email = User::where('email',$request->email)->first();
        if ($ada_email == null) {
            # code...
            $dt_cb = Cabang::find($id);
            $dt_cb->user_id = $dt_cabang->id;
                    $dt_cb->name = $request->name;
                    $dt_cb->alamat = $request->alamat;
                    $dt_cb->provinsi_id = $request->pro_id;
                    $dt_cb->kabupaten_id = $request->kab_id;
                    $dt_cb->kecamatan_id = $request->kec_id;
                    $dt_cb->kelurahan_id = $request->kel_id;
                    $dt_cb->pos = $request->pos;
                    $dt_cb->telp = $request->telp;
                    $dt_cb->ekspedisi = $request->ekspedisi;
                    $dt_cb->teritorial = $request->teritorial;
                    $dt_cb->save();

            return redirect('/pelatihan-cabang')->with('success', 'data cabang berhasil diupdate');
        } else {
            # code...
            $dt_cb = Cabang::find($id);
            $dt_cb->name = $request->name;
            $dt_cb->alamat = $request->alamat;
            $dt_cb->provinsi_id = $request->pro_id;
            $dt_cb->kabupaten_id = $request->kab_id;
            $dt_cb->kecamatan_id = $request->kec_id;
            $dt_cb->kelurahan_id = $request->kel_id;
            $dt_cb->pos = $request->pos;
            $dt_cb->telp = $request->telp;
            $dt_cb->ekspedisi = $request->ekspedisi;
            $dt_cb->teritorial = $request->teritorial;
            $dt_cb->save();
            return redirect('/pelatihan-cabang')->with('success', 'user ga di update karena data emailnya sama');
        }
        
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

    public function getcabang_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Cabang::orderBy('id','asc')->with('kepala')->with('provinsi')->with('kabupaten');
            return DataTables::of($data)
                    ->addColumn('kepala', function ($data) {
                        return $data->kepala->name;
                    })
                    ->addColumn('kabupaten', function ($data) {
                        return $data->kabupaten->nama;
                    })
                    ->addColumn('provinsi', function ($data) {
                        return $data->provinsi->nama;
                    })
                    ->rawColumns(['kepala','kabupaten','provinsi'])
                    ->make(true);
        }
    }

}
