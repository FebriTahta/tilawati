<?php

namespace App\Http\Controllers;
use App\Models\Apicabangtilawati;
use App\Models\Apicabangnf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class ApicabangCont extends Controller
{
    public function index_api_tilawati(Request $request){

        if(request()->ajax())
        {
            $data   = Apicabangtilawati::orderBy('created_at','DESC')->with('provinsi','kabupaten');
                return DataTables::of($data)
                
                ->addColumn('provinsi', function ($data) {
                    if ($data->provinsi == null) {
                        # code...
                    } else {
                        # code...
                        return $data->provinsi->nama;
                    }
                })
                
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten == null) {
                        # code...
                    } else {
                        # code...
                        return $data->kabupaten->nama;
                    }
                })
                
                ->addColumn('opsi', function ($data){
                    // $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                    // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                    if (auth()->user()->role=='pusat') {
                        # code...
                        $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                        data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                        data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                        data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                        // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                        return $btn;
                    }else {
                        # code...
                        if (auth()->user()->cabang->id == $data->id) {
                            # code...
                            $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                            data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                            data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                            data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                            // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                            return $btn;
                        }else {
                            # code...
                            return '<span style="color:red">Fitur Pusat</span>';
                        }
                        
                    }
                })
                ->rawColumns(['provinsi','kabupaten','opsi'])
                ->make(true);
        }


        $apicabangtilawati = Apicabangtilawati::get();
        return view('tilawatipusat.api.apicabangtilawati',compact('apicabangtilawati'));

    }

    public function update_api_cabang(Request $request)
    {
        Apicabangtilawati::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name'          => $request->name,
                'status'        => $request->status,
                'alamat'        => $request->alamat,
                'kadivre'       => $request->kadivre,
                'teritorial'    => $request->teritorial,
                'kepalacabang'  => $request->kepalacabang,
                'pos'           => $request->pos,
                'telp'          => $request->telp,
                'ekspedisi'     => $request->ekspedisi,
            ]
        );

        return response()->json(
            [
            //   'success' => 'Cabang Baru Berhasil Ditambahkan!',
                'success' => 'Sukses!',
                'message' => 'Sukses!'
            //   'message' => 'Cabang Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function index_api_nf(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Apicabangnf::orderBy('created_at','DESC')->with('provinsi','kabupaten');
                return DataTables::of($data)
                
                ->addColumn('provinsi', function ($data) {
                    if ($data->provinsi == null) {
                        # code...
                    } else {
                        # code...
                        return $data->provinsi->nama;
                    }
                })
                
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten == null) {
                        # code...
                    } else {
                        # code...
                        return $data->kabupaten->nama;
                    }
                })
                
                ->addColumn('opsi', function ($data){
                    // $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                    // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                    if (auth()->user()->role=='pusat') {
                        # code...
                        $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                        data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                        data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'" data-nfmap="'.$data->nfmap.'"
                        data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                        // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                        return $btn;
                    }else {
                        # code...
                        if (auth()->user()->cabang->id == $data->id) {
                            # code...
                            $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                            data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                            data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'" data-nfmap="'.$data->nfmap.'"
                            data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                            // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                            return $btn;
                        }else {
                            # code...
                            return '<span style="color:red">Fitur Pusat</span>';
                        }
                        
                    }
                })
                ->rawColumns(['provinsi','kabupaten','opsi'])
                ->make(true);
        }


        $apicabangnf = Apicabangnf::get();
        return view('tilawatipusat.api.apicabangnf',compact('apicabangnf'));
    }

    public function update_api_cabang_nf(Request $request)
    {
        Apicabangnf::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name'          => $request->name,
                'status'        => $request->status,
                'alamat'        => $request->alamat,
                'kadivre'       => $request->kadivre,
                'teritorial'    => $request->teritorial,
                'kepalacabang'  => $request->kepalacabang,
                'pos'           => $request->pos,
                'telp'          => $request->telp,
                'ekspedisi'     => $request->ekspedisi,
                'nfmap'         => $request->nfmap
            ]
        );

        return response()->json(
            [
                'success' => 'Sukses!',
                'message' => 'Sukses!'
            ]
        );
    }
}

