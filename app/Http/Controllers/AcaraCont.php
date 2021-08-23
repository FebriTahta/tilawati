<?php

namespace App\Http\Controllers;
use App\Models\Acara;
use App\Models\Flyer;
use App\Models\Peserta;
Use Image;
use Excel;
use App\Exports\PesertaAcaraExport;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AcaraCont extends Controller
{
    public function index()
    {
        return view('tilawatipusat.acara.index');
    }

    public function data_acara(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Acara::orderBy('tanggal','desc')->with('flyer');
            return DataTables::of($data)
            ->addColumn('gambar',function($data){
                if ($data->flyer !== null) {
                    # code...
                    return $data->flyer->image;
                } else {
                    # code...
                    return 'kosong';
                }
                
            })
            ->addColumn('peserta',function($data){
                $peserta = $data->peserta->count();
                return '<a class="text-success" href="/peserta-acara/'.$data->id.'">'.$peserta.' peserta'.'<a>';
            })
            ->addColumn('option', function ($data) {
                $btn = ' <button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-kriteria-update"
                data-id="'.$data->id.'" data-name="'.$data->name.'" data-untuk="'.$data->untuk.'"><i class="mdi mdi-pencil-outline"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-kriteria-hapus"
                data-id="'.$data->id.'"><i class="fa fa-trash"></i> </button>';
                return $btn;
            })
            ->rawColumns(['option','gambar','peserta'])
            ->make(true);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function store(Request $request)
    {
        $data = Acara::updateOrCreate(
            [
              'id' => $request->acara_id
            ],
            [
                'judul' => $request->judul,
                'subjudul' => $request->subjudul,
                'tanggal' => $request->tanggal,
                'slug' => Str::slug($request->judul.'-'.$request->tanggal),
                'jam' => $request->jam,
                'tempat' => $request->tempat,
            ]
        );

        
            $image = $request->file('image');
            $name=$image->getClientOriginalName();
            $image->move(public_path().'/flyer_acara/', $name);  // your folder path

            //save name image to db
            $data2 = Flyer::updateOrCreate(
                [
                  'id' => $request->flyer_id
                ],
                [
                    'acara_id' => $data->id,
                    'image' => $name,
                ]
            );
      
        return response()->json(
            [
              'success' => 'Acara Baru Berhasil Ditambahkan!',
              'message' => 'Acara Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function daftar_peserta_acara($acara_id)
    {
        $acara = Acara::find($acara_id);
        return view('tilawatipusat.acara.peserta',compact('acara'));
    }

    public function export_peserta_acara($acara_id)
    {
        $acara = Acara::find($acara_id);
        return Excel::download(new PesertaAcaraExport($acara_id),'event-'.$acara->judul.'-'.$acara->tanggal.'.xlsx');
    }

    public function data_peserta_acara(Request $request, $acara_id){
        if(request()->ajax())
        {
            $data   = Peserta::where('acara_id',$acara_id)->with('provinsi','kabupaten','kecamatan','donatur');
            return DataTables::of($data)
            ->addColumn('provinsi',function($data){
                return $data->provinsi->nama;
                
            })
            ->addColumn('kabupaten',function($data){
                return $data->kabupaten->nama;
            })
            ->addColumn('kecamatan', function ($data) {
                return $data->kecamatan->nama;
            })
            ->addColumn('donatur', function ($data) {
                if ($data->donatur->data == 1) {
                    # code...
                    return 'DONATUR LAZIZ';
                } else {
                    # code...
                    return '-';
                }
                
            })
            ->rawColumns(['provinsi','kabupaten','kecamatan','donatur'])
            ->make(true);
            
        }
    }
}
