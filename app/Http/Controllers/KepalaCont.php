<?php

namespace App\Http\Controllers;
use App\Models\Kepala;
use DataTables;
use App\Models\Kabupaten;
use App\Models\Lembaga;
use App\Models\Cabang;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KepalaCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.kepala.index');
    }

    public function kepala_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Kepala::with(['cabang','lembaga','provinsi','kabupaten'])
                            ->whereBetween('created_at', array($request->dari, $request->sampai));
                    return DataTables::of($data)
                        ->addColumn('bagian', function ($data) {
                            if ($data->cabang !== null && $data->lembaga == null) {
                                # code...
                                return 'cabang';
                            }elseif ($data->cabang == null && $data->lembaga !== null) {
                                # code...
                                return 'lembaga';
                            }elseif ($data->cabang !== null && $data->lembaga !== null) {
                                # code...
                                return 'cabang & lembaga';
                            }else{
                                return 'kosong';
                            }
                        })
                        
                    ->rawColumns(['cabang','lembaga','provinsi','kabupaten'])
                ->make(true);
            }else{
                $data   = Kepala::with(['cabang','lembaga','provinsi','kabupaten']);
                    return DataTables::of($data)
                        ->addColumn('bagian', function ($data) {
                            if (count($data->cabang) !== 0 && count($data->lembaga) == 0) {
                                # code...
                                return 'cabang';
                            }elseif (count($data->cabang) == 0 && count($data->lembaga) !== 0) {
                                # code...
                                return 'lembaga';
                            }elseif (count($data->cabang) !== 0 && count($data->lembaga) !== 0) {
                                # code...
                                return 'cabang & lembaga';
                            }else{
                                return 'kosong';
                            }
                        })
                        ->addColumn('action', function ($data) {
                            $btn = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-kepala-hapus"><i class="fa fa-trash"></i></button>';
                            $btn .= ' <a href="/diklat-kepala-bagian-edit/'.$data->id.'" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"> </i></a>';
                            $btn .= ' <button class="btn btn-sm btn-info"><i class="fa fa-user"></i></button>';
                            return $btn;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten == null) {
                                # code...
                                return '<span class="badge badge-danger">Kosong</span>';
                            }else{
                                return $data->kabupaten->nama;
                            }
                        })
                        
                    ->rawColumns(['cabang','lembaga','provinsi','kabupaten','action'])
                ->make(true);
            }
        }
    }

    public function kepala_store(Request $request)
    {

    }

    public function kepala_edit($id)
    {
        $dt_props2 = Provinsi::all();
        $dt_kabs = Kabupaten::all();
        $data = Kepala::find($id);
        return view('tilawatipusat.kepala.edit',compact('data','dt_props2','dt_kabs'));
    }

    public function kepala_delete(Request $request)
    {
        $id = $request->id;
        $data = Kepala::find($id)->delete();
        return response()->json(
            [
                'success'=>'Data Kepala Daerah Berhasil Dihapus',
            ]
        );
    }

    public function pilih_kepala(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                
            }else{
                $data   = Kepala::with(['cabang','lembaga']);
                    return DataTables::of($data)
                        ->addColumn('pilih', function ($data) {
                            $btn = '<input name="kepala_id" type="radio" value="'.$data->id.'" id="pilih_kepala">';
                            return $btn;
                        })
                        ->addColumn('bagian', function ($data) {
                            if ($data->cabang->count() !== 0 && $data->lembaga->count() == 0) {
                                # code...
                                foreach ($data->cabang as $key => $value) {
                                    # code...
                                    $cabang[] = $value->name;
                                    $kab_c[] = $value->kabupaten->nama;
                                }
                                return 'cabang '.implode($cabang).' <b>('.implode($kab_c).')</b>';
                            }elseif ($data->cabang->count() == 0 && $data->lembaga->count() !== 0) {
                                # code...
                                foreach ($data->lembaga as $key => $value) {
                                    # code...
                                    $lembaga[] = $value->name;
                                    $kab_l[] = $value->kabupaten->nama;
                                }
                                return 'lembaga '.implode($lembaga).' <b>('.implode($kab_l).')</b>';
                            }elseif ($data->cabang->count() !== 0 && $data->lembaga->count() !== 0) {
                                # code...
                                foreach ($data->cabang as $key => $value) {
                                    # code...
                                    $cabang[] = $value->name;
                                    $kab_c[] = $value->kabupaten->nama;
                                }
                                foreach ($data->lembaga as $key => $value) {
                                    # code...
                                    $lembaga[] = $value->name;
                                    $kab_l[] = $value->kabupaten->nama;
                                }
                                return 'cabang '.implode($cabang).' <b> ( '.implode($kab_c).' ) </b> ' .' & '.' lembaga ' .implode($lembaga).' | <b> ( '.implode($kab_l).' ) </b> ';
                            }else{
                                return 'kosong';
                            }
                        })
                        
                    ->rawColumns(['cabang','bagian','pilih'])
                ->make(true);
            }
        }
    }

    public function pilih_kepala_bagian(Request $request)
    {
        $kepala_id = $request->kepala_id;
        $kode= $request->kode;
        $data = Lembaga::where('kode',$kode)->update(['kepala_id'=>$kepala_id]);
        if ($kepala_id !== null) {
            # code...
            return response()->json(
                [
                    $data,
                    'success'=>'Kepala Lembaga Baru Berhasil Diberikan',
                ]
            );
        }else{
            return response()->json(
                [
                    $data,
                    'error'=>'Pilih Kepala Lembaga Terlebih Dahulu',
                ]
            );
        }
    }

    public function pilih_kepala_bagian_cabang(Request $request)
    {
        $kepala_id = $request->kepala_id;
        $kode= $request->kode;
        $data = Cabang::where('kode',$kode)->update(['kepala_id'=>$kepala_id]);
        if ($kepala_id !== null) {
            # code...
            return response()->json(
                [
                    $data,
                    'success'=>'Kepala Lembaga Baru Berhasil Diberikan',
                ]
            );
        }else{
            return response()->json(
                [
                    $data,
                    'error'=>'Pilih Kepala Lembaga Terlebih Dahulu',
                ]
            );
        }
    }
}
