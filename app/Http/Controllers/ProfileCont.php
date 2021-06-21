<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Illuminate\Http\Request;

class ProfileCont extends Controller
{
    public function index($id)
    {
        $peserta = Peserta::find($id);
        return view('tilawatipusat.profile.index',compact('peserta'));
    }
}
