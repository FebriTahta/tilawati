<?php

namespace App\Http\Controllers;
use App\Models\Apicabangtilawati;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApicabangCont extends Controller
{
    public function index_api_tilawati(Request $request){

        $apicabangtilawati = Apicabangtilawati::get();
        return view('tilawatipusat.api.apicabangtilawati',compact('apicabangtilawati'));

    }

    public function data_api_tilawati(Request $request)
    {
        
    }
}
