<?php

namespace App\Http\Controllers;
use App\Models\Cabang;
use App\Models\Jenjang;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Kepala;
use App\Models\Province;
use DataTables;
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
        $dt_l = Lembaga::all();
        return view('AdmPelatihan.Lembaga.index', compact('dt_l'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $dt_cabang = Cabang::all();
        $dt_jenis = Jenjang::all();
        $dt_props = Province::all();
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
        // try {
            $k = $request->kepala_id;
            $y = $request->name;
            $x = Lembaga::where('name', $y)->first();
            $z = User::where('email', $request->email)->first();
            if ($x!==null) {
                # code...
                return redirect()->back()->with('danger','Lembaga dengan nama tersebut telah terdaftar Periksa Daftar Lembaga yang ada');
            } else {
                # code...
                if ($z!==null) {
                    # code...
                    return redirect()->back()->with('danger','email tersebut telah terdaftar gunakan email lain');
                    
                } else {
                    # code...
                    $dt_usr = new User;
                    $dt_usr->username = $request->name;
                    $dt_usr->role = "lembaga";
                    $dt_usr->email = $request->email;
                    $dt_usr->password = bcrypt("lembaga");
                    $dt_usr->save();

                    $dt_lem = new Lembaga;
                    $dt_lem->user_id = $dt_usr->id;
                    $dt_lem->cabang_id = $request->cabang_id;
                    $dt_lem->name = $request->name;
                    $dt_lem->alamat = $request->alamat;
                    $dt_lem->provinsi_id = $request->provinsi;
                    $dt_lem->kabupaten_id = $request->kabupaten;
                    $dt_lem->kecamatan_id = $request->kecamatan_id;
                    $dt_lem->kelurahan_id = $request->kelurahan_id;
                    $dt_lem->jenjang_id = $request->jenjang_id;
                    $dt_lem->pos = $request->pos;
                    $dt_lem->telp = $request->telp;
                    $dt_lem->website = $request->website;
                    $dt_lem->pengelola = $request->pengelola;
                    $dt_lem->tahunberdiri = $request->tahunberdiri;
                    $dt_lem->tahunmasuk = $request->tahunmasuk;
                    $dt_lem->status = $request->status;
                    $dt_lem->save();
                    $dt_kepala = Kepala::where('id', $k)->update(
                        [
                            'lembaga_id'=>$dt_lem->id,
                        ]
                    );
                    
                    return redirect('/pelatihan-lembaga')->with('success', ' ( '.$y.$k.' ) Ditambahkan Sebagai Lembaga Baru');
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
        //
    }

    public function getlembaga_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Lembaga::orderBy('tahunmasuk','desc')
            ->select('name','alamat','tahunmasuk','jml_guru','jml_santri','provinsi_id','kepala_id','kabupaten_id')
            ->with('kepala','provinsi','kabupaten');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kepala', function($data){
                    if ($data->kepala == null) {
                        # code...
                        $kepala = '<span class="btn btn-sm badge badge-danger" data-toggle="modal"
                        data-target="#tambah_kepala">Kosong</span>';
                    } else {
                        # code...
                        $kepala = $data->kepala->name;
                    }
                    return $kepala;
                })
                ->addColumn('kabupaten', function ($data) {
                    return $kabupaten = $data->kabupaten->nama;
                })
                ->addColumn('provinsi', function ($data) {
                    return $provinsi = $data->provinsi->nama;
                })                   
                ->rawColumns(['kepala','kabupaten','provinsi'])
                ->make(true);
        }
    }

    public function lembaga_view_cabang(Request $request)
    {
        if(request()->ajax())
        {
            $data = Cabang::orderBy('id','desc');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('pilih', function($row){
                            $btn = '<input type="radio" name="pilih2" id="pilih2" onclick="pilih2()" value="'.$row->id.'" required>';
                            return $btn;
                        })
                        ->rawColumns(['pilih'])
                        ->make(true);
                return datatables()->of($data)->make(true);
        }
    }

}
