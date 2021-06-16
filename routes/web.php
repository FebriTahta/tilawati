<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
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
use App\Http\Controllers\CabangCont;
use App\Http\Controllers\LembagaCont;
use App\Http\Controllers\JenjangCont;
use App\Http\Controllers\ProgramCont;
use App\Http\Controllers\KriteriaCont;
use App\Http\Controllers\CetakCont;
use App\Http\Controllers\DiklatCont;
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
    return redirect('/diklat-cabang');
    // return view('landing.index');
    // return redirect('/pelatihan-cabang');
});
Auth::routes();

Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga']], function () {
    //dashboard
    Route::post('/dashboard-chart',[DashboardController::class,'dataForChart'])->name('dashboard.chart');// data untuk chart bar di dashboar
    Route::post('/dashboard-chart-2',[DashboardController::class,'dataForChart2'])->name('dashboard.chart2');// data untuk chart pie di dashboar
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/diklat-total',[DashboardController::class,'daterangediklat'])->name('diklat.filter');//get data diklat range ajax dashboard
    Route::get('/dashboard/cabang-total',[DashboardCabang::class,'daterangecabang'])->name('cabang.filter');//get data cabang range ajax dashboard
    Route::get('/dashboard/lembaga-total',[DashboardController::class,'daterangelembaga'])->name('lembaga.filter');//get data lembaga range ajax dashboard
    Route::get('/dashboard/peserta-total', [DashboardController::class, 'daterangepeserta'])->name('peserta.filter');//get data peserta range ajax dashboard
    Route::get('/dashboard/user',[DashboardController::class, 'getuser'])->name('dashboard.user');//get total user ajax dashboard
    Route::get('/dashboard/cabang',[DashboardController::class, 'getcabang'])->name('dashboard.cabang');//get total cabang ajax dashboard
    Route::get('/dashboard/lembaga',[DashboardController::class, 'getlembaga'])->name('dashboard.lembaga');//get total lembaga ajax dashboard
    Route::get('/dashboard/lembaga-kabupaten',[DashboardController::class, 'getlembaga_kab'])->name('dashboard.lembagakab');//get total kabupaten lembaga ajax dashboard
    Route::get('/dashboard/lembaga-provinsi',[DashboardController::class, 'getlembaga_pro'])->name('dashboard.lembagapro');//get total provinsi lembaga ajax dashboard
    Route::get('/dashboard/peserta',[DashboardController::class, 'getpeserta'])->name('dashboard.peserta');//get total peserta diklat ajax dashboard
    Route::get('/dashboard/diklat',[DashboardController::class, 'getdiklat'])->name('dashboard.diklat');//get total data diklat ajax dashboard
    Route::get('/dashboard/diklat-data',[DashboardController::class, 'getdiklat_data'])->name('dashboard.diklat_data');//nama nama data diklat ajax dashboard
    
    //user
    Route::get('/data-user',[UserController::class, 'index'])->name('user.index');
    Route::get('/pelatihan-user-data',[UserController::class, 'getuser_data'])->name('user.data');
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
    Route::get('/pelatihan-cabang-data',[CabangController::class, 'getcabang_data'])->name('cabang.data');
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
    Route::get('/pelatihan-lembaga-data',[LembagaController::class, 'getlembaga_data'])->name('lembaga.data');
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
    Route::get('/pelatihan-cetak-depan-santri', [CetakController::class, 'ijazahdepan_s'])->name('pelatihan.c_depan_s');
    Route::post('/pelatihan-cetak-depan-print', [CetakController::class, 'cetak_depan'])->name('depan.cetak');
    Route::post('/pelatihan-cetak-depan-santri-print', [CetakController::class, 'cetak_depan_santri'])->name('depan.cetak_s');
    Route::get('/pelatihan-cetak-belakang-santri', [CetakController::class, 'ijazahbelakangsantri'])->name('pelatihan.c_belakang');
    Route::post('/pelatihan-cetak-belakang-santri-print', [CetakController::class, 'cetak_belakang_santri'])->name('belakang.cetaksantri');
    Route::get('/pelatihan-cetak-belakang-guru',[CetakController::class, 'ijazahbelakangguru'])->name('pelatihan.c_belakang_g');
    Route::post('/pelatihan-cetak-belakang-guru-print',[CetakController::class, 'cetak_belakang_guru'])->name('belakang.cetakguru');
    Route::post('/pelatihan-cetak-belakang-tahfidz-print',[CetakController::class, 'cetak_belakang_tahfidz'])->name('belakang.cetaktahfidz');
    Route::post('/pelatihan-cetak-belakang-tot-print',[CetakController::class, 'cetak_belakang_tot'])->name('belakang.cetaktot');
    Route::get('/pelatihan-cetak-belakang-tot',[CetakController::class,'ijazahbelakangtot'])->name('pelatihan.c_belakang_tot');
    Route::get('/pelatihan-cetak-belakang-tahfidz',[CetakController::class,'ijazahbelakangtahfidz'])->name('pelatihan.c_belakang_tahfidz');
    Route::get('/pelatihan-cetak-belakang-munaqys',[CetakController::class,'ijazahbelakangmunaqisy'])->name('pelatihan.c_belakang_munaqisy');
    Route::post('/pelatihan-cetak-belakang-munaqisy-print',[CetakController::class, 'cetak_belakang_munaqisy'])->name('belakang.cetakmunaqisy');
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
    Route::post('/importPesertaMunaqisy',[ImportController::class,'importPesertaMunaqisy'])->name('import.pesertaMunaqisy');
    Route::post('/importCabang',[ImportController::class, 'importCabang'])->name('import.cabang');
    Route::post('/importRpq',[ImportController::class, 'importRpq'])->name('import.rpq');
    Route::post('/importLembaga',[ImportController::class, 'importLembaga'])->name('import.lembaga');
});

//new route tilawati
Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga']], function () {
    Route::get('/diklat-cabang',[CabangCont::class, 'index'])->name('diklat.cabang');
    Route::get('/diklat-cabang-data',[CabangCont::class, 'cabang_data'])->name('diklat.cabang_data');
    Route::get('/diklat-cabang-total',[CabangCont::class, 'cabang_total'])->name('diklat.cabang_tot');
    Route::get('/diklat-cabang-kabupaten-total',[CabangCont::class, 'cabang_kabupaten'])->name('diklat.cabang_kab');
    Route::get('/diklat-cabang-provinsi-total',[CabangCont::class, 'cabang_provinsi'])->name('diklat.cabang_pro');

    Route::get('/diklat-lembaga',[LembagaCont::class, 'index'])->name('diklat.lembaga');
    Route::get('/diklat-lembaga-data',[LembagaCont::class, 'lembaga_data'])->name('diklat.lembaga_data');
    Route::get('/diklat-lembaga-total',[LembagaCont::class, 'lembaga_total'])->name('diklat.lembaga_tot');
    Route::get('/diklat-lembaga-kabupaten-total',[LembagaCont::class, 'lembaga_kabupaten'])->name('diklat.lembaga_kab');
    Route::get('/diklat-lembaga-provinsi-total',[LembagaCont::class, 'lembaga_provinsi'])->name('diklat.lembaga_pro');

    Route::get('/diklat-jenjang',[JenjangCont::class, 'index'])->name('diklat.jenjang');
    Route::get('/diklat-jenjang-data',[JenjangCont::class, 'jenjang_data'])->name('diklat.jenjang_data');
    Route::get('/diklat-jenjang-total',[JenjangCont::class, 'jenjang_total'])->name('diklat.jenjang_tot');

    Route::get('/diklat-program',[ProgramCont::class, 'index'])->name('diklat.program');
    Route::get('/diklat-program-data',[ProgramCont::class, 'program_data'])->name('diklat.program_data');
    Route::get('/diklat-program-total',[ProgramCont::class, 'program_total'])->name('diklat.program_tot');

    Route::get('/diklat-kriteria',[KriteriaCont::class, 'index'])->name('diklat.kriteria');
    Route::get('/diklat-kriteria-data',[KriteriaCont::class, 'kriteria_data'])->name('diklat.kriteria_data');
    Route::get('/diklat-kriteria-total',[KriteriaCont::class, 'kriteria_total'])->name('diklat.kriteria_tot');

    Route::get('/diklat-diklat',[DiklatCont::class, 'index'])->name('diklat.diklat');
    Route::get('/diklat-diklat-data',[DiklatCont::class, 'diklat_data'])->name('diklat.diklat_data');
    Route::get('/diklat-diklat-total',[DiklatCont::class, 'diklat_total'])->name('diklat.diklat_tot');
    Route::post('/diklat-diklat-cabang-select',[DiklatCont::class, 'diklat_cabang_select'])->name('diklat.diklat_cabang_select');
    
    Route::get('/diklat-ijazah-depan-guru',[CetakCont::class, 'depan_guru'])->name('diklat.depan_guru');
    Route::get('/diklat-ijazah-depan-santri',[CetakCont::class, 'depan_santri'])->name('diklat.depan_santri');
});