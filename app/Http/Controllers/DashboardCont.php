<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCont extends Controller
{
    public function index()
    {
        return view('tilawatipusat.dashboard.index');
    }
}
