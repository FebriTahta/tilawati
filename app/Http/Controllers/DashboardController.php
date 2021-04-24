<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {


    	return view('AdmPelatihan.Dashboard.index');
    }
    public function dataForChart(Type $var = null)
    {
        $month = [2018,2019,2020,2021];

        $user = [];
        foreach ($month as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
            // $user[] = User::whereMonth('created_at','=','%Y-m')->count();
        }
        $respon=[
            'status'=>'success',
            'msg'=>null,
            'content'=>[
                'year'=>$month,
                'user'=>$user,
            ]
        ];
        return response()->json($respon,200);
    }
}
