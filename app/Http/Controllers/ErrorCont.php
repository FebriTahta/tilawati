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
}
