<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Registrasi;
use App\Models\Filepeserta;
use App\Models\Pelatihan;
use App\Models\Peserta;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Carbon\Carbon;
use DataTables;
use Mail;
use Illuminate\Http\Request;

class RegistrasiCont extends Controller
{
    public function index(Request $request,$slug_diklat)
    {
        $diklat = Pelatihan::where('slug', $slug_diklat)->first();
        $dt_props2 = Provinsi::all();
        $registrasi = Registrasi::where('program_id',$diklat->program_id)->get();
        return view('tilawatipusat.registrasi.index',compact('diklat','dt_props2','registrasi'));
    }

    public function syarat(Request $request)
    {
        return view('tilawatipusat.registrasi.syarat');
    }

    public function registrasi(Request $request)
    {
        $nik = $request->nik;
        $dpp = $request->pelatihan_id;
        $dp  = Peserta::where('nik', $nik)->where('pelatihan_id',$dpp)->first();
        
        if ($dp == null) {
            # code...
            if (count($request->fileupload) > 0) {
                # code...
    
                $data["email"] = $request->email;
                $data["title"] = "From tilawatipusat.com";
                $data["body"] = "This is Demooo Pendaftaran";
    
                // $files = [
                //     public_path('files/160031367318.pdf'),
                //     public_path('files/1599882252.png'),
                // ];
    
                // Mail::send('tilawatipusat.emails.online_registrasi', $data, function($message)use($data, $files) {
                Mail::send('tilawatipusat.emails.online_registrasi', $data, function($message)use($data) {
                    $message->to($data["email"], $data["email"])
                            ->subject($data["title"]);
        
                    // foreach ($files as $file){
                    //     $message->attach($file);
                    // }
                    
                });
    
                $diklat         = Pelatihan::where('id', $request->pelatihan_id)->first();
                $tanggal        = $diklat->tanggal;
                $kabupaten_kota = Kabupaten::where('id',$request->kabupaten_id)->first();
                $kota           = $kabupaten_kota->nama; 
                $peserta        = Peserta::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'nik' => $request->nik,
                        'pelatihan_id' => $request->pelatihan_id,
                        'program_id' => $diklat->program_id,
                        'cabang_id' => $request->cabang_id,
                        'lembaga_id' => $request->lembaga_id,
                        'provinsi_id' => $request->provinsi_id,
                        'kabupaten_id' => $request->kabupaten_id,
                        'kecamatan_id' => $request->kecamatan_id,
                        'kelurahan_id' => $request->kelurahan_id,
                        'tanggal' => $tanggal,
                        'name' => $request->name,
                        'tmptlahir' => $request->tmptlahir,
                        'tgllahir' => $request->tgllahir,
                        'alamat' => $request->alamat,
                        'kota' => $request->nama,
                        'telp' => $request->phone,
                        'email' => $request->email,
                        'bersyahadah' => $request->bersyahadah,
                        'jilid' => $request->jilid,
                        'kriteria' => $request->kriteria,
                        'munaqisy' => $request->munaqisy,
                        'status' => '0',
                    ]
                );
                #code
                if($request->hasfile('fileupload'))
                {
                    foreach($request->file('fileupload') as $key=>$image)
                    {
                        $name=$image->getClientOriginalName();
                        $image->move(public_path().'/file_peserta/', $name);  // your folder path
                        $data_file_name[] = $name;
                        $data = array(
                                'peserta_id'=> $peserta->id,
                                'registrasi_id'=> $request->registrasi_id[$key],
                                'file'=>$name,
                                'status'=>'0',
                            );
                        Filepeserta::insert($data);    
                    }
                }
                return redirect('/pendaftaran-data-calon-peserta-diklat-sukses/'.$diklat->program->id.'/'.$diklat->id.'/'.$peserta->id);
            }else{
                return "Antum belum menyertakan lembar bukti persyaratan pendaftaran";
            }
        } else {
            # code...
            return "NIK anda sudah terdaftar pada diklat ini";
        }
    }

    public function data_syarat(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Program::with('registrasi');
                return DataTables::of($data)
                    ->addColumn('registrasi', function ($data) {
                        if ($data->registrasi->count()==0) {
                            # code...
                            return '<span class="badge badge-danger">kosong</span>';
                        } else {
                            # code...
                            foreach ($data->registrasi as $key => $value) {
                                # code...
                                $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: rgb(112, 150, 255)" data-toggle="modal" data-target=".bs-example-modal-penilaian-update"
                                    data-id="'.$value->id.'" 
                                    data-program_id="'.$value->program_id.'"
                                    data-name="'.$value->name.'"
                                    data-jenis="'.$value->jenis.'">'.$value->name.'</a>';
                            }
                            return implode(" - ", $x);
                        }
                    })
                    ->addColumn('option', function ($data) {
                        $btn = ' <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bs-example-modal-kategori-quran"
                        data-id="'.$data->id.'"><i class="fa fa-plus"></i> Persyaratan</button>';
                        return $btn;
                    })
                ->rawColumns(['registrasi','option'])
                ->make(true);
        }
    }

    public function submit_syarat(Request $request)
    {
        $program_id = $request->program_id;
        Registrasi::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'program_id' => $program_id,
                'name' => $request->name,
                'jenis' => $request->jenis
            ]
        );
        return response()->json(
            [
              'success' => 'Persyaratan Baru Berhasil Ditambahkan!',
              'message' => 'Persyaratan Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete(Request $request){
        $id = $request->id;
        Registrasi::find($id)->delete();
        return response()->json(
            [
              'success' => 'Syarat Berhasil Dihapus!',
              'message' => 'Syarat Berhasil Dihapus!'
            ]
        );
    }

    public function sukses(Request $request, $program_id, $diklat_id,$peserta_id){
        
        $diklat = Pelatihan::where('id', $diklat_id)->first();
        $peserta = Peserta::where('id',$peserta_id)->first();
        return view('tilawatipusat.registrasi.sukses',compact('diklat','peserta'));
    }

    public function konfirmasi(Request $request, $program_id, $diklat_id)
    {
        $diklat = Pelatihan::where('id', $diklat_id)->first();
        
        return view('tilawatipusat.bendahara.konfirmasi',compact('diklat'));
    }

    public function data_calon_peserta(Request $request, $diklat_id)
    {
        if(request()->ajax())
        {
            $data   = Peserta::where('pelatihan_id', $diklat_id)->with('kabupaten','filepeserta')->where('status',0);
                return DataTables::of($data)
                        ->addColumn('kabupaten', function ($data) {
                            return $data->kabupaten->nama;
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $a;
                        })
                        ->addColumn('check',function($data){
                            foreach ($data->filepeserta as $key => $value) {
                                # code...
                                $btn[] = '<span class="btn btn-sm btn-success" data-id="'.$value->id.'"
                                data-name="'.$value->registrasi->name.'" 
                                data-file="'.asset('/file_peserta/'.$value->file).'" data-toggle="modal" data-target="#terms-file"
                                ><i class="mdi mdi-clipboard-list-outline">.</i>'.$value->registrasi->name.'</span>';
                            }
                            
                            return implode(" ", $btn);
                        })
                        ->addColumn('konfirmasi',function($data){
                            if ($data->status == 0) {
                                # code...
                                $ok = '<span class="btn btn-sm btn-warning">menunggu</span>';
                            }
                            return $ok;
                        })
                ->rawColumns(['kabupaten','tgllahir','check','konfirmasi'])
                ->make(true);
        }
    }
}
