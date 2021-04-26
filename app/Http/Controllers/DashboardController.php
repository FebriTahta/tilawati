<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Peserta;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {


    	return view('AdmPelatihan.Dashboard.index');
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
                // $user[] = User::whereMonth('created_at','=','%Y-m')->count();
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
}
