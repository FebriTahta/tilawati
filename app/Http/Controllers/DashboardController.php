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
    public function getdiklat(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
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
    public function getpeserta(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get();
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
                $data = DB::table('users')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get();
                
            }
            else
            {
                $data = User::with('cabang');
                return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('cabang', function (User $user) {
                })
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                ->rawColumns(['cabang'])
                ->make(true);
            }
         return datatables()->of($data)->make(true);
        }
    }
    public function dataForChart(Request $request)
    {
        $user = [];
        if ($request->type=='all') {
            $month = [01,02,03,04,05,06,07,8,9,10,11,12];
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
            })->toArray();
            foreach ($month as $key => $value) {
                $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'content'=>[
                    'monthNames'=>$monthNames,
                    'user'=>$user,
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
                $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
                // $user[] = User::whereMonth('created_at','=','%Y-m')->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'month'=>$month,
                'content'=>[
                    'monthNames'=>$monthNames,
                    'user'=>$user,
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
            $monthNames = collect($month)->transform(function ($value) {
                return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
            })->toArray();
            foreach ($month as $key => $value) {
                $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
            }
            $respon=[
                'status'=>'success',
                'msg'=>null,
                'content'=>[
                    'monthNames'=>$monthNames,
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
             $monthNames = collect($month)->transform(function ($value) {
                 return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
             })->toArray();
             foreach ($month as $key => $value) {
                 $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
                 // $user[] = User::whereMonth('created_at','=','%Y-m')->count();
             }
             $respon=[
                 'status'=>'success',
                 'msg'=>null,
                 'month'=>$month,
                 'content'=>[
                     'monthNames'=>$monthNames,
                     'pel'=>$pel,
                 ]
             ];
            }
        }
        return response()->json($respon,200);
    }
}
