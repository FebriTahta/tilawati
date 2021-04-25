<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Peserta;
class DashboardController extends Controller
{
    public function index()
    {


    	return view('AdmPelatihan.Dashboard.index');
    }
    public function dataForChart(Type $var = null)
    {
        $month = [01,02,03,04];

        $user = [];
        foreach ($month as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count();
            // $user[] = User::whereMonth('created_at','=','%Y-m')->count();
        }
        $monthNames = collect($month)->transform(function ($value) {
            return \Carbon\Carbon::parse('2021-'.$value.'-01')->format('M');
        })->toArray();

        $respon=[
            'status'=>'success',
            'msg'=>null,
            'content'=>[
                'monthNames'=>$monthNames,
                'user'=>$user,
                
            ]
        ];
        return response()->json($respon,200);
    }
}
