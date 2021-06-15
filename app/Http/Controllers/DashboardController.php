<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Peserta;
use App\Models\Cabang;
use App\Models\Lembaga;
use App\Models\Pelatihan;
use DataTables;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('AdmPelatihan.Dashboard.index');
    }
    public function getuser(Request $request)
    {
        if (request()->ajax()) {
            # code...
            $data = User::all()->count();
            return response()->json($data,200);
        }
    }
    public function getdiklat(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Pelatihan::all()->count();
                return response()->json($data,200);
            }
        }
    }
    public function getdiklat_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Pelatihan::whereBetween('tanggal', array($request->dari, $request->sampai));
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('cabang', function (Pelatihan $cabangs) {
                    return $cabangs->cabang->name;
                })
                ->rawColumns(['cabang'])
                ->make(true);
            }
            else
            {
                $data = Pelatihan::orderBy('tanggal','desc');
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('cabang', function (Pelatihan $cabangs) {
                    return $cabangs->cabang->name;
                })
                ->rawColumns(['cabang'])
                ->make(true);
                
            }
         return datatables()->of($data)->make(true);
        }
    }
    public function getcabang(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('cabangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Cabang::all()->count();
                return response()->json($data,200);
            }
        }
    }
    public function getlembaga(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Lembaga::all()->count();
                return response()->json($data,200);
            }
        }
    }

    public function getlembaga_kab(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function getlembaga_pro(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')
                ->select('provinsi_id', DB::raw('count(*) as total'))
                ->groupBy('provinsi_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }


    public function getpeserta(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Peserta::all()->count();
                return response()->json($data,200);
            }
        }
    }
    public function daterangepeserta(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::with('pelatihan')
                ->whereBetween('created_at', array($request->dari, $request->sampai));
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('pelatihan', function (Peserta $user) {
                    return $user->pelatihan->name;
                })
                ->addColumn('pelid', function (Peserta $user) {
                    return $user->pelatihan->id;
                })
                ->addColumn('sebagai', function (Peserta $user) {
                    return $user->pelatihan->keterangan;
                })
                ->rawColumns(['pelid','pelatihan','sebagai'])
                ->make(true);
            }
            else
            {
                $data = Peserta::with('pelatihan');
                return Datatables::eloquent($data)
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                ->addIndexColumn()
                ->addColumn('pelatihan', function (Peserta $user) {
                    return $user->pelatihan->name;
                })
                ->addColumn('pelid', function (Peserta $user) {
                    return $user->pelatihan->id;
                })
                ->addColumn('sebagai', function (Peserta $user) {
                    return $user->pelatihan->keterangan;
                })
                ->rawColumns(['pelid','pelatihan','sebagai','status'])
                ->make(true);
            }
         return datatables()->of($data)->make(true);
        }
    }
    
    public function dataForChart(Request $request)
    {
        $peserta = [];
        if ($request->type=='all') {
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
            })->toArray();
            foreach ($month as $key => $value) {
                // $peserta[] = Peserta::query()->with(array('pelatihan'=>function($query){
                //      $query->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value);
                //  }));
                // $peserta[] = Pelatihan::with('peserta')->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
                // $peserta[] = Peserta::with('pelatihan')->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
                $peserta[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'content'=>[
                    'monthNames'=>$monthNames,
                    'peserta'=>$peserta,
                ]
            ];
        } elseif ($request->type=='search') {
           $rules=[
               'start'=>'required',
               'finish'=>'required'
           ];
           $message=[
               'start.required'=>'Tanggal dari harus di pilih',
               'finish.required'=>'Tanggal sampai harus di pilih'
           ];
           $validator=Validator::make($request->all(),$rules,$message);
           if ($validator->fails()) {
            $respon=[
                'status'=>'error',
                'msg'=>'validation error',
                'errors'=>$validator->errors(),
                'content'=>null,
            ]; 
           } else {
            $start = strtotime($request->start);
            $end = strtotime($request->finish);
            while($start < $end)
            {
                $month[]=date('m', $start);
                $start = strtotime("+1 month", $start);
            }
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
            })->toArray();
            foreach ($month as $key => $value) {
                $peserta[] = Peserta::where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
                // $peserta[] = Peserta::with('pelatihan')->where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'month'=>$month,
                'content'=>[
                    'monthNames'=>$monthNames,
                    'peserta'=>$peserta,
                ]
            ];
           }
        }
        return response()->json($respon,200);
    }

    public function dataForChart2(Request $request)
    {           
        $pel = [];
        if ($request->type=='all') {
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            $monthNames2 = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
            })->toArray();
            foreach ($month as $key => $value) {
                $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'content'=>[
                    'monthNames2'=>$monthNames2,
                    'pel'=>$pel,
                ]
            ];
        } elseif ($request->type=='search') {
            $rules=[
                'start'=>'required',
                'finish'=>'required'
            ];
            $message=[
                'start.required'=>'Tanggal dari harus di pilih',
                'finish.required'=>'Tanggal sampai harus di pilih'
            ];
            $validator=Validator::make($request->all(),$rules,$message);
            if ($validator->fails()) {
             $respon=[
                 'status'=>'error',
                 'msg'=>'validation error',
                 'errors'=>$validator->errors(),
                 'content'=>null,
             ];
            } else {
             $start = strtotime($request->start);
             $end = strtotime($request->finish);
             while($start < $end)
             {
                 $month[]=date('m', $start);
                 $start = strtotime("+1 month", $start);
             }
             $monthNames2 = collect($month)->transform(function ($value) {
                 return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
             })->toArray();
             foreach ($month as $key => $value) {
                 $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(tanggal, '%m')"),$value)->count();
                 
             }
             $respon=[
                 'status'=>'success',
                 'msg'=>null,
                 'month'=>$month,
                 'content'=>[
                     'monthNames2'=>$monthNames2,
                     'pel'=>$pel,
                 ]
             ];
            }
        }
        return response()->json($respon,200);
    }
}
