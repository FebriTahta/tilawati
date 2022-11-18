<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Penilaian;
use App\Models\Nilai;
use App\Models\Lembaga;
use App\Models\Cabang;
use App\Models\Kabupaten;
use App\Models\KPA;
use App\Models\Munaqisy;
use App\Models\Supervisor;
use App\Models\Kriteria;
use App\Models\Trainer;
use Illuminate\Support\Str;
use Carbon\Carbon;
use File;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Http\Request;

class PesertaCont extends Controller
{
    public function index($id)
    {
        $pelatihan_id = $id;
        $diklat     = Pelatihan::where('id', $id)->first();
        $program_id = $diklat->program->id;
        $kriteria   = Kriteria::where('program_id',$program_id)->get();
        $penilaian  = Penilaian::where('program_id',$program_id)->get();
        $kab_kosong = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
        $lulus      = Peserta::where('pelatihan_id',$pelatihan_id)->where('bersyahadah', 1)->count();
        $seluruh    = Peserta::where('pelatihan_id',$pelatihan_id)->count();
        $belum_lulus= $seluruh-$lulus;
        return view('tilawatipusat.peserta.index',compact('penilaian','pelatihan_id','diklat','kriteria','kab_kosong','lulus','belum_lulus'));
    }

    public function remove_kecamatan_kelurahan($id)
    {
        $peserta = Peserta::findOrFail($id)->update(
            [
                'kecamatan_id'=>null,
                'kelurahan_id'=>null,
            ]
        );

        return redirect()->back();
    }

    public function index2($id)
    {
        $pelatihan_id = $id;
        $diklat     = Pelatihan::where('id', $id)->first();
        $program_id = $diklat->program->id;
        $kriteria   = Kriteria::where('program_id',$program_id)->get();
        $penilaian  = Penilaian::where('program_id',$program_id)->get();
        $kab_kosong = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
        $lulus      = Peserta::where('pelatihan_id',$pelatihan_id)->where('bersyahadah', 1)->count();
        $seluruh    = Peserta::where('pelatihan_id',$pelatihan_id)->count();
        $belum_lulus= $seluruh-$lulus;
        return view('tilawatipusat.peserta.index2',compact('penilaian','pelatihan_id','diklat','kriteria','kab_kosong','lulus','belum_lulus'));
    }

    public function hapus_beberapa(Request $request)
    {
        if(request()->ajax())
        {
            $peserta_id_array = $request->id;
            $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->delete();
            return response()->json(
                [
                'success' => 'Data Peserta Telah dihapus',
                'message' => 'Data Peserta Telah dihapus'
                ]
            );
        }else{
            $peserta_id_array = $request->id;
            $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->delete();
            return redirect()->back();
        }
    }

    public function peserta_data(Request $request,$id)
    {
        if(request()->ajax())
        {
            $data   = Peserta::where('pelatihan_id', $id)->with('certificate')->with('pelatihan')->with('kabupaten')
            ->with('kecamatan')->with('kelurahan')->with('nilai')->where('status',1)->orderBy('id','asc');
                return DataTables::of($data)
                        ->addColumn('idpeserta', function ($data) {
                            return $data->id;
                        })
                        ->addColumn('check', function ($data) {
                            return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
                        })
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                if ($data->pelatihan->keterangan == 'instruktur') {
                                    # code...
                                    if ($data->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI') {
                                        # code...
                                        $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                        $penilaian2 = $data->nilai->where('penilaian_id', 31)->sum('nominal');
                                        $penilaian3 = $data->nilai->where('penilaian_id', 32)->sum('nominal');

                                        $ratax = ($total + $penilaian2 + $penilaian3)/3;
                                        $rata2 = $total;
                                        if ($rata2 > 70 && $data->bersyahadah > 0) {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.round($rata2,1).' BERSYAHADAH '.$data->bersyahadah.'</a>';
                                        } else {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.round($rata2,1).' BELUM BERSYAADAH</a>';
                                        }
                                    }elseif($data->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI'){
                                        $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                        $penilaian1 = $data->nilai->where('penilaian_id', 30)->sum('nominal');
                                        $penilaian3 = $data->nilai->where('penilaian_id', 32)->sum('nominal');

                                        $ratax = ($total + $penilaian1 + $penilaian3)/3;
                                        $rata2 = $total;
                                        if ($rata2 > 74 && $data->bersyahadah > 0) {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.round($rata2,1).' BERSYAHADAH</a>';
                                        } else {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.round($rata2,1).' BELUM BERSYAADAH</a>';
                                        }
                                    }
                                    else {
                                        # code...
                                        $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                        $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                        $total3 = $data->nilai->where("kategori","skill")->count();
                                        
                                        $ratax = ($total + $total2)/($total3+1);
                                        $rata2 = $total;
                                        if ($rata2 > 70 && $data->bersyahadah > 0) {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.round($rata2,1).' BERSYAHADAH</a>';
                                        } else {
                                            # code...
                                            return '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.round($rata2,1).' BELUM BERSYAADAH</a>';
                                        }
                                    }
                                } 
                                elseif ($data->pelatihan->program->name == 'munaqosyah santri') {
                                    # code...
                                    # code...
                                    $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;

                                    $lulus_tak='';
                                    foreach ($data->nilai->where("kategori","al-qur'an") as $key => $value) {
                                        # code...
                                        $penil = Penilaian::find($value->penilaian_id);
                                        if ($value->nominal < $penil->min) {
                                            # code...
                                            $lulus_tak = $key+1;
                                        }
                                    }


                                    if ($lulus_tak > 0) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }else {
                                        # code...
                                        if ($rata2 > 69 && $data->bersyahadah > 0) {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                        }
                                        
                                        else {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                        }
                                    }
                                }
                                elseif ($data->program->name == 'Diklat Munaqisy Cabang') {
                                    # code...
                                    # code...
                                    $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $x = $total;
                                    $y = $total2/$total3;
                                    $ratax = round(($x + $y)/2);
                                    $rata2 = $ratax;

                                    
                                    $lulus_tak='';
                                    foreach ($data->nilai->where("kategori","al-qur'an") as $key => $value) {
                                        # code...
                                        $penil = Penilaian::find($value->penilaian_id);
                                        if ($value->nominal < $penil->min) {
                                            # code...
                                            $lulus_tak = $key+1;
                                        }
                                    }


                                    if ($lulus_tak > 0) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }else {
                                        # code...
                                        if ($rata2 > 74 && $data->bersyahadah > 0) {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' rata-rata (bersyahadah)</a>';
                                        }
                                        
                                        else {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' rata-rata (belum bersyahadah)</a>';
                                        }
                                    }
                                }
                                else {
                                    # code...
                                    $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;

                                    $lulus_tak='';
                                    foreach ($data->nilai->where("kategori","al-qur'an") as $key => $value) {
                                        # code...
                                        $penil = Penilaian::find($value->penilaian_id);
                                        if ($value->nominal < $penil->min) {
                                            # code...
                                            $lulus_tak = $key+1;
                                        }
                                    }


                                    if ($lulus_tak > 0) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }else {
                                        # code...
                                        if ($rata2 > 74 && $data->bersyahadah > 0) {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                        }
                                        
                                        else {
                                            # code...
                                            return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                        }
                                    }
                                    
                                }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('namapeserta', function ($data) {
                            if ($data->gelar !== null) {
                                # code...
                                return strtoupper($data->name).', '.$data->gelar;
                            }else{
                                return $data->name;
                            }
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                if ($data->kota2 !== null) {
                                    # code...
                                    return $data->kota2;
                                } else {
                                    # code...
                                    return '<a data-target="#addkota" data-id="'.$data->id.'" data-toggle="modal" href="#" style="color:red">kosong / salah penulisan</a>';
                                }
                            }
                        })
                        ->addColumn('kecamatan', function ($data) {
                            if ($data->kecamatan !== null) {
                                # code...
                                return strtoupper($data->kecamatan->nama);
                            } else {
                                # code...
                                return '-';
                            }
                        })
                        ->addColumn('kelurahan', function ($data) {
                            if ($data->kelurahan !== null) {
                                # code...
                                return strtoupper($data->kelurahan->nama);
                            } else {
                                # code...
                                return '-';
                            }
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            if (auth()->user()->role = 'admin') {
                                # code...
                                $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            }
                            $actionBtn .= ' <a href="/halaman-update-data-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-primary "><i class="fa fa-edit"></i></a>';
                            $actionBtn .= ' <a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#modal_force_qr" class="btn btn-sm btn-outline btn-danger"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('krits', function ($data) {
                            if ($data->kriteria == null) {
                                # code...
                                return '<span class="badge badge-warning">Belum Lulus</span>';

                            } else {
                                # code...
                                return '<p class="text-success">'.$data->kriteria.'</p>';
                            }
                            
                        })
                        ->addColumn('ttl', function($data){
                                # code...
                                // return $data->tgllahir;
                                if ($data->tmptlahir !== null && $data->tgllahir !== null) {
                                    # code...
                                    if ($data->tmptlahir2 !== null) {
                                        # code...
                                        return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                                    }else {
                                        # code...
                                        return  $data->tmptlahir.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                                    }
                                }

                                if ($data->tmptlahir == null && $data->tgllahir !== null) {
                                    # code...
                                    if ($data->tmptlahir2 !== null) {
                                        # code...
                                        return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                                    }else {
                                        # code...
                                        return  '<a href="#" style="color:red" data-toggle="modal" data-target="#addkota2" data-id ="'.$data->id.'"> Kosong / Salah Penulisan</a>' .' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                                    }
                                }

                                if ($data->tmptlahir !== null && $data->tgllahir == null) {
                                    # code...
                                    if ($data->tmptlahir2 !== null) {
                                        # code...
                                        return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                                    }else {
                                        # code...
                                        return  $data->tmptlahir.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                                    }
                                    
                                }

                                if ($data->tmptlahir == null && $data->tgllahir == null) {
                                    # code...
                                    if ($data->tmptlahir2 !== null) {
                                        # code...
                                        return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl">Tgl Salah Format</a>';
                                    }else {
                                        # code...
                                        return  '<a href="" style="color:red" data-id ="'.$data->id.'"  data-toggle="modal" data-target="#addkota3"> Kosong / Salah Penulisan</a>' .' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                                    }
                                    
                                }
                        })
                        ->addColumn('alamatmodul', function($data){
                            if ($data->alamatx == null) {
                                # code...
                                $ttl = '<a href="#" data-id="'.$data->id.'" style="text-danger" data-alamatx="'.$data->alamatx.'" data-toggle="modal" data-target="#modal-modul"> Kosong </a>';
                                return $ttl;
                            }else {
                                # code...
                                $ttl = '<a href="#" data-id="'.$data->id.'" data-alamatx="'.$data->alamatx.'" data-toggle="modal" data-target="#modal-modul">'.$data->alamatx.'</a>';
                                return $ttl;
                            }
                        })

                        ->addColumn('phone', function($data){
                            if (substr($data->telp,0,2) == '62') {
                                # code...
                                $phone = '0'.substr($data->telp,2);
                                return $phone;
                            }elseif(substr($data->telp,0,1) == '8') {
                                # code...
                                $phone = '0'.$data->telp;
                                return $phone;
                            }else {
                                # code...
                                return $data->telp;
                            }
                        })
                ->rawColumns(['idpeserta','nilai','check','action','kabupaten','phone','kecamatan','kelurahan','ttl','krits','alamatmodul','namapeserta'])
                ->make(true);
        }
    }

    public function ubah_alamat_modul(Request $request)
    {
        $data = Peserta::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'alamatx'=>$request->alamatx,
            ]
        );

        return response()->json(
            [
            'success' => 'Alamat pengiriman modul diubah',
            'message' => 'Alamat pengiriman modul diubah'
            ]
        );
    }

    public function peserta_data_keseluruhan(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 85) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 85 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name;
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        ->addColumn('tempat', function ($data) {
                            $tempat = $data->pelatihan->tempat;
                            return $tempat;
                        })
                        
                ->rawColumns(['nilai','kabupaten','cabang','program','tgllahir','tempat'])
                ->make(true);
            }else {
                # code...
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 85) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 85 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name;
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        ->addColumn('tempat', function ($data) {
                            $tempat = $data->pelatihan->tempat;
                            return $tempat;
                        })
                        
                ->rawColumns(['nilai','kabupaten','cabang','program','tgllahir','tempat'])
                ->make(true);
            }
        }
    }

    public function peserta_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = Peserta::
                whereBetween('tanggal', array($request->dari, $request->sampai))
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Peserta::whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_cabang_total(Request $request, $cabang_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = Peserta::where('cabang_id', $cabang_id)
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Peserta::where('cabang_id', $cabang_id)
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_diklat_total(Request $request, $pelatihan_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->where('pelatihan_id', $pelatihan_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
                ->where('pelatihan_id', $pelatihan_id)
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_lembaga_select(Request $request, $kab)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Lembaga::where('kabupaten_id',$kab && 'status', 'Aktif')
                    ->orWhere('alamat','LIKE','%' .$search . '%')
                    ->orWhere('name','LIKE','%' .$search . '%')
                    ->orWhere('kabupaten_id',$kab)
            		->get();
        }
        else{
            $data = Lembaga::where('kabupaten_id',$kab)->where('status','Aktif')->get();
        }
        return response()->json($data);
    }

    public function peserta_kota_select(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kabupaten::Where('nama','LIKE','%' .$search . '%')
            		->get();
        }
        else{
            $data = Kabupaten::orderBy('nama','desc')->limit(10)->get();
        }
        return response()->json($data);
    }

    public function create(Request $request, $id)
    {
        $pelatihan_id   = $id;
        $diklat         = Pelatihan::find($id);
        $diklat_id      = $diklat->id;
        $cabang         = Cabang::find($diklat->cabang_id);
        $kabupaten_id   = $cabang->kabupaten_id;

        return view('tilawatipusat.peserta.create',compact('diklat_id','kabupaten_id','diklat'));
    }

    public function store(Request $request){


        $diklat         = Pelatihan::where('id',$request->pelatihan_id)->first();
        $tanggal        = $diklat->tanggal;
        $kabupaten_id   = $request->kota;
        $kabupaten      = Kabupaten::find($kabupaten_id);
        // $tmptlahir      = Kabupaten::find($request->tmptlahir);
        $tmptlahir      = $request->tmptlahir;
        $kota           = substr($kabupaten->nama,4);
        // $tmptlahir      = substr($tmptlahir->nama,4);
        $lembaga        = Lembaga::where('id',$request->lembaga_id)->first();
        $slug           = Str::slug($request->name.'-'.$diklat->program->name.'-'.Carbon::parse($tanggal)->isoFormat('MMMM-D-Y').'-'.$diklat->cabang->name.'-'.$diklat->cabang->kabupaten->nama);
        
        if ($kabupaten->provinsi->id == null) {
            # code...
            if ($lembaga !== null) {
                # code...
                if ($lembaga->status == 'Aktif') {
                    # code...
                    $data = Peserta::updateOrCreate(
                        [
                          'id' => $request->id
                        ],
                        [
                            'cabang_id' => $diklat->cabang_id,
                            'phonegara_id' => 175,
                            'lembaga_id' => $request->lembaga_id,
                            'pelatihan_id' => $request->pelatihan_id,
                            'program_id' => $diklat->program_id,
                            'tanggal' => $tanggal,
                            'name' => $request->name,
                            'email' => $request->email,
                            'lembaga'=> $request->lembaga,
                            'pos' => $request->pos,
                            'slug' => $slug,
                            'tmptlahir' => $tmptlahir,
                            'tgllahir' => $request->tgllahir,
                            'alamat' => $request->alamat,
                            'telp' => $request->telp,
                            // 'provinsi_id' => $provinsi_id,
                            'kabupaten_id' => $kabupaten_id,
                            'kota' => $kota,
                            // 'kota2' => strtoupper($request->$kota2),
                            'status'=>1
                        ]
                    );
                    $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                    $program_id = $program->program_id;
                    // $qr = \QrCode::size(200)
                    //     ->format('png')
                    //     // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                    //     ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                        return response()->json(
                        [
                           $data,
                          'success' => 'Peserta Baru Berhasil Ditambahkan!',
                          'message' => 'Peserta Baru Berhasil Ditambahkan!'
                        ]
                    );
                }else{
                    $data = 'error Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!';
                    return response()->json(
                        [
                            $data,
                            'error' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!',
                            'message' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!'
                        ]
                    );
                }
            } else {
                # code...
                $data = Peserta::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'cabang_id' => $diklat->cabang_id,
                        'lembaga_id' => $request->lembaga_id,
                        'pelatihan_id' => $request->pelatihan_id,
                        'program_id' => $diklat->program_id,
                        'tanggal' => $tanggal,
                        'name' => $request->name,
                        'email' => $request->email,
                        'tmptlahir' => $tmptlahir,
                        'lembaga'=> $request->lembaga,
                        'tgllahir' => $request->tgllahir,
                        'slug'=>$slug,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kota' => $kota,
                        // 'kota2' => strtoupper($request->$kota2),
                        'status'=>1
                    ]
                );
                $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                $program_id = $program->program_id;
                // $qr = \QrCode::size(100)
                //     ->format('png')
                //     // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                //     ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                    return response()->json(
                    [
                       $data,
                      'success' => 'Peserta Baru Berhasil Ditambahkan!',
                      'message' => 'Peserta Baru Berhasil Ditambahkan!'
                    ]
                );
            }
        }else {
            # code...
            $provinsi_id    = $kabupaten->provinsi->id;
            if ($lembaga !== null) {
                # code...
                if ($lembaga->status == 'Aktif') {
                    # code...
                    $data = Peserta::updateOrCreate(
                        [
                          'id' => $request->id
                        ],
                        [
                            'cabang_id' => $diklat->cabang_id,
                            'phonegara_id' => 175,
                            'lembaga_id' => $request->lembaga_id,
                            'pelatihan_id' => $request->pelatihan_id,
                            'program_id' => $diklat->program_id,
                            'tanggal' => $tanggal,
                            'lembaga'=> $request->lembaga,
                            'name' => $request->name,
                            'email' => $request->email,
                            'pos' => $request->pos,
                            'slug' => $slug,
                            'tmptlahir' => $tmptlahir,
                            'tgllahir' => $request->tgllahir,
                            'alamat' => $request->alamat,
                            'telp' => $request->telp,
                            'provinsi_id' => $provinsi_id,
                            'kabupaten_id' => $kabupaten_id,
                            'kota' => $kota,
                            // 'kota2' => strtoupper($request->$kota2),
                            'status'=>1
                        ]
                    );
                    $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                    $program_id = $program->program_id;
                    // $qr = \QrCode::size(200)
                    //     ->format('png')
                    //     // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                    //     ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                        return response()->json(
                        [
                           $data,
                          'success' => 'Peserta Baru Berhasil Ditambahkan!',
                          'message' => 'Peserta Baru Berhasil Ditambahkan!'
                        ]
                    );
                }else{
                    $data = 'error Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!';
                    return response()->json(
                        [
                            $data,
                            'error' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!',
                            'message' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!'
                        ]
                    );
                }
            } else {
                # code...
                $data = Peserta::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'cabang_id' => $diklat->cabang_id,
                        'lembaga_id' => $request->lembaga_id,
                        'pelatihan_id' => $request->pelatihan_id,
                        'program_id' => $diklat->program_id,
                        'tanggal' => $tanggal,
                        'name' => $request->name,
                        'email' => $request->email,
                        'tmptlahir' => $tmptlahir,
                        'lembaga'=> $request->lembaga,
                        'tgllahir' => $request->tgllahir,
                        'slug'=>$slug,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kota' => $kota,
                        // 'kota2' => strtoupper($request->$kota2),
                        'status'=>1
                    ]
                );
                $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                $program_id = $program->program_id;
                // $qr = \QrCode::size(100)
                //     ->format('png')
                //     // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                //     ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                    return response()->json(
                    [
                       $data,
                      'success' => 'Peserta Baru Berhasil Ditambahkan!',
                      'message' => 'Peserta Baru Berhasil Ditambahkan!'
                    ]
                );
            }
        }
        
    }
    public function delete(Request $request)
    {
        $id     = $request->id;
        $data   =Peserta::find($id);
        //hapus qr
        File::delete('images/'.$data->slug.'.png');
        //hapus data 
        $data->delete();
        return response()->json(
            [
              'success' => 'Peserta Berhasil Dihapus!',
              'message' => 'Peserta Berhasil Dihapus!'
            ]
        );
    }

    public function seluruh_peserta(Request $request)
    {
        // $p = Peserta::whereHas('pelatihan', function($q){
        //     $q->where('keterangan', 'santri');
        // })->count();
        return view('tilawatipusat.peserta.seluruh');
    }

    public function seluruh_peserta_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai')
                ->with('cabang')->with('program')
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                });
                return DataTables::of($data)
                        ->addColumn('check', function ($data) {
                            return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
                        })
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                    $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 >74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (bersyahadah)</a>';
                                    }
                                    
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            // $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn = ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            $actionBtn .= ' <a href="/halaman-update-data-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-primary "><i class="fa fa-edit"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('ttl', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.' - '.$a;
                        })
                        ->addColumn('tempat', function ($data) {
                            $tempat = $data->pelatihan->tempat;
                            return $tempat;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','ttl','check','tempat'])
                ->make(true);
            }else{
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai')->with('cabang')->with('program')
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                });;
                return DataTables::of($data)
                        ->addColumn('check', function ($data) {
                            return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
                        })
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (bersyahadah)</a>';
                                    }
                                   
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge  badge-warning">'.$rata2.' (belum bersyahadah) </a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('ttl', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.' - '.$a;
                        })
                        ->addColumn('action', function($data){
                            // $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn = ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            $actionBtn .= ' <a href="/halaman-update-data-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-primary "><i class="fa fa-edit"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('tempat', function ($data) {
                            $tempat = $data->pelatihan->tempat;
                            return $tempat;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','ttl','check','tempat'])
                ->make(true);
            }
            
        }
    }

    public function seluruh_peserta_data_kabupaten(Request $request, $kabupaten_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('kabupaten_id', $kabupaten_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (bersyahadah)</a>';
                                    }
                                    
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program'])
                ->make(true);
            }else{
                $data   = Peserta::where('kabupaten_id', $kabupaten_id)->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (bersyahadah)</a>';
                                    }
                                    
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program'])
                ->make(true);
            }
            
        }
    }

    public function peserta_kabupaten_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = Peserta::whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Peserta::whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_cabang_program_total(Request $request, $cabang_id)
    {
        if (request()->ajax()) {
            # code...
            if (!empty($request->dari)) {
                # code...
                $data = Peserta::where('cabang_id', $cabang_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }else{
                # code...
                $data = Peserta::where('cabang_id', $cabang_id)
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
    
    public function peserta_program_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $dari = $request->dari;
                $sampai = $request->sampai;
                $data = Program::whereHas('pelatihan', function($q) use ($dari, $sampai) {
                    $q->where('jenis','diklat')->whereBetween('tanggal', array($dari, $sampai));
                })->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Program::whereHas('pelatihan', function($q)  {
                    $q->where('jenis','diklat');
                })->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_total_data(Request $request, $kabupaten_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_total_cabang(Request $request, $kabupaten_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_cabang_total(Request $request,$cabang_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                    
                })
                ->addColumn('action', function ($data) {
                    if ($data->kabupaten !== null) {
                        $btn = '<a href="/diklat-peserta-data-kabupaten/'.$data->kabupaten->id.'" class="btn btn-sm btn-info"> check </a>';
                        return $btn;
                    }else{
                        return '-';
                    }
                    
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }else{
                $data   = Peserta::with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->kabupaten !== null) {
                        $btn = '<a href="/diklat-peserta-data-kabupaten/'.$data->kabupaten->id.'" class="btn btn-sm btn-info"> check </a>';
                        return $btn;
                    }else{
                        return '-';
                    }
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }
        }
    }

    public function peserta_kabupaten_view(Request $request, $kabupaten_id)
    {
        $kabupaten = Kabupaten::find($kabupaten_id);
        return view('tilawatipusat.peserta.kabupaten',compact('kabupaten'));
    }

    public function peserta_kabupaten_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('cabang_id',$cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }else{
                $data   = Peserta::where('cabang_id',$cabang_id)->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }
        }
    }

    public function peserta_cabang_pilih(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Cabang::withCount('pelatihan')->orderBy('pelatihan_count','desc')->with(['pelatihan' => function ($query) use($request) {
                    $query->where('jenis','diklat')->whereBetween('tanggal', array($request->dari, $request->sampai));
                }]);

                return DataTables::of($data)
                ->addColumn('cabang', function($data){
                    $kabs = $data->kabupaten->nama;
                    return "<pre>$data->name - $kabs</pre>";
                })
                ->addColumn('jumlahdiklat', function($data){
                    $total_diklat = $data->pelatihan->count();
                    return "<pre>$total_diklat diklat</pre>";
                })
                ->addColumn('namadiklat', function($data) use($request) {
                    $dataz = [];
                    foreach ($data->pelatihan as $key => $value) {
                        # code...
                        $datax  = Program::where('id',$value->program_id)->first();                        
                        $dataz[$key] = $datax->id;
                    }
                    $programs = Program::whereIn('id',$dataz)->distinct()->get();
                    
                    $hasil = [];
                    $totals= [];
                    foreach ($programs as $key => $value) {
                        # code...
                        $total      = $data->pelatihan->where('program_id',$value->id)->count();
                        $peserta    = Peserta::where('cabang_id', $data->id)->where('program_id',$value->id)->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                        $keterangan = Pelatihan::where('program_id',$value->id)->select('keterangan')->first();
                        $hasil[]    = "<pre>$total diklat   $value->name  ($peserta $keterangan->keterangan)</pre>";
                    }
                    return $string=implode("<br>",$hasil);               
                })
                ->addColumn('total_guru', function($data) use($request) {
                    $dataz = [];
                    $pelatihan_guru     = Pelatihan::where('cabang_id', $data->id)->where('jenis','diklat')->where('keterangan', 'guru')->whereBetween('tanggal', array($request->dari, $request->sampai))
                                        ->whereHas('program',function($q){
                                            $q->where('jenisprogram','guru');
                                        })->get();

                    foreach ($pelatihan_guru as $key => $value) {
                        # code...
                        $dataz[] = $value->peserta->count();
                    }
                    $guru = array_sum($dataz);

                    return '<pre>Guru : '.$guru.'</pre>';
                })
                ->addColumn('total_santri', function($data) use($request) {
                   
                    $datax = [];
                    $pelatihan_santri   = Pelatihan::where('cabang_id', $data->id)->whereBetween('tanggal', array($request->dari, $request->sampai))->whereHas('program',function($q){
                        $q->where('jenisprogram','santri');
                    })->get();

                    foreach ($pelatihan_santri as $key => $value) {
                        # code...
                        $datax[] = $value->peserta->count();
                    }
                    $santri = array_sum($datax);

                    return '<pre>Santri : '.$santri.'</pre>';
                })
                ->addColumn('kpa', function($data){
                    $kpa = $data->kpa->count();
                    $update = KPA::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($update !== null) {
                        # code...
                        return '<pre>'.$kpa.' (KPA) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                    }else {
                        return '-';
                    }
                })
                ->addColumn('munaqisy', function($data){
                    $munaqisy = $data->munaqisy->count();
                    $trainer_munaqisy = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Munaqisy');
                    })->count();
                    $update = Munaqisy::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    $total = $munaqisy + $trainer_munaqisy;
                    if ($total > 0) {
                        # code...
                        // return '<pre>'.$total.' (Munaqisy) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$total.' (Munaqisy)</pre>';
                    }else{
                        return '-';
                    }
                })
                ->addColumn('trainer', function($data){
                    $trainer = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Instruktur Strategi')->orWhere('jenis','Instruktur Lagu');
                    })->count();
                    $update = Trainer::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($trainer > 0) {
                        # code...
                        // return '<pre>'.$trainer.' (Trainer) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$trainer.' (Trainer) </pre>';
                    }else{
                        return '-';
                    }
                })
                ->addColumn('supervisor', function($data){
                    $supervisor = $data->supervisor->count();
                    $trainer_supervisor = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Supervisor');
                    })->count();
                    $total = $supervisor + $trainer_supervisor;
                    $update = Supervisor::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($total > 0) {
                        # code...
                        // return '<pre>'.$supervisor.' (Supervisor) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$total.' (Supervisor)</pre>';
                    }else{
                        return '-';
                    }
                })
                ->rawColumns(['cabang','jumlahdiklat','namadiklat','total_guru','total_santri','kpa','munaqisy','trainer','supervisor'])->make(true);

            }else{

                $data = Cabang::withCount('pelatihan')->orderBy('pelatihan_count','desc')->with(['pelatihan' => function ($query) use($request) {
                    $query->where('jenis','diklat');
                }]);

                return DataTables::of($data)
                ->addColumn('cabang', function($data){
                    $kabs = $data->kabupaten->nama;
                    return "<pre>$data->name - $kabs</pre>";
                })
                ->addColumn('jumlahdiklat', function($data){
                    $total_diklat = $data->pelatihan->count();
                    return "<pre>$total_diklat diklat</pre>";
                })
                ->addColumn('namadiklat', function($data){
                    $dataz = [];
                    foreach ($data->pelatihan as $key => $value) {
                        # code...
                        $datax  = Program::where('id',$value->program_id)->first();                        
                        $dataz[$key] = $datax->id;
                    }
                    $programs = Program::whereIn('id',$dataz)->distinct()->get();
                    
                    foreach ($programs as $key => $value) {
                        # code...
                        $total      = $data->pelatihan->where('program_id',$value->id)->count();
                        $peserta    = Peserta::where('cabang_id', $data->id)->where('program_id',$value->id)->count();
                        $keterangan = Pelatihan::where('program_id',$value->id)->select('keterangan')->first();
                        $hasil[]    = "<pre>$total diklat   $value->name  ($peserta $keterangan->keterangan)</pre>";
                    }
                    return $string=implode("<br>",$hasil);                    
                })
                ->addColumn('total_guru', function($data){
                    $dataz = [];
                    $pelatihan_guru     = Pelatihan::where('cabang_id', $data->id)->whereHas('program', function($q){
                        $q->where('jenisprogram','guru');
                    })->get();

                    foreach ($pelatihan_guru as $key => $value) {
                        # code...
                        $dataz[] = $value->peserta->count();
                    }
                    $guru = array_sum($dataz);

                    return '<pre>Guru : '.$guru.'</pre>';
                })
                ->addColumn('kpa', function($data){
                    $kpa = $data->kpa->count();
                    $update = KPA::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($update !== null) {
                        # code...
                        return '<pre>'.$kpa.' (KPA) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                    }else {
                        return '-';
                    }
                })
                ->addColumn('munaqisy', function($data){
                    $munaqisy = $data->munaqisy->count();
                    $trainer_munaqisy = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Munaqisy');
                    })->count();
                    $update = Munaqisy::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    $total = $munaqisy + $trainer_munaqisy;
                    if ($total > 0) {
                        # code...
                        // return '<pre>'.$total.' (Munaqisy) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$total.' (Munaqisy)</pre>';
                    }else{
                        return '-';
                    }
                })
                ->addColumn('trainer', function($data){
                    $trainer = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Instruktur Strategi')->orWhere('jenis','Instruktur Lagu');
                    })->count();
                    $update = Trainer::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($trainer > 0) {
                        # code...
                        // return '<pre>'.$trainer.' (Trainer) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$trainer.' (Trainer) </pre>';
                    }else{
                        return '-';
                    }
                })
                ->addColumn('supervisor', function($data){
                    $supervisor = $data->supervisor->count();
                    $trainer_supervisor = Trainer::where('cabang_id', $data->id)->whereHas('macamtrainer', function($q){
                        $q->where('jenis','Supervisor');
                    })->count();
                    $total = $supervisor + $trainer_supervisor;
                    $update = Supervisor::orderBy('updated_at','desc')->where('cabang_id', $data->id)->first();
                    if ($total > 0) {
                        # code...
                        // return '<pre>'.$supervisor.' (Supervisor) - '.\Carbon\Carbon::parse($update->updated_at)->format('M Y').'</pre>';
                        return '<pre>'.$total.' (Supervisor)</pre>';
                    }else{
                        return '-';
                    }
                })
                ->addColumn('total_santri', function($data){
                    $datax = [];
                    $pelatihan_santri   = Pelatihan::where('cabang_id', $data->id)->whereHas('program',function($q){
                        $q->where('jenisprogram','santri');
                    })->get();

                    foreach ($pelatihan_santri as $key => $value) {
                        # code...
                        $datax[] = $value->peserta->count();
                    }
                    $santri = array_sum($datax);

                    return '<pre>Santri : '.$santri.'</pre>';
                })
                ->rawColumns(['cabang','jumlahdiklat','namadiklat','total_guru','total_santri','kpa','munaqisy','trainer','supervisor'])->make(true);
                
            }
        }
    }

    public function peserta_cabang_program_pilih(Request $request,$cabang_id)
    {
        $cabang_id = $cabang_id;
        if(request()->ajax())
        {
            //datatable
            $cabang_id = $cabang_id;
            if(!empty($request->dari))
            {
                # code...
                $cabang = Cabang::find($cabang_id);
                $data   = Peserta::where('cabang_id',$cabang_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->with('program')->select('program_id')->distinct();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/halaman-data-peserta-berdasarkan-cabang-dan-program/'.$cabang->id.'/'.$data->program_id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }else {
                # code...
                $cabang = Cabang::where('id',$cabang_id)->first();
                $data   = Peserta::where('cabang_id',$cabang_id)
                ->select('program_id')->distinct()
                ->with('program','cabang');
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/halaman-data-peserta-berdasarkan-cabang-dan-program/'.$cabang_id.'/'.$data->program->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }
        }
    }

    public function peserta_program_pilih(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                // $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('program')->select('program_id')->distinct();
                // return DataTables::of($data)
                // ->addColumn('program', function ($data) {
                //     return $data->program->name;
                // })
                // ->addColumn('action', function ($data) {
                //     $btn = '<a href="/diklat-peserta-diklat-program/'.$data->program->id.'" class="btn btn-sm btn-info"> check </a>';
                //     return $btn;
                // })
                // ->rawColumns(['program','action'])
                // ->make(true);

                // $data = Program::whereBetween('tanggal', array($request->dari, $request->sampai))->with('peserta')->get();
                $data = Program::has('peserta')->with(['peserta' => function ($query) use($request) {
                    $query->whereBetween('tanggal', array($request->dari, $request->sampai));
                }])->where('status',1)->get();
                
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    $program = $data->name;
                    return $program;
                })
                ->addColumn('total_semua', function ($data) {
                    $total_semua = $data->peserta->count();
                    return $total_semua;
                })
                ->addColumn('total_lulus', function($data){
                    $total_lulus = $data->peserta->where('bersyahadah',1)->count();
                    return $total_lulus;
                })
                ->addColumn('total_belum', function($data){
                    $total_semua = $data->peserta->count();
                    $total_lulus = $data->peserta->where('bersyahadah',1)->count();
                    $total_belum = $total_semua - $total_lulus;
                    return $total_belum;
                })
                ->rawColumns(['program','total_semua','total_lulus','total_belum'])
                ->make(true);
            }else{
                // $data   = Peserta::with('program')->select('program_id')->distinct();
                // return DataTables::of($data)
                // ->addColumn('program', function ($data) {
                //     return $data->program->name;
                // })
                // ->addColumn('action', function ($data) {
                //     $btn = '<a href="/diklat-peserta-diklat-program/'.$data->program->id.'" class="btn btn-sm btn-info"> check </a>';
                //     return $btn;
                // })
                // ->rawColumns(['program','action'])
                // ->make(true);
                $data = Program::has('peserta')->with('peserta')->where('status',1)->get();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    $program = $data->name;
                    return $program;
                })
                ->addColumn('total_semua', function ($data) {
                    $total_semua = $data->peserta->count();
                    return $total_semua;
                })
                ->addColumn('total_lulus', function($data){
                    $total_lulus = $data->peserta->where('bersyahadah',1)->count();
                    return $total_lulus;
                })
                ->addColumn('total_belum', function($data){
                    $total_semua = $data->peserta->count();
                    $total_lulus = $data->peserta->where('bersyahadah',1)->count();
                    $total_belum = $total_semua - $total_lulus;
                    return $total_belum;
                })
                ->rawColumns(['program','total_semua','total_lulus','total_belum'])
                ->make(true);
            }
        }
    }

    public function peserta_kabupaten_cabang_pilih(Request $request, $kabupaten_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::where('jenis','diklat')->where('kabupaten_id', $kabupaten_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-cabang/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }else{
                $data   = Peserta::where('kabupaten_id',$kabupaten_id)->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
                // $data = Cabang::has('peserta')->with(['peserta' => function ($query) use($request) {
                //     $query->pelatihan->where('jenis','diklat');
                // }]);
                // return DataTables::of($data)
                // ->addColumn('cabang',function($data){
                //     return $data->name;
                // })
                // ->addColumn('action',function($data){
                //     return $data->peserta->count();
                // })
                // ->rawColumns(['cabang','action'])
                // ->make(true);
            }
        }
    }

    public function peserta_cabang(Request $request, $cabang_id)
    {
        $cabang = Cabang::find($cabang_id);
        return view('tilawatipusat.peserta.cabang',compact('cabang'));
    }

    public function peserta_program(Request $request, $program_id)
    {
        $program = Program::find($program_id);
        return view('tilawatipusat.peserta.program',compact('program'));
    }

    public function peserta_program_data(Request $request, $program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('program_id', $program_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai')->with('cabang');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                    }
                                   
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('keterangan', function ($data) {
                            if ($data->bersyahadah == 1) {
                                # lulus code...
                                return '<span class="badge badge-success">Bersyahadah</span>';
                            }else {
                                # tidak lulus code...
                                return '<span class="badge badge-danger">Belum Bersyahadah</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        // ->addColumn('action', function($data){
                        //     $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                        //     $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                        //     return $actionBtn;
                        // })
                ->rawColumns(['nilai','kabupaten','keterangan','tgllahir'])
                ->make(true);
            }else{
                $data   = Peserta::where('program_id', $program_id)->with('pelatihan')->with('kabupaten')->with('nilai')->with('cabang');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                    $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;

                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                    }
                                    
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('keterangan', function ($data) {
                            if ($data->bersyahadah == 1) {
                                # lulus code...
                                return '<span class="badge badge-success">Bersyahadah</span>';
                            }else {
                                # tidak lulus code...
                                return '<span class="badge badge-danger">Belum Bersyahadah</span>';
                            }
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        // ->addColumn('action', function($data){
                        //     $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                        //     $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                        //     $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                        //     return $actionBtn;
                        // })
                ->rawColumns(['nilai','kabupaten','tgllahir','keterangan'])
                ->make(true);
            }
            
        }
    }

    public function peserta_cabang_data(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('cabang_id', $cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->with(['pelatihan','kabupaten','nilai','cabang','program']);
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.' - '.$a;
                        })
                        ->addColumn('action', function($data){
                            // $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn = ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','tgllahir'])
                ->make(true);
            }else{
                $data   = Peserta::where('cabang_id', $cabang_id)
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->with(['pelatihan','kabupaten','nilai','cabang','program']);
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $ratax = ($total + $total2)/($total3+1);
                                    $rata2 = $total;
                                    if ($rata2 > 74) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' mengaji & '.$ratax.' rata-rata (bersyahadah)</a>';
                                    }
                                    
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' mengaji & '.$ratax.' rata-rata (belum bersyahadah)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.' - '.$a;
                        })
                        ->addColumn('action', function($data){
                            // $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn = ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','tgllahir'])
                ->make(true);
            }
            
        }
    }

    public function add_tgl(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->peserta_id !== null) {
                # code...
                $pes_id = $request->peserta_id;
                $tgl = $request->tgllahir;
                $data = Peserta::where('id',$pes_id)->update([
                    'tgllahir' => $tgl
                ]);
                return response()->json(
                    [
                    'success' => 'Data Tangal Lahir Peserta Berhasil Diperbarui',
                    'message' => 'Data Tangal Lahir Peserta Berhasil Diperbarui'
                    ]
                );
            }else{
               
                return response()->json(
                    [
                    'error' => 'Jangan diurutkan berdasarkan kabupaten',
                    'message' => 'Tidak bisa merubah data apabila diurutkan berdasarkan kabupaten yang kosong'
                    ]
                );
            }
        }
    }

    public function add_kota(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->peserta_id !== null) {
                # code...
                $pes_id = $request->peserta_id;
                $kab_id = $request->sel_kab;
                $data = Peserta::where('id',$pes_id)->update([
                    'kabupaten_id' => $kab_id
                ]);
                return response()->json(
                    [
                    'success' => 'Data Kota Peserta Berhasil Diperbarui',
                    'message' => 'Data Kota Peserta Berhasil Diperbarui'
                    ]
                );
            }else{
               
                return response()->json(
                    [
                    'error' => 'Jangan diurutkan berdasarkan kabupaten',
                    'message' => 'Tidak bisa merubah data apabila diurutkan berdasarkan kabupaten yang kosong'
                    ]
                );
            }
        }
    }

    public function add_kota2(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->peserta_id !== null) {
                # code...
                $pes_id = $request->peserta_id;
                $kab_id = $request->sel_kab;
                $tmptlahir = Kabupaten::where('id',$kab_id)->first();
                $data = Peserta::where('id',$pes_id)->update([
                    'tmptlahir' => $tmptlahir->nama
                ]);
                return response()->json(
                    [
                    'success' => 'Data Kota Peserta Berhasil Diperbarui',
                    'message' => 'Data Kota Peserta Berhasil Diperbarui'
                    ]
                );
            }else{
               
                return response()->json(
                    [
                    'error' => 'Jangan diurutkan berdasarkan kabupaten',
                    'message' => $kab_id.'Tidak bisa merubah data apabila diurutkan berdasarkan kabupaten yang kosong'
                    ]
                );
            }
        }
    }

    public function add_kota3(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->peserta_id !== null) {
                # code...
                $pes_id = $request->peserta_id;
                $kab_id = $request->sel_kab;
                $tmptlahir = Kabupaten::where('id',$kab_id)->first();
                $data = Peserta::where('id',$pes_id)->update([
                    'tmptlahir' => $tmptlahir->nama
                ]);
                return response()->json(
                    [
                    'success' => 'Data Kota Peserta Berhasil Diperbarui',
                    'message' => 'Data Kota Peserta Berhasil Diperbarui'
                    ]
                );
            }else{
               
                return response()->json(
                    [
                    'error' => 'Jangan diurutkan berdasarkan kabupaten',
                    'message' => 'Tidak bisa merubah data apabila diurutkan berdasarkan kabupaten yang kosong'
                    ]
                );
            }
        }
    }

    public function peserta_yang_kabupatennya_kosong(Request $request, $pelatihan_id)
    {
        if(request()->ajax())
        {
            $data = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
            return response()->json($data,200);
        }
    }

    public function update_peserta_view($peserta_id)
    {
        $peserta = Peserta::find($peserta_id);
        return view('tilawatipusat.peserta.update',compact('peserta'));
    }

    public function update_data_peserta(Request $request)
    {
        $telp           = $request->kode.$request->phone;
        $telp1          = $request->kode1.$request->phone1;
        $dpp            = $request->pelatihan_id;
        $dp             = Peserta::where('id',$request->id)->first();
        $kabupaten_kota = Kabupaten::where('id',$request->kabupaten_id)->first();
        $tempatlahir    = Kabupaten::where('id',$request->tmptlahir)->first();
        $slug           = Str::slug($request->name.'-'.$dp->program->name.'-'.
                          Carbon::parse($dp->tanggal)->isoFormat('D-MMMM-Y').'-'.$dp->cabang->name.'-'.
                          $dp->cabang->kabupaten->nama);

        if (auth()->user()->role=='cabang') {
            # code...
            if ($kabupaten_kota == null) {
                # code...
                if ($tempatlahir == null) {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            // 'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            // 'kabupaten_id'  => $kabupaten_kota->id,
                            // 'kecamatan_id'  => $request->kecamatan_id,
                            // 'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            // 'tmptlahir'     => $tempatlahir->nama,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            // 'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'jilid'         => $request->jilid,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }else {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            // 'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            // 'kabupaten_id'  => $kabupaten_kota->id,
                            // 'kecamatan_id'  => $request->kecamatan_id,
                            // 'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tmptlahir'     => $tempatlahir->nama,
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            // 'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'jilid'         => $request->jilid,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }

            } else {
                # code...
                if ($tempatlahir == null) {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            'kabupaten_id'  => $kabupaten_kota->id,
                            'kecamatan_id'  => $request->kecamatan_id,
                            'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            // 'tmptlahir'     => $tempatlahir->nama,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'jilid'         => $request->jilid,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }else {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            'kabupaten_id'  => $kabupaten_kota->id,
                            'kecamatan_id'  => $request->kecamatan_id,
                            'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tmptlahir'     => $tempatlahir->nama,
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'jilid'         => $request->jilid,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }
            }
        }else {
            # code...
            if ($kabupaten_kota == null) {
                # code...
                if ($tempatlahir == null) {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            // 'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            // 'kabupaten_id'  => $kabupaten_kota->id,
                            // 'kecamatan_id'  => $request->kecamatan_id,
                            // 'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            // 'tmptlahir'     => $tempatlahir->nama,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            // 'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'bersyahadah'   => $request->bersyahadah,
                            'jilid'         => $request->jilid,
                            'kriteria'      => $request->kriteria,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }else {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            // 'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            // 'kabupaten_id'  => $kabupaten_kota->id,
                            // 'kecamatan_id'  => $request->kecamatan_id,
                            // 'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tmptlahir'     => $tempatlahir->nama,
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            // 'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'bersyahadah'   => $request->bersyahadah,
                            'jilid'         => $request->jilid,
                            'kriteria'      => $request->kriteria,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }

            } else {
                # code...
                if ($tempatlahir == null) {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            'kabupaten_id'  => $kabupaten_kota->id,
                            'kecamatan_id'  => $request->kecamatan_id,
                            'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            // 'tmptlahir'     => $tempatlahir->nama,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'bersyahadah'   => $request->bersyahadah,
                            'jilid'         => $request->jilid,
                            'kriteria'      => $request->kriteria,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }else {
                    # code...
                    $peserta                = Peserta::updateOrCreate(
                        [
                            'id'            => $request->id
                        ],
                        [
                            'nik'           => $request->nik,
                            // 'phonegara_id'  => $kode_negara,
                            // 'pelatihan_id'  => $request->pelatihan_id,
                            // 'program_id'    => $diklat->program_id,
                            // 'cabang_id'     => $diklat->cabang->id,
                            'lembaga_id'    => $request->lembaga_id,
                            'provinsi_id'   => $kabupaten_kota->provinsi_id,
                            'kabupaten_id'  => $kabupaten_kota->id,
                            'kecamatan_id'  => $request->kecamatan_id,
                            'kelurahan_id'  => $request->kelurahan_id,
                            // 'slug'          => $slug,
                            'tanggal'       => $dp->tanggal,
                            'name'          => $request->name,
                            'gelar'         => $request->gelar,
                            'tmptlahir2'    => strtoupper($request->tmptlahir2),
                            'tmptlahir'     => $tempatlahir->nama,
                            'tgllahir'      => $request->tgllahir,
                            'alamat'        => $request->alamat,
                            'alamatx'       => $request->alamatx,
                            'kota'          => $kabupaten_kota->nama,
                            'kota2'         => strtoupper($request->kota2),
                            'telp'          => $request->phone,
                            'pos'           => $request->pos,
                            'email'         => $request->email,
                            'bersyahadah'   => $request->bersyahadah,
                            'jilid'         => $request->jilid,
                            'kriteria'      => $request->kriteria,
                            'munaqisy'      => $request->munaqisy,
                            'asal_cabang'   => $request->asal_cabang,
                        ]
                    );
                }
            }
        }
        return redirect()->back()->with('success','Data Berasil Diperbarui');
    }

    public function syahadah(Request $request, $program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::where('program_id', $program_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $data2  = Peserta::where('program_id', $program_id)->where('bersyahadah', 1)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $data3  = ($data - $data2);
        
                $result = $data2.'- telah bersyahadah & '.$data3.'- belum bersyahadah';
                return response()->json($result,200);
            }else{
                $data = Peserta::where('program_id', $program_id)->count();
                $data2  = Peserta::where('program_id', $program_id)->where('bersyahadah', 1)->count();
                $data3  = ($data - $data2);
        
                $result = $data2.'- telah bersyahadah & '.$data3.'- belum bersyahadah';
                return response()->json($result,200);
            }
        }
    }

    public function total_peserta_program(Request $request,$program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::where('program_id', $program_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                return response()->json($data,200);
            }else{
                $data = Peserta::where('program_id', $program_id)->count();
                return response()->json($data,200);
            }
        }
    }

    public function total_seluruh_peserta_bersyahadah(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();
                $result1    = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->where('bersyahadah',1)->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();

                $result2    = $data - $result1;
                $hasil      = '<span class="text-info">'.$result1.'</span>'.' & '.'<span class="text-danger">'.$result2.'</span>';
                return response()->json($hasil,200);

            }else{
                $data = Peserta::whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();
                $result1    = Peserta::where('bersyahadah',1)->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();

                $result2    = $data - $result1;
                $hasil      = '<span class="text-info">'.$result1.'</span>'.' & '.'<span class="text-danger">'.$result2.'</span>';
                return response()->json($hasil,200);
            }
        }
    }

    public function total_seluruh_peserta_cabang_bersyahadah(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::where('cabang_id',$cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();
                $result1    = Peserta::where('cabang_id',$cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->where('bersyahadah',1)->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();

                $result2    = $data - $result1;
                $hasil      = '<span class="text-info">'.$result1.'</span>'.' & '.'<span class="text-danger">'.$result2.'</span>';
                return response()->json($hasil,200);

            }else{
                $data = Peserta::where('cabang_id',$cabang_id)->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();
                $result1    = Peserta::where('cabang_id',$cabang_id)->where('bersyahadah',1)->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })->get()->count();

                $result2    = $data - $result1;
                $hasil      = '<span class="text-info">'.$result1.'</span>'.' & '.'<span class="text-danger">'.$result2.'</span>';
                return response()->json($hasil,200);
            }
        }
    }

    // percabangan laporan data peserta 

    public function halaman_peserta_cabang_program($cabang_id, $program_id)
    {
        $cabang = Cabang::find($cabang_id);
        $program= Program::find($program_id);
        return view('tilawatipusat.peserta.cabang_program',compct('cabang','program'));
    }

    public function minta_modul($pelatihan_id)
    {
        $pelatihan = Pelatihan::find($pelatihan_id);
        $data = Peserta::where('pelatihan_id',$pelatihan_id)->where('bersyahadah',1)->where('alamatx',null)->get();
        // SEND WA
        foreach ($data as $key => $value) {
            # code...
            $curl = curl_init();
                $token = "dyr07JcBSmVsb1YrVBTB2A5zNKor0BZ9krv2WnQsjWHG1CRhSktdqazkfuOSY9qh";
                $datas = [
                    'phone' => $value->telp,
                    'message' => '*PENGIRIMAN SYAHADAH TILAWATI PUSAT - '.strtoupper($pelatihan->program->name).'*. *Yth. '.$value->name.'*.
                    
                    *PESAN*
                    Dimohon Ustadz / Ustadzah menginformasikan untuk Alamat Pengiriman Syahadah / Ijazah paling lambat pada pukul 12 siang hari ini.
                    
                    *ALAMAT PENGIRIMAN*
                    ...
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
                curl_setopt($curl, CURLOPT_URL, "https://simo.wablas.com/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);
        }

        return $data;
    }

    public function program_cabang_pilih(Request $request)
    {
        if ($request->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                # code...
                $dari = $request->dari;
                $sampai = $request->sampai;
                $data = Program::whereHas('pelatihan',function($q) use ($dari, $sampai){
                    $q->where('jenis','diklat')->whereBetween('tanggal', array($dari, $sampai));
                })->distinct()->get();
                return DataTables::of($data)
                ->addColumn('total', function ($data) use ($dari, $sampai)  {
                    return $data->pelatihan->whereBetween('tanggal', array($dari, $sampai))->count().' - '.$data->jenisprogram;
                })
                ->addColumn('totalpeserta', function ($data) use ($dari, $sampai){
                    return $data->peserta->whereBetween('tanggal', array($dari, $sampai))->count().' - '.$data->jenisprogram;
                })
                ->rawColumns(['total','totalpeserta'])
                ->make(true);

            }else {
                # code...
                $data = Program::whereHas('pelatihan',function($q){
                    $q->where('jenis','diklat');
                })->distinct()->get();
                return DataTables::of($data)
                ->addColumn('total', function ($data) {
                    return $data->pelatihan->count().' - '.$data->jenisprogram;
                })
                ->addColumn('totalpeserta', function ($data){
                    return $data->peserta->count().' - '.$data->jenisprogram;
                })
                ->rawColumns(['total','totalpeserta'])
                ->make(true);
            }
        }
    }

}
