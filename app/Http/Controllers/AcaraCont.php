<?php

namespace App\Http\Controllers;
use App\Models\Acara;
use App\Models\Flyer;
Use Image;
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
                return $peserta;
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

            // $image_name = time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path('/images');
            // $resize_image = Image::make($request->file('image')->getRealPath());
            // $resize_image->resize(150, 150, function($constraint){
            // $constraint->aspectRatio();
            // })->save($destinationPath . '/' . $image_name);

            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $image_name);
            // $image_resize = Image::make($gambar->getRealPath());
            // $image_resize->resize(250,150);
            // $image_resize->save(public_path('images/'.$name));
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
}
