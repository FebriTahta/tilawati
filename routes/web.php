<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('auth.login');
    return redirect('dashboard');
    // return view('landing.index');
    // return redirect('/pelatihan-cabang');
});
Auth::routes();

Route::group(['middleware' => ['auth', 'CheckRole:pusat']], function () {
    //dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    // data untuk chart di dashboar
    Route::post('/dashboard-chart',[DashboardController::class,'dataForChart'])->name('dashboard.chart');
    //user
    Route::get('/data-user',[UserController::class, 'index'])->name('user.index');
    //cabang
    Route::get('/pelatihan-cabang',[CabangController::class, 'index'])->name('cabang.index');
    //lembaga
    Route::get('/pelatihan-lembaga', [LembagaController::class , 'index'])->name('lembaga.index');
    Route::get('/pelatihan-lembaga-create', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/pelatihan-lembaga-post', [LembagaController::class, 'store'])->name('lembaga.store');
    //pelatihan data entri
    Route::get('/pelatihan-data-entri',[PelatihanController::class, 'index'])->name('pelatihan.index');
    Route::post('/pelatihan-data-entri-store' ,[PelatihanController::class, 'store'])->name('pelatihan.store');
    //pelatihan peserta
    Route::get('/pelatihan-data-entri/{id}/data', [PesertaController::class, 'daftarpeserta'])->name('pelatihan.daftarpeserta');
    Route::post('/pelatihan-data-entri/peserta', [PesertaController::class, 'storepes'])->name('pelatihan.storepes');

    //sub controller ajax
    //fetch propinsi dan kota
    Route::get('/fetch/{id}',[SubController::class, 'fetch']);
    //fetch program dan pelatihan untuk print
    Route::get('/fetchpp/{id}',[SubController::class, 'fetchpp']);

    //import
    Route::post('/importPeserta',[ImportController::class,'importPeserta'])->name('import.peserta');
    Route::post('/importPesertaGuru',[ImportController::class,'importPesertaGuru'])->name('import.pesertaG');
    Route::post('/importPesertaToT',[ImportController::class,'importPesertaToT'])->name('import.pesertaToT');
});

Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga']], function () {
    //dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //cabang
    Route::get('/pelatihan-cabang',[CabangController::class, 'index'])->name('cabang.index');
    Route::get('/pelatihan-cabang-create',[CabangController::class, 'create'])->name('cabang.create');
    Route::post('/pelatihan-cabang-store', [CabangController::class, 'store'])->name('cabang.store');
    //jenis
    Route::get('/pelatihan-jenis', [JenisController::class , 'index'])->name('jenis.index');
    Route::post('/pelatihan-jenis-store', [JenisController::class, 'store'])->name('jenis.store');
    //lembaga
    Route::get('/pelatihan-lembaga', [LembagaController::class , 'index'])->name('lembaga.index');
    Route::get('/pelatihan-lembaga-create', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/pelatihan-lembaga-post', [LembagaController::class, 'store'])->name('lembaga.store');
    //Kriteria Syahadah
    Route::get('/pelatihan-kriteria-syahadah', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/pelatihan-kriteria-syahadah-store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::post('/pelatihan-kriteria-syahadah-delete', [KriteriaController::class, 'destroy'])->name('kriteria.hapus');
    Route::post('/pelatihan-kriteria-syahadah-hapus', [KriteriaController::class, 'hapus'])->name('kriteria.delete');
    //pelatihan data entri
    Route::get('/pelatihan-data-entri',[PelatihanController::class, 'index'])->name('pelatihan.index');
    Route::post('/pelatihan-data-entri-store' ,[PelatihanController::class, 'store'])->name('pelatihan.store');
    //pelatihan program
    Route::get('/pelatihan-program' ,[ProgramController::class, 'index'])->name('program.index');
    Route::post('/pelatihan-program-store' ,[ProgramController::class, 'store'])->name('program.store');
    //pelatihan peserta
    Route::get('/pelatihan-data-entri/{id}/data', [PesertaController::class, 'daftarpeserta'])->name('pelatihan.daftarpeserta');
    Route::post('/pelatihan-data-entri/peserta', [PesertaController::class, 'storepes'])->name('pelatihan.storepes');

    //cetak
    Route::get('/pelatihan-cetak-depan', [CetakController::class, 'ijazahdepan'])->name('pelatihan.c_depan');
    Route::post('/pelatihan-cetak-depan-print', [CetakController::class, 'cetak_depan'])->name('depan.cetak');
    Route::get('/pelatihan-cetak-belakang-santri', [CetakController::class, 'ijazahbelakangsantri'])->name('pelatihan.c_belakang');
    Route::post('/pelatihan-cetak-belakang-santri-print', [CetakController::class, 'cetak_belakang_santri'])->name('belakang.cetaksantri');

    //sub controller ajax
    //fetch propinsi dan kota
    Route::get('/fetch/{id}',[SubController::class, 'fetch'])->name('fetch');
    //fetch program dan pelatihan untuk print
    Route::get('/fetchpp/{id}',[SubController::class, 'fetchpp']);
    //hapus data
    Route::post('/hapus-pelatihan-cabang', [SubController::class, 'hapuscabang'])->name('cabang.hapus');
    //import
    Route::post('/importPeserta',[ImportController::class,'importPeserta'])->name('import.peserta');
    Route::post('/importPesertaGuru',[ImportController::class,'importPesertaGuru'])->name('import.pesertaG');
    Route::post('/importPesertaToT',[ImportController::class,'importPesertaToT'])->name('import.pesertaToT');
});


