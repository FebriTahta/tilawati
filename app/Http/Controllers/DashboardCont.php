<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Cabang;
use DB;
use Illuminate\Http\Request;

class DashboardCont extends Controller
{
    public function index()
    {
        $x = Cabang::select('kabupaten_id', DB::raw('count(*) as total'))->groupBy('kabupaten_id')->havingRaw('total > 1')->get();

        $diklat = Pelatihan::orderBy('tanggal','desc')->limit(5)->get();
        $diklat_ini = $diklat->count();
        return view('tilawatipusat.dashboard.index',compact('diklat','diklat_ini','x'));
    }
}
