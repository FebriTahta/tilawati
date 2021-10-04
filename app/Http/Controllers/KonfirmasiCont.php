<?php
 
namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class KonfirmasiCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.konfirmasi.index');
    }

    public function data_diklat_menunggu_konfirmasi(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('unduh', function($data){
                            $actionBtn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download"><i class="fa fa-download"></i></button>';
                            return $actionBtn2;
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->sampai_tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                ->rawColumns(['cabang','program','peserta','unduh','tanggal'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc');
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('unduh', function($data){
                            $actionBtn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download"><i class="fa fa-download"></i></button>';
                            $actionBtn2 .= ' <button data-id="'.$data->id.'" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-download2"><i class="fa fa-download"></i></button>';
                            return $actionBtn2;
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->sampai_tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                ->rawColumns(['cabang','program','peserta','unduh','tanggal'])
                ->make(true);
            }
        }
    }

    public function daftar_peserta_diklat_menunggu_konfirmasi(Request $request, $slug_diklat)
    {
        $diklat = Pelatihan::where('slug',$slug_diklat)->first();
        return view('tilawatipusat.konfirmasi.peserta',compact('diklat'));
    }

    public function acc(Request $request)
    {
        if(request()->ajax())
        {

            $data = Peserta::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'status' => $request->acc,
                ]
            );
            $data2 = Pelatihan::where('id',$data->pelatihan_id)->first();
            $linkwa= $data2->groupwa;

            $alasan= $request->alasan;

            if ($request->acc == 1) {
                # code...
                # send wa
                $curl = curl_init();
                $token = "qI5hdmGFCSs67lLEnEy10MAqCc8zuMYh8QPhfw1ye8OeIogn4UdUDNLs6hLzsNtP";
                $datas = [
                    'phone' => $data->telp,
                    'message' => '*TILAWATI PUSAT - '.strtoupper($data2->program->name).'*. 
                    *Yth. '.strtoupper($data->name).'*. Pendaftaran anda telah kami terima, silahkan bergabung pada group whatsapp berikut ( '.$data2->groupwa.' )

                    *CATATAN*
                    Simpan nomor ini untuk mengaktifkan link group Whatsapp diatas.
                    *PESAN INI TIDAK UNTUK DISEBAR LUASKAN*
                    ',
                    'secret' => false, // or true
                    'priority' => false, // or true
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($datas));
                curl_setopt($curl, CURLOPT_URL, "https://simo.wablas.com");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);
                //
                return response()->json(
                    [
                      'success' => 'Pendaftaran Peserta Telah Disetujui!',
                      'message' => 'Pendaftaran Peserta Telah Disetujui!'
                    ]
                );
            }else{
                # send wa
                $curl = curl_init();
                $token = "qI5hdmGFCSs67lLEnEy10MAqCc8zuMYh8QPhfw1ye8OeIogn4UdUDNLs6hLzsNtP";
                $datas = [
                    'phone' => $data->telp,
                    'message' => ' *TILAWATI PUSAT - '.strtoupper($data2->program->name).'*
                    *Yth. '.strtoupper($data->name).'*. Maaf, Pendaftaran anda belum dapat kami terima karena :  
                    *'.$alasan.'*.

                    Untuk melanjutkan pendaftaran bisa klik link dibawah ini.
                    https://registrasi.tilawatipusat.com/'.$data2->slug.'
                    ',
                    'secret' => false, // or true
                    'priority' => false, // or true
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($datas));
                curl_setopt($curl, CURLOPT_URL, "https://simo.wablas.com");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);
                //hapus data peserta yang ditolak
                $data->delete();
                return response()->json(
                    [
                      'success' => 'Pendaftaran Peserta Telah Ditolak!',
                      'message' => 'Pendaftaran Peserta Telah Ditolak!'
                    ]
                );
            }
        }
    }

    public function data_peserta_diklat_menunggu_konfirmasi(Request $request, $diklat_id)
    {
        if(request()->ajax())
        {
            
                $data   = Peserta::where('pelatihan_id', $diklat_id)->with('kabupaten')->with('pelatihan')->with('filepeserta');
                return DataTables::of($data)
                    ->addColumn('registrasi', function ($data) {
                        if ($data->filepeserta->count()==0) {
                            # code...
                            return '<span class="badge badge-danger">kosong</span>';
                        } else {
                            # code...
                            foreach ($data->filepeserta as $key => $value) {
                                # code...
                                if ($value->status == 0) {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: rgb(112, 150, 255)" data-toggle="modal" data-target="#modal_file"
                                    data-file="https://registrasi.tilawatipusat.com/file_peserta/'.$value->file.'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                } elseif ($value->status == 1) {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: red" data-toggle="modal" data-target="#modal_file"
                                    data-file="https://registrasi.tilawatipusat.com/file_peserta/'.$value->file.'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                } else{
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: lightgreen" data-toggle="modal" data-target="#modal_file"
                                    data-file="https://registrasi.tilawatipusat.com/file_peserta/'.$value->file.'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                }
                            
                            }
                            return implode(" - ", $x);
                        }
                    })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten == null) {
                                # code...
                                return "-";
                            }else{
                                return $data->kabupaten->nama;
                            }
                        })

                        ->addColumn('status', function ($data) {
                            if ($data->status == 0) {
                                # code...
                                $stat = '<span class="badge badge-warning">menunggu</span>';
                                return $stat;
                            }elseif ($data->status == 2) {
                                # code...
                                $stat = '<span class="badge badge-danger">ditolak</span>';
                                return $stat;
                            } 
                            elseif ($data->status == 1) {
                                # code...
                                $stat = '<span class="badge badge-success">disetujui</span>';
                                return $stat;
                            } 
                        })
                        
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a style="width:50px" href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-close"></i></a>';
                            $actionBtn .= ' <a style="width:50px" href="#" data-id="'.$data->id.'" data-name="'.$data->name.'" data-toggle="modal" data-target=".modal-acc" class="btn btn-sm btn-outline btn-success "><i class="fa fa-check"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['action','kabupaten','registrasi','status'])
                ->make(true);
            
        }
    }
}
