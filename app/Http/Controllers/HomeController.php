<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (auth()->user()->role == 'pusat') {
        //     # code...
        //     return redirect('/diklat-dashboard');

        // }elseif(auth()->user()->role == 'bendahara'){
        //     # code...
        //     return redirect('/');
        // }

        return redirect('/diklat-dashboard');
    }
}
