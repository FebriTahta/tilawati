<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $dt_usr = User::all();
        return view('AdmPelatihan.User.index',compact('dt_usr'));
    }
}
