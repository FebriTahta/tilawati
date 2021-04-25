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
        $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        // $months = ['01','02','03','04'];
        $now = date("Y");
        $users = [];
        foreach ($months as $month) {
            $users[] = User::whereMonth('created_at', $month)
            ->whereYear('created_at', $now)->count();
        } 
        $monthNames = collect($months)->transform(function ($month) {
            return \Carbon\Carbon::parse('2021-'.$month.'-01')->format('M');
        })->toArray();
        
        return view('AdmPelatihan.Dashboard.index')->with([
            'months' => json_encode($months),
            'monthNames' => json_encode($monthNames),
            'users' => json_encode($users)
        ]);
    }
}
