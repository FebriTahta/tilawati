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
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\TeritorialController;
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

Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga']], function () {
    //dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/peserta/filter', [DashboardController::class, 'daterangepeserta'])->name('peserta.filter');//get data peserta range ajax dashboard
    Route::post('/dashboard-chart',[DashboardController::class,'dataForChart'])->name('dashboard.chart');// data untuk chart bar di dashboar
    Route::post('/dashboard-chart-2',[DashboardController::class,'dataForChart2'])->name('dashboard.chart2');// data untuk chart pie di dashboar
    Route::get('/dashboard/cabang',[DashboardController::class, 'getcabang'])->name('dashboard.cabang');
    Route::get('/dashboard/lembaga',[DashboardController::class, 'getlembaga'])->name('dashboard.lembaga');
    Route::get('/dashboard/peserta',[DashboardController::class, 'getpeserta'])->name('dashboard.peserta');
    Route::get('/dashboard/diklat',[DashboardController::class, 'getdiklat'])->name('dashboard.diklat');
    
    //user
    Route::get('/data-user',[UserController::class, 'index'])->name('user.index');
    //cabang
    Route::get('/pelatihan-cabang',[CabangController::class, 'index'])->name('cabang.index');
    //kepala cabang & Lembaga
    Route::post('/cabang-kepala-store',[KepalaController::class, 'store'])->name('cabang.kepalaS');
    Route::post('/lembaga-kepala-store',[KepalaController::class, 'storekep'])->name('lembaga.kepalaS');
    Route::get('/cabang-kepala-view',[KepalaController::class, 'view'])->name('cabang.kepalaV');
    //lembaga
    Route::get('/pelatihan-lembaga', [LembagaController::class , 'index'])->name('lembaga.index');
    Route::get('/pelatihan-lembaga-create', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/pelatihan-lembaga-post', [LembagaController::class, 'store'])->name('lembaga.store');
    Route::get('/lembaga-cabang-view',[LembagaController::class, 'lembaga_view_cabang'])->name('lembaga.cabang');
    //pelatihan data entri
    Route::get('/pelatihan-data-entri',[PelatihanController::class, 'index'])->name('pelatihan.index');
    Route::post('/pelatihan-data-entri-store' ,[PelatihanController::class, 'store'])->name('pelatihan.store');
    Route::get('/pelatihan-cabang-datacabang',[PelatihanController::class, 'fetchdatacabang'])->name('pelatihan.fetchcabang');
    //pelatihan peserta
    Route::get('/pelatihan-data-entri/{id}/data', [PesertaController::class, 'daftarpeserta'])->name('pelatihan.daftarpeserta');
    Route::post('/pelatihan-data-entri/peserta', [PesertaController::class, 'storepes'])->name('pelatihan.storepes');

    //teritorial
    Route::get('/pelatihan-teritorial',[TeritorialController::class, 'index'])->name('teritorial.index');
    Route::post('/pelatihan-teritorial-post',[TeritorialControllerito::class, 'store'])->name('teritorial.store');
    Route::get('/pelatihan-teritorial-get',[TeritorialController::class, 'get'])->name('teritorial.get');

    //sub controller ajax
    //fetch propinsi, kabupaten/kota, kecamatan, kelurahan
    Route::get('/fetch/{id}',[SubController::class, 'fetch']);
    Route::get('/fetch2/{id}',[SubController::class, 'fetch2']);
    Route::get('/fetch3/{id}',[SubController::class, 'fetch3']);
    Route::get('/fetch4/{id}',[SubController::class, 'fetch4']);
    Route::get('/fetch5/{id}',[SubController::class, 'fetch5']);
    Route::get('/fetch6/{id}',[SubController::class, 'fetch6']);
    Route::get('/fetch7/{id}',[SubController::class, 'fetch7']);
    Route::get('/fetch8/{id}',[SubController::class, 'fetch8']);
    
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
    Route::get('/pelatihan-cabang-edit/{id}',[CabangController::class, 'edit'])->name('cabang.edit');
    Route::patch('/pelatihan-cabang-update/{id}',[CabangController::class, 'update'])->name('cabang.update');
    //jenjang
    Route::get('/pelatihan-jenis', [JenisController::class , 'index'])->name('jenis.index');
    Route::post('/pelatihan-jenis-store', [JenisController::class, 'store'])->name('jenis.store');
    Route::post('/pelatihan-jenjang-del', [SubController::class, 'hapusjenjang'])->name('jenjang.del');
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
    Route::get('/pelatihan-cetak-belakang-guru',[CetakController::class, 'ijazahbelakangguru'])->name('pelatihan.c_belakang_g');
    Route::post('/pelatihan-cetak-belakang-guru-print',[CetakController::class, 'cetak_belakang_guru'])->name('belakang.cetakguru');
    Route::post('/pelatihan-cetak-belakang-tahfidz-print',[CetakController::class, 'cetak_belakang_tahfidz'])->name('belakang.cetaktahfidz');
    Route::post('/pelatihan-cetak-belakang-tot-print',[CetakController::class, 'cetak_belakang_tot'])->name('belakang.cetaktot');
    Route::get('/pelatihan-cetak-belakang-tot',[CetakController::class,'ijazahbelakangtot'])->name('pelatihan.c_belakang_tot');
    Route::get('/pelatihan-cetak-belakang-tahfidz',[CetakController::class,'ijazahbelakangtahfidz'])->name('pelatihan.c_belakang_tahfidz');
    Route::get('/pelatihan-cetak-belakang-munaqys',[CetakController::class,'ijazahbelakangmunaqys'])->name('pelatihan.c_belakang_munaqys');
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
    Route::post('/importPesertaTahfidz',[ImportController::class,'importPesertaTahfidz'])->name('import.pesertaTahfidz');
});


