<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class DashboardCont extends Controller
{
    public function index()
    {
        $diklat_total = Pelatihan::count();
        if ($diklat_total<5) {
            # code...
            $diklat = Pelatihan::orderBy('tanggal','desc')->limit($diklat_total)->get();
            $diklat_ini = $diklat->count();
        }else{
            $diklat = Pelatihan::orderBy('tanggal','desc')->limit(5)->get();
            $diklat_ini = $diklat->count();
        }
        return view('tilawatipusat.dashboard.index',compact('diklat','diklat_ini'));
    }
}
