<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use App\Models\Registrasi;
use App\Models\Filepeserta;
use Illuminate\Http\Request;

class RegistrasiCont extends Controller
{
    public function index(Request $request, $diklat_id)
    {
        return view('layouts.tilawatipusat_registrasi.raw');
    }
}
