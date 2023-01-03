<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use File;
use PDF;
use ZipArchive;
use App\Models\Cabang;

class TTDController extends Controller
{
    public function data_ttd(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Cabang::where('ttd', '!=' ,null)->get();
                return DataTables::of($data)
                    ->addColumn('image_ttd', function ($data) {
                        $img = '<img src="img_ttd/'.$data->ttd.'" alt="" style="width:100%">';
                        return $img;
                    })
                    ->addColumn('opsi', function ($data) {
                        $btn  = ' <a href=/download-ttd-cabang/'.$data->id.'" class="btn btn-sm btn-info" data-id="'.$data->id.'"> Download </a>';
                        $btn .= ' <button class="btn btn-sm btn-primary" data-toggle="modal" data-kepalacabang="'.$data->kepalacabang.'" data-target="#modalupload" data-id="'.$data->id.'"> Audit </button>';
                        $btn .= ' <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modaldel" data-kepalacabang="'.$data->kepalacabang.'" data-id="'.$data->id.'"> Remove </button>';
                        $btn .= ' <a href="/uji-ttd/'.$data->id.'" class="btn btn-sm btn-success" > Uji </a>';
                        return $btn;
                    })
                    ->addColumn('status_ttd', function ($data) {
                        if ($data->status_ttd == 'menunggu') {
                            # code...
                            $stat = '<p class="badge badge-warning">'.$data->status_ttd.'</p>';
                        }else {
                            # code...
                            $stat = '<p class="badge badge-info">'.$data->status_ttd.'</p>';
                        }

                        return $stat;
                    })
                ->rawColumns(['image_ttd','status_ttd','opsi'])
            ->make(true);
        }
        
        return view('tilawatipusat.syahadah.ttd');
    }

    public function uji_ttd($cabang_id)
    {
        $cabang = Cabang::findOrFail($cabang_id);
        $pdf        = PDF::loadView('tilawatipusat.cetak.syahadah_b5.uji',compact('cabang'))->setPaper('a4', 'portrait');
        return $pdf->stream('syahadah_v2_uji.pdf');
    }

    public function total_ttd(Request $request)
    {
        $belum_mengirim = Cabang::where('ttd', null)->where('status_ttd', null)->count();
        $sudah_mengirim = Cabang::where('ttd', '!=', null)->where('status_ttd', 'menunggu')->count();
        $fix_mengirim = Cabang::where('ttd', '!=', null)->where('status_ttd', 'fix')->count();

        return response()->json(
            [
                'status' => 200,
                'message' => 'menampilkan total tanda tangan kepala cabang',
                'belum_mengirim'=> $belum_mengirim,
                'sudah_mengirim'=> $sudah_mengirim,
                'fix_mengirim'=> $fix_mengirim,
            ]
        );
    }

    public function download_ttd($cabang_id)
    {
        $cabang = Cabang::find($cabang_id);
        $myFile     = public_path("img_ttd/".$cabang->ttd);
        return response()->download($myFile);
    }

    public function audit_ttd(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $cabang = Cabang::find($request->id);

            if ($request->ttd == null) {
                # code...
                $data       = Cabang::where('id', $request->id)->update(
                    [
                        'status_ttd' => $request->status_ttd
                    ]
                );  
                return response()->json(
                    [
                        'status'=>200,
                        'message'=>'File TTD has been updated'
                    ]
                );
            }else {
                # code...
                if(File::exists(public_path("img_ttd/".$cabang->ttd))){
                
                    $ekstensi   = $request->ttd->extension();
                    $filename   = time().'.'.$request->ttd->getClientOriginalExtension();
                    $request->file('ttd')->move('img_ttd/',$filename);
                    // status : fix / uji / null
                    $data       = Cabang::where('id', $request->id)->update(
                        [
                            'ttd' => $filename,
                            'status_ttd' => $request->status_ttd
                        ]
                    );  
    
                    //remove image sebelumnya
                    File::delete(public_path("img_ttd/".$cabang->ttd));
    
                    return response()->json(
                        [
                            'status'=>200,
                            'message'=>'File TTD has been updated'
                        ]
                    );
                    
                }else{
                    return response()->json(
                        [
                            'status'=>400,
                            'message'=>'undefined input'
                        ]
                    );
                }
            }

            

        }
       
    }

    public function remove_ttd(Request $request)
    {
        if ($request->ajax()) {

            # code...
            $cabang = Cabang::find($request->id);

            if(File::exists(public_path("img_ttd/".$cabang->ttd))){
                
                File::delete(public_path("img_ttd/".$cabang->ttd));
                Cabang::where('id', $request->id)->update(
                    [
                        'ttd'=>null,
                        'status_ttd'=>null
                    ]
                );

                return response()->json(
                    [
                        'status'=>200,
                        'message'=>'File TTD Kepala Cabang Dihapus Dari Sistem',
                    ]
                );
            }else{
                Cabang::where('id', $request->id)->update(
                    [
                        'ttd'=>null,
                        'status_ttd'=>null
                    ]
                );

                return response()->json(
                    [
                        'status'=>200,
                        'message'=>'File TTD Kepala Cabang Dihapus Dari Sistem. & FILE TTD TIDAK DITEMUKAN',
                    ]
                );
                // return response()->json(
                //     [
                //         'status'=>400,
                //         'message'=>'File Does Not Exist',
                //     ]
                // );
            }
        }
       
    }
}
