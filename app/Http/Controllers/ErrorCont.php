<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Program;
use App\Models\Peserta;
use DB;
use App\Models\Cabang;
use DataTables;
use Carbon\Carbon;
use File;
use App\Models\Flyer;
use App\Models\Nilai;
use App\Models\Penilaian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ErrorCont extends Controller
{
    public function post_error(Request $request)
    {
        Nilai::where('penilaian_id',20)->update([
            'kategori'=>'skill'
        ]);

        return redirect()->back();
    }

    public function fixing()
    {
        $x26 = Nilai::where('penilaian_id',26)->count();
        $x27 = Nilai::where('penilaian_id',27)->count();
        $x28 = Nilai::where('penilaian_id',28)->count();
        $x29 = Nilai::where('penilaian_id',29)->count();
        $x30 = Nilai::where('penilaian_id',30)->count();
        $x31 = Nilai::where('penilaian_id',31)->count();
        $x32 = Nilai::where('penilaian_id',32)->count();


        return $x26.' - '.$x27.' - '.$x28.' - '.$x29.' - '.$x30.' - '.$x31.' - '.$x32.' - '.$x33;
    }
}
