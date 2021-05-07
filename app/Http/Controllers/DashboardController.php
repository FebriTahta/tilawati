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
                ->count();
                return response()->json($data,200);
            }
            else
            {
                $data = User::all()->count();
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
                return Datatables::eloquent($data)
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
                ->rawColumns(['pelid','pelatihan','sebagai'])
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
                $peserta[] = Peserta::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
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
                $peserta[] = Peserta::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
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
                $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
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
                 $pel[] = Pelatihan::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
                 
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
