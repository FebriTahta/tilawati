<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Cabang;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Response;
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

    public function generate(Request $request){

        $user = User::updateOrCreate([
            'username' => 'test'
        ],
        [
            'username' => 'test',
            'role' => 'pusat',
            'email' => 'admin@admin.com',
            'password' => Hash::make('tester'),
        ]);

        return redirect()->back();
    }

    public function generate_qr_tilawati(Request $request)
    {
        \QrCode::size(150)
        ->format('png') 
        ->generate('https://www.tilawatipusat.com/', public_path('images/tilawati_qr.png'));

            return response()->json(
                [
                  'success' => 'QR Dibuat',
                  'message' => 'QR Dibuat'
                ]
            );
    }

    public function download_qr_tilawati(Request $request)
    {
        $filepath = public_path('images/').$request->slug2.'.png';
        return Response::download($filepath);
    }
}
