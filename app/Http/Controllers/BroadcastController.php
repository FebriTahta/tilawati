<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function blas_broadcast()
    {
        return view('tilawatipusat.broadcast.index');
    }
}
