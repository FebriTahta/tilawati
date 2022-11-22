<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Cabang;
use App\Models\Lembaga;
use App\Models\Trainer;
use App\Models\Peserta;
use App\Models\Kpa;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Munaqisy;
use App\Models\Supervisor;
use Response;
use Illuminate\Http\Request;

class DashboardCont extends Controller
{
    public function index()
    {
        $cabang  = Cabang::count();
        $lembaga = Lembaga::count();
        $santri  = Peserta::whereHas('pelatihan',function($query){
            $query->where('keterangan','santri');
        })->count();
        $guru    = Peserta::whereHas('pelatihan',function($query){
            $query->where('keterangan','guru');
        })->count();
        $instruktur = Peserta::whereHas('pelatihan',function($query){
            $query->where('keterangan','instruktur');
        })->count();
        $trainer = Trainer::count();
        $kpa     = Kpa::count();
        $munaqisy= Munaqisy::count();
        $supervisor = Supervisor::count();
        $diklat = Pelatihan::orderBy('tanggal','desc')->limit(5)->get();
        $diklat_ini = $diklat->count();


        $trainer_munaqisy = Trainer::whereHas('macamtrainer', function($q){
            $q->where('jenis','Munaqisy');
        })->count();

        $trainer_supervisor = Trainer::whereHas('macamtrainer', function($q){
            $q->where('jenis','Supervisor');
        })->count();

        $trainer_instruktur = Trainer::whereHas('macamtrainer', function($q){
            $q->where('jenis','Instruktur Strategi')->orWhere('jenis','Instruktur Lagu');
        })->count();

        $total_munaqisy = $munaqisy + $trainer_munaqisy;
        $total_supervisor = $supervisor + $trainer_supervisor;

        return view('tilawatipusat.dashboard.index',compact('diklat','diklat_ini','cabang','santri','guru','lembaga','trainer','kpa','instruktur','supervisor','munaqisy','trainer_munaqisy','total_munaqisy','total_supervisor','trainer_instruktur'));
    }

    public function generate(Request $request){

        $user = User::updateOrCreate([
            'username' => 'test'
        ],
        [
            'username' => 'test',
            'role' => 'pusat',
            'email' => 'admin@admin.com',
            'password' => Hash::make('tester'),
        ]);

        return redirect()->back();
    }

    public function generate_qr_tilawati(Request $request)
    {
        $url = $request->url;
        \QrCode::size(150)
        ->format('png') 
        ->generate($url, public_path('images/tilawati_qr.png'));

        $filepath = public_path('images/tilawati_qr.png');
        return response()->download($filepath);
        // return response()->json(
        //     [
        //         'success' => 'QR Dibuat',
        //         'message' => 'QR Dibuat'
        //     ]
        // );
    }

    public function download_qr_tilawati(Request $request)
    {
        $filepath = public_path('images/tilawati_qr.png');
        return Response::download($filepath);
    }

    public function lembaga_formal(Request $request)
    {
        if ($request->ajax()) {
            $formal_tk = Lembaga::where('jenjang','PAUD/KB')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUD')
                    ->orWhere('jenjang','TK-TPA')
                    ->orWhere('jenjang','TK - TPA')
                    ->orWhere('jenjang','TK,MI')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','PG/TK')
                    ->orWhere('jenjang','TK/KB')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUDQU')
                    ->orWhere('jenjang','TK PAUD')
                    ->count();
            $formal_sd = Lembaga::where('jenjang','SD/MI')
                    ->orWhere('jenjang','SD')
                    ->orWhere('jenjang','MI')
                    ->orWhere('jenjang','MI/MTs/MA')
                    ->orWhere('jenjang','MI.')
                    ->orWhere('jenjang','MINU')
                    ->orWhere('jenjang','MIT')
                    ->orWhere('jenjang','SDI')
                    ->orWhere('jenjang','SEKOLAH DASAR ISLAM')
                    ->count();
            $formal_smp = Lembaga::where('jenjang','SMP')
                    ->orWhere('jenjang','SMP/MTs')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMP/SMA')
                    ->orWhere('jenjang','MTSN')
                    ->orWhere('jenjang','MTS')
                    ->orWhere('jenjang','MI/MTS/MA')
                    ->count();
            $formal_sma = Lembaga::where('jenjang','SMA')
                    ->orWhere('jenjang','SMA/MA')
                    ->orWhere('jenjang','SMA IT')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMK')
                    ->count();
            $formal_ptn = Lembaga::where('jenjang','Perguruan Tinggi')
                    ->orWhere('jenjang','Perguruai Tinggi')
                    ->orWhere('jenjang','PT')
                    ->orWhere('jenjang','PTS')
                    ->orWhere('jenjang','UIN')
                    ->count();
            
            $formal_total = $formal_tk + $formal_sd + $formal_smp + $formal_sma + $formal_ptn;
            $tk     = ($formal_tk / $formal_total) * 100;
            $sd     = ($formal_sd / $formal_total) * 100;
            $smp    = ($formal_smp / $formal_total) * 100;
            $sma    = ($formal_sma / $formal_total) * 100;
            $ptn    = ($formal_ptn / $formal_total) * 100;

            return response()->json(
                [
                    'status'        => 200,
                    'formal_tk'     => $tk,
                    'formal_sd'     => $sd,
                    'formal_smp'    => $smp,
                    'formal_sma'    => $sma,
                    'formal_ptn'    => $ptn,
                    'message'       => 'chart lembaga formal'
                ]
            );
        }
    }

    public function lembaga_non_formal(Request $request)
    {
        if ($request->ajax()) {                
            
            //FORMAL
            $formal_tk = Lembaga::where('jenjang','PAUD/KB')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUD')
                    ->orWhere('jenjang','TK-TPA')
                    ->orWhere('jenjang','TK - TPA')
                    ->orWhere('jenjang','TK,MI')
                    ->orWhere('jenjang','TK/RA')
                    ->orWhere('jenjang','PG/TK')
                    ->orWhere('jenjang','TK/KB')
                    ->orWhere('jenjang','KB')
                    ->orWhere('jenjang','PAUDQU')
                    ->orWhere('jenjang','TK PAUD')
                    ->count();
            $formal_sd = Lembaga::where('jenjang','SD/MI')
                    ->orWhere('jenjang','SD')
                    ->orWhere('jenjang','MI')
                    ->orWhere('jenjang','MI/MTs/MA')
                    ->orWhere('jenjang','MI.')
                    ->orWhere('jenjang','MINU')
                    ->orWhere('jenjang','MIT')
                    ->orWhere('jenjang','SDI')
                    ->orWhere('jenjang','SEKOLAH DASAR ISLAM')
                    ->count();
            $formal_smp = Lembaga::where('jenjang','SMP')
                    ->orWhere('jenjang','SMP/MTs')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMP/SMA')
                    ->orWhere('jenjang','MTSN')
                    ->orWhere('jenjang','MTS')
                    ->orWhere('jenjang','MI/MTS/MA')
                    ->count();
            $formal_sma = Lembaga::where('jenjang','SMA')
                    ->orWhere('jenjang','SMA/MA')
                    ->orWhere('jenjang','SMA IT')
                    ->orWhere('jenjang','SMP - SMA')
                    ->orWhere('jenjang','SMK')
                    ->count();
            $formal_ptn = Lembaga::where('jenjang','Perguruan Tinggi')
                    ->orWhere('jenjang','Perguruai Tinggi')
                    ->orWhere('jenjang','PT')
                    ->orWhere('jenjang','PTS')
                    ->orWhere('jenjang','UIN')
                    ->count();
            
            $formal_total = $formal_tk + $formal_sd + $formal_smp + $formal_sma + $formal_ptn;

            $non_formal_pondok = Lembaga::where('jenjang','PONDOK')
                    ->orWhere('jenjang','PONDOK PESANTREN')
                    ->orWhere('jenjang','PONPES')
                    ->orWhere('jenjang','RUMAH TAHFIDZ')
                    ->orWhere('jenjang',"RUMAH QUR'AN")
                    ->orWhere('jenjang','PONPES')
                    ->orWhere('jenjang','RUMAH TAHFIZH')
                    ->orWhere('jenjang','PON-PES')
                    ->orWhere('jenjang','BBAQ')
                    ->count();
            $non_formal_madrasah = Lembaga::where('jenjang','MADRASAH DINIYAH')
                    ->orWhere('jenjang','DINIYAH')
                    ->count();
            $non_formal_majlis   = Lembaga::where('jenjang',"Majlis Ta'lim")
                    ->orWhere('jenjang','KELOMPOK PENGAJIAN/MAJLIS')
                    ->orWhere('jenjang','MASJID')
                    ->orWhere('jenjang','MT. IBU-IBU')
                    ->orWhere('jenjang','MT.IBU - IBU')
                    ->orWhere('jenjang','MT.BAPAK')
                    ->orWhere('jenjang','MT.')
                    ->orWhere('jenjang','MT')
                    ->count();
            $non_formal_tpq     = Lembaga::where('jenjang','TPQ')
                    ->orWhere('jenjang','TPA')
                    ->orWhere('jenjang','TPQ/RA')
                    ->orWhere('jenjang','RA')
                    ->orWhere('jenjang','TPQ/TPA')
                    ->orWhere('jenjang','TPA/TPQ')
                    ->orWhere('jenjang','TPQ , UMUM')
                    ->orWhere('jenjang','TPQ/TPA')
                    ->orWhere('jenjang','UMUM')
                    ->count();
            $non_formal_private = Lembaga::where('jenjang','LES PRIVAT')
                    ->orWhere('jenjang','BBAQ')
                    ->count();

            $semua    = Lembaga::whereNotNull('jenjang')->count();
            $nonformal_total        = $non_formal_pondok + $non_formal_madrasah + $non_formal_majlis + $non_formal_tpq +  $non_formal_private;
            $non_formal_lainnya    = $semua - $nonformal_total;
            $total_lembaga_non_formal = $non_formal_pondok + $non_formal_madrasah + $non_formal_majlis + $non_formal_tpq +  $non_formal_private + $non_formal_lainnya;

            $pondok = ($non_formal_pondok / $total_lembaga_non_formal) * 100;
            $madrasah = ($non_formal_madrasah / $total_lembaga_non_formal) * 100;
            $majlis = ($non_formal_majlis / $total_lembaga_non_formal) * 100;
            $tpq = ($non_formal_tpq / $total_lembaga_non_formal) * 100;
            $private = ($non_formal_private / $total_lembaga_non_formal) * 100;
            $lainnya = ($non_formal_lainnya / $total_lembaga_non_formal) * 100;            

            return response()->json(
                [
                    'status'    => 200,
                    'pondok'    => $pondok,
                    'madrasah'  => $madrasah,
                    'majlis'    => $majlis,
                    'tpq'       => $tpq,
                    'private'   => $private,
                    'lainnya'   => $lainnya,
                    'message'   => 'chart lembaga non formal'
                ]
            );
        }
    }

    public function perkembangan_pengguna(Request $request)
    {
        if ($request->ajax()) {

            $tahun = Peserta::orderBy('tanggal','asc')->select(\DB::raw("YEAR(tanggal) as year"))->distinct()->get();
            $years = $tahun->pluck('year');
            $value_an_year = [];
            $bulanan = [];
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse(date('Y').'-'.$value.'-01')->format('M');
            })->toArray();
    
            $cetak_bulanan = [];
            foreach($years as $key => $thn){
                $value_an_year[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"),$thn)->count();
                
                
                foreach($month as $key => $bln){
                    $bulanan[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"),$thn)->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$bln)->count();
                }
                $cetak_bulanan[] = implode(',',$bulanan);
            }
    
            $data[] = $value_an_year;
            $hasil_bulanan = implode('<br>',$cetak_bulanan);
            $hasil_tahunan = implode(',',$value_an_year);
            $nama_bulan = implode(',',$monthNames);

            return response()->json(
                [
                    'status'    => 200,
                    'tahunan'   => $value_an_year,
                    'tahun'     => $years,
                    'array'     => $data,
                    'message'   => 'chart perkembangan pengguna tilawati'
                ]
            );   
        }
    }

    public function perkembangan_pengguna_bulanan(Request $request)
    {
        if ($request->ajax()) {
            if ($request->dari !== null) {
                # code...
                $dari_bulan = substr($request->dari,5);
                $dari_tahun = substr($request->dari,0,4);

                $sampai_bulan = substr($request->sampai,5);
                $sampai_tahun = substr($request->sampai,0,4);

                $tahun = Peserta::orderBy('tanggal','asc')->select(\DB::raw("YEAR(tanggal) as year"))->distinct()->get();
                $years = $tahun->pluck('year');
                $value_an_year = [];
                $bulanan = [];
                $month = [01,02,03,04,05,06,07,8,9,10,11,12];
                
                $monthNames = collect($month)->transform(function ($value) {
                    return \Carbon\Carbon::parse(date('Y').'-'.$value.'-01')->format('M');
                })->toArray();
        
                $cetak_bulanan = [];
                
                if ($request->thn == null) {
                    # code...
                    $tahun_sekarang = date('Y');
                    foreach($month as $key => $bln){
                        // $bulanan[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"), $tahun_sekarang)->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"), $bln)->count();
                        $bulanan[] = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                    }
                }

                return response()->json(
                    [
                        'status'    => 200,
                        'dari'      => substr($request->dari,0,4).' & '.substr($request->dari,5),
                        'sampai'    => substr($request->sampai,0,4).' & '.substr($request->sampai,5),
                        'totalbulanan'  => $bulanan,
                        'namabulan'     => $monthNames,
                        'message'   => 'chart perkembangan pengguna tilawati search dari dan sampai'
                    ]
                );     


            }else {
                # code...
                $tahun = Peserta::orderBy('tanggal','asc')->select(\DB::raw("YEAR(tanggal) as year"))->distinct()->get();
                $years = $tahun->pluck('year');
                $value_an_year = [];
                $bulanan = [];
                $month = [01,02,03,04,05,06,07,8,9,10,11,12];
                
                $monthNames = collect($month)->transform(function ($value) {
                    return \Carbon\Carbon::parse(date('Y').'-'.$value.'-01')->format('M');
                })->toArray();
        
                $cetak_bulanan = [];
                
                if ($request->thn == null) {
                    # code...
                    $tahun_sekarang = date('Y');
                    foreach($month as $key => $bln){
                        $bulanan[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%Y')"), $tahun_sekarang)->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"), $bln)->count();
                    }
                }

                return response()->json(
                    [
                        'status'    => 200,
                        'totalbulanan'  => $bulanan,
                        'namabulan'     => $monthNames,
                        'message'   => 'chart perkembangan pengguna tilawati'
                    ]
                );     
            }    
        }
    }

    public function maps()
    {
        // return view('tilawatipusat.dashboard.map');
    }

    public function maps_data_cabang(Request $request)
    {
        if ($request->ajax()) {
            $maps_cabang = Cabang::whereNotNull('lng')->whereNotNull('lat')
                            ->select('id','name','kepalacabang','alamat','lng','lat','telp')
                            ->get();
            if (count($maps_cabang) > 0) {
                # code...
                return response()->json(
                    [
                        'status'        => 200,
                        'maps_cabang'   => $maps_cabang,
                        'message'       => 'menampilkan data cabang tilawati & nurul falah'
                    ]
                );   
            }
        }
    }


    public function total_infografis_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $dari = $request->dari;
                $sampai = $request->sampai;
                $dataz = [];
                $datax = [];
                # code...

                $pel = Pelatihan::where('keterangan', 'guru')->whereBetween('tanggal', array($dari, $sampai))->get();
                foreach ($pel as $key => $value) {
                    # code...
                    $dataz[] = $value->peserta->count();
                };
                $guru = array_sum($dataz);

                $pel = Pelatihan::where('keterangan', 'santri')->whereBetween('tanggal', array($dari, $sampai))->get();
                foreach ($pel as $key => $value) {
                    # code...
                    $datax[] = $value->peserta->count();
                };
                $santri = array_sum($datax);
                


                // $santri  = Peserta::whereHas('pelatihan',function($query){
                //     $query->where('keterangan','santri');
                // })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                // $guru    = Peserta::whereHas('pelatihan',function($query){
                //     $query->where('keterangan','guru');
                // })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $instruktur = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','instruktur');
                })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();

                $santri_lulus  = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','santri')->where('bersyahadah', '1');
                })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $guru_lulus    = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','guru')->where('bersyahadah', '1');
                })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $instruktur_lulus = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','instruktur')->where('bersyahadah', '1');
                })->whereBetween('tanggal', array($request->dari, $request->sampai))->count();

                $santri_tak_lulus = $santri - $santri_lulus;
                $guru_tak_lulus = $guru - $guru_lulus;
                $instruktur_tak_lulus = $instruktur - $instruktur_lulus;

                $jml_santri = Lembaga::sum('jml_santri');
                $jml_guru   = Lembaga::sum('jml_guru');
                
                return response()->json(
                    [
                        'santri' => number_format($santri,0,',','.'),
                        'guru' => number_format($guru,0,',','.'),
                        'instruktur' => number_format($instruktur,0,',','.'),
                        'santri_lulus' => number_format($santri_lulus,0,',','.'),
                        'guru_lulus' => number_format($guru_lulus,0,',','.'),
                        'instruktur_lulus' => number_format($instruktur_lulus,0,',','.'),
                        'santri_tak_lulus' => number_format($santri_tak_lulus,0,',','.'),
                        'guru_tak_lulus'   => number_format($guru_tak_lulus,0,',','.'),
                        'instruktur_tak_lulus' => number_format($instruktur_tak_lulus,0,',','.'),
                        'jml_santri' => number_format($jml_santri,0,',','.'),
                        'jml_guru'   => number_format($jml_guru,0,',','.'),
                    ]
                );

            }else {
                # code...
                $santri  = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','santri');
                })->count();
                $guru    = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','guru');
                })->count();
                $instruktur = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','instruktur');
                })->count();

                $santri_lulus  = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','santri')->where('bersyahadah', '1');
                })->count();
                $guru_lulus    = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','guru')->where('bersyahadah', '1');
                })->count();
                $instruktur_lulus = Peserta::whereHas('pelatihan',function($query){
                    $query->where('keterangan','instruktur')->where('bersyahadah', '1');
                })->count();

                $santri_tak_lulus = $santri - $santri_lulus;
                $guru_tak_lulus = $guru - $guru_lulus;
                $instruktur_tak_lulus = $instruktur - $instruktur_lulus;

                $jml_santri = Lembaga::sum('jml_santri');
                $jml_guru   = Lembaga::sum('jml_guru');

                return response()->json(
                    [
                        'santri' => number_format($santri,0,',','.'),
                        'guru' => number_format($guru,0,',','.'),
                        'instruktur' => number_format($instruktur,0,',','.'),
                        'santri_lulus' => number_format($santri_lulus,0,',','.'),
                        'guru_lulus' => number_format($guru_lulus,0,',','.'),
                        'instruktur_lulus' => number_format($instruktur_lulus,0,',','.'),
                        'santri_tak_lulus' => number_format($santri_tak_lulus,0,',','.'),
                        'guru_tak_lulus'   => number_format($guru_tak_lulus,0,',','.'),
                        'instruktur_tak_lulus' => number_format($instruktur_tak_lulus,0,',','.'),
                        'jml_santri' => number_format($jml_santri,0,',','.'),
                        'jml_guru'   => number_format($jml_guru,0,',','.'),
                    ]
                );
            }
        }
        
    }
}
