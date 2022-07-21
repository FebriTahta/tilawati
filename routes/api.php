<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCont;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('daftar-cabang-api',[ApiCont::class,'daftar_cabang']);
Route::get('daftar-diklat-online',[ApiCont::class,'diklat_online']);
Route::get('daftar-perwakilan-tilawai',[ApiCont::class,'api_cabang_tilawati']);
Route::get('daftar-perwakilan-tilawai-paginate',[ApiCont::class,'api_cabang_tilawati_paginate']);
Route::get('daftar-perwakilan-tilawati-search/{search}',[ApiCont::class,'search_api_cabang_tilawati']);
Route::get('daftar-cabang-nf',[ApiCont::class,'api_cabang_nf']);
