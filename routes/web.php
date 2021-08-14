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
use App\Http\Controllers\PesertaCont;
use App\Http\Controllers\AcaraCont;
use App\Http\Controllers\DashboardCont;
use App\Http\Controllers\PenilaianCont;
use App\Http\Controllers\ProfileCont;
use App\Http\Controllers\NilaiCont;
use App\Http\Controllers\TeritoriCont;
use App\Http\Controllers\KepalaCont;
use App\Http\Controllers\RegistrasiCont;
use App\Http\Controllers\LandingCont;
use App\Http\Controllers\KonfirmasiCont;
use App\Http\Controllers\SertifikatCont;
use App\Http\Controllers\BroadcastController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
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
    return redirect('/login');
});
Route::get('/e-certificate/{slug_diklat}',[LandingCont::class,'ecertificate']);
Route::get('/data/e-certificate/{diklat_id}',[LandingCont::class,'ecertificate_data']);
Route::get('/tes_data',[LandingCont::class,'tes_data']);
Auth::routes();
//homepage
Route::get('/homepage',[LandingCont::class,'index'])->name('homepage');
Route::get('/cetak/e-certificate/diklat',[LandingCont::class,'daftar_esertifikat']);
Route::get('/cetak/e-certificate/{slug_diklat}',[LandingCont::class,'daftar_esertifikat_peserta']);
Route::group(['middleware' => ['auth', 'CheckRole:pusat,bendahara']], function () {
    Route::post('/import/e-certificate',[LandingCont::class,'import_e_sertifikat'])->name('import.e_certificate');
});

//profile
Route::get('/diklat-profile-peserta/{id_peserta}/{id_program}/{id_pelatihan}/admin',[ProfileCont::class,'index'])->name('diklat.profile_peserta');
Route::get('/diklat-profile-peserta/{id_peserta}/{id_program}/{id_pelatihan}',[ProfileCont::class,'scan'])->name('diklat.profile_peserta_scan');
//registrasi
Route::get('/registrasi/{slug_diklat}',[RegistrasiCont::class,'index'])->name('diklat.registrasi');
//sub controller ajax
//fetch propinsi, kabupaten/kota, kecamatan, kelurahan
//sub controller ajax
//fetch propinsi dan kota
// Route::get('/fetch/{id}',[SubController::class, 'fetch'])->name('fetch');
//fetch program dan pelatihan untuk print
Route::get('/fetchpp/{id}',[SubController::class, 'fetchpp']);
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
//submit registrasi pendaftaran online
Route::post('/pendaftaran-peserta-diklat',[RegistrasiCont::class,'registrasi'])->name('diklat.registrasi');
Route::get('/pendaftaran-data-calon-peserta-diklat-sukses/{program_id}/{diklat_id}/{peserta_id}', [RegistrasiCont::class,'sukses'])->name('diklat.registrasi.sukses');
Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga,bendahara']], function () {
    //syarat regis
    Route::get('/diklat-persyaratan',[RegistrasiCont::class,'syarat'])->name('diklat.syarat.registrasi');
    Route::get('/diklat-data-persyaratan',[RegistrasiCont::class,'data_syarat'])->name('diklat.syarat.data');
    Route::post('/diklat-post-data-persyaratan',[RegistrasiCont::class,'submit_syarat'])->name('diklat.syarat.submit');
    Route::post('/diklat-post-data-persyaratan-delete',[RegistrasiCont::class,'delete'])->name('diklat.syarat.delete');
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

    //import
    Route::post('/importPeserta',[ImportController::class,'importPeserta'])->name('import.peserta');
    Route::post('/importPesertaGuru',[ImportController::class,'importPesertaGuru'])->name('import.pesertaG');
    Route::post('/importPesertaToT',[ImportController::class,'importPesertaToT'])->name('import.pesertaToT');
});

Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga,bendahara,']], function () {
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
Route::group(['middleware' => ['auth', 'CheckRole:pusat,cabang,lembaga,bendahara']], function () {
    Route::get('/diklat-cabang',[CabangCont::class, 'index'])->name('diklat.cabang');
    Route::post('/diklat-cabang-store',[CabangCont::class, 'store'])->name('diklat.cabang_store');
    Route::get('/diklat-cabang-data',[CabangCont::class, 'cabang_data'])->name('diklat.cabang_data');
    Route::get('/diklat-cabang-total',[CabangCont::class, 'cabang_total'])->name('diklat.cabang_tot');
    Route::get('/diklat-cabang-kabupaten-total',[CabangCont::class, 'cabang_kabupaten'])->name('diklat.cabang_kab');
    Route::get('/diklat-cabang-provinsi-total',[CabangCont::class, 'cabang_provinsi'])->name('diklat.cabang_pro');
    Route::get('/diklat-cabang-provinsi-data',[CabangCont::class,'data_cabang_provinsi'])->name('diklat.data_cab_pro');
    Route::get('/diklat-cabang-provinsi-get-data/{id}',[CabangCont::class,'data_cabang_provinsi_data'])->name('diklat.data_cab_pro_data');
    Route::get('/diklat-cabang-provinsi-get-data-view/{id}/{tanggal}',[CabangCont::class,'data_cabang_provinsi_view'])->name('diklat.data_cab_pro_view');

    Route::get('/diklat-teritori-cabang',[TeritoriCont::class,'cabang_duplikat_kabupaten'])->name('diklat.duplikat_cabang');

    Route::get('/diklat-kepala-bagian',[KepalaCont::class, 'index'])->name('diklat.kepala');
    Route::get('/diklat-kepala-bagian-cabang-create/{kode}',[KepalaCont::class, 'create_kepala_cabang'])->name('diklat.kepala_create_cabang');
    Route::get('/diklat-kepala-bagian-lembaga-create/{kode}',[KepalaCont::class, 'create_kepala_lembaga'])->name('diklat.kepala_create_lembaga');
    Route::get('/diklat-kepala-bagian-data',[KepalaCont::class, 'kepala_data'])->name('diklat.kepala_data');
    Route::get('/diklat-kepala-bagian-edit/{id}',[KepalaCont::class, 'kepala_edit'])->name('diklat.kepala_edit');
    Route::post('/diklat-kepala-bagian-delete',[KepalaCont::class, 'kepala_delete'])->name('diklat.kepala_delete');
    Route::get('/dikalt-kepala-bagian-show',[KepalaCont::class, 'kepala_show'])->name('diklat.kepala_show');
    Route::post('/dikalt-kepala-bagian-store',[KepalaCont::class, 'kepala_store'])->name('diklat.kepala_store');
    Route::post('/diklat-kepala-bagian-cabang-store',[KepalaCont::class, 'tambah_kepala_cabang'])->name('diklat.kepala_cabang_store');
    Route::post('/diklat-kepala-bagian-lembaga-store',[KepalaCont::class, 'tambah_kepala_lembaga'])->name('diklat.kepala_lembaga_store');
    Route::get('/diklat-kepala-bagian-detail/{kepala_id}',[KepalaCont::class,'kepala_detail'])->name('diklat.kepala_detail');
    Route::get('/diklat-kepala-pilih',[KepalaCont::class, 'pilih_kepala'])->name('diklat.kepala_pilih');
    Route::post('/diklat-kepala-bagian-pilih',[KepalaCont::class, 'pilih_kepala_bagian'])->name('diklat.kepala_bagian_pilih');
    Route::post('/diklat-kepala-bagian-pilih-cabang',[KepalaCont::class, 'pilih_kepala_bagian_cabang'])->name('diklat.kepala_bagian_pilih_cabang');

    Route::get('/diklat-lembaga',[LembagaCont::class, 'index'])->name('diklat.lembaga');
    Route::post('/diklat-lembaga-store',[LembagaCont::class,'store'])->name('diklat.lembaga_store');
    Route::get('/diklat-lembaga-data',[LembagaCont::class, 'lembaga_data'])->name('diklat.lembaga_data');
    Route::get('/diklat-lembaga-total',[LembagaCont::class, 'lembaga_total'])->name('diklat.lembaga_tot');
    Route::get('/diklat-lembaga-kabupaten-total',[LembagaCont::class, 'lembaga_kabupaten'])->name('diklat.lembaga_kab');
    Route::get('/diklat-lembaga-provinsi-total',[LembagaCont::class, 'lembaga_provinsi'])->name('diklat.lembaga_pro');
    Route::get('/diklat-lembaga-aktif',[LembagaCont::class,'lembaga_aktif'])->name('diklat.lembaga_aktif');
    Route::get('/diklat-lembaga-non-aktif',[LembagaCont::class,'lembaga_nonaktif'])->name('diklat.lembaga_nonaktif');

    Route::get('/diklat-jenjang',[JenjangCont::class, 'index'])->name('diklat.jenjang');
    Route::get('/diklat-jenjang-data',[JenjangCont::class, 'jenjang_data'])->name('diklat.jenjang_data');
    Route::get('/diklat-jenjang-total',[JenjangCont::class, 'jenjang_total'])->name('diklat.jenjang_tot');
    Route::post('/diklat-jenjang-store',[JenjangCont::class, 'store'])->name('diklat.jenjang_store');
    Route::post('/diklat-jenjang-delete',[JenjangCont::class, 'delete'])->name('diklat.jenjang_delete');

    Route::get('/diklat-program',[ProgramCont::class, 'index'])->name('diklat.program');
    Route::get('/diklat-program-data',[ProgramCont::class, 'program_data'])->name('diklat.program_data');
    Route::get('/diklat-program-total',[ProgramCont::class, 'program_total'])->name('diklat.program_tot');
    Route::post('/diklat-program-store',[ProgramCont::class, 'store'])->name('diklat.program_store');
    Route::post('/diklat-program-delete',[ProgramCont::class, 'delete'])->name('diklat.program_delete');

    Route::get('/diklat-kriteria',[KriteriaCont::class, 'index'])->name('diklat.kriteria');
    Route::get('/diklat-kriteria-data',[KriteriaCont::class, 'kriteria_data'])->name('diklat.kriteria_data');
    Route::get('/diklat-kriteria-total',[KriteriaCont::class, 'kriteria_total'])->name('diklat.kriteria_tot');
    Route::post('/diklat-kriteria-store',[KriteriaCont::class, 'store'])->name('diklat.kriteria_store');
    Route::post('/diklat-kriteria-delete',[KriteriaCont::class, 'delete'])->name('diklat.kriteria_delete');

    Route::get('/diklat-diklat',[DiklatCont::class, 'index'])->name('diklat.diklat');
    Route::get('/diklat-diklat-data',[DiklatCont::class, 'diklat_data'])->name('diklat.diklat_data');
    Route::get('/diklat-diklat-total',[DiklatCont::class, 'diklat_total'])->name('diklat.diklat_tot');
    Route::get('/diklat-diklat-cabang-select',[DiklatCont::class, 'diklat_cabang_select'])->name('diklat.diklat_cabang_select');
    Route::get('/diklat-diklat-create', [DiklatCont::class, 'create'])->name('diklat.create');
    Route::get('/diklat-diklat-cabang-id-select/{name}',[DiklatCont::class, 'diklat_cabang_select_id'])->name('diklat.diklat_cabang_id');
    Route::post('/diklat-diklat-store',[DiklatCont::class, 'store'])->name('diklat.store');
    Route::post('/diklat-diklat-delete',[DiklatCont::class, 'delete'])->name('diklat.delete');
    Route::get('/diklat-diklat-cabang-total', [DiklatCont::class,'diklat_cabang_total'])->name('diklat.diklat_cabang_tot');
    Route::get('/diklat-diklat-cabang-data', [DiklatCont::class,'diklat_cabang_data'])->name('diklat.diklat_cabang_data');
    Route::get('/diklat-diklat-cabang-data/{cabang_id}',[DiklatCont::class,'diklat_cabang_data_view'])->name('diklat.diklat_cabang_data_view');
    Route::get('/diklat-diklat-data-cabang/{cabang_id}',[DiklatCont::class, 'diklat_data_cabang'])->name('diklat.diklat_data_cabang');
    Route::get('/diklat-diklat-total-diklat-cabang/{cabang_id}',[DiklatCont::class, 'total_diklat_cabang'])->name('diklat.diklat_cabang_total');

    Route::get('/diklat-peserta/{id}',[PesertaCont::class, 'index'])->name('diklat.peserta');
    Route::get('/diklat-peserta-data',[PesertaCont::class, 'seluruh_peserta'])->name('diklat.seluruh_peserta');
    Route::get('/diklat-seluruh-peserta-data',[PesertaCont::class, 'seluruh_peserta_data'])->name('diklat.seluruh_peserta_data');
    Route::get('/diklat-peserta-data-kabupaten/{kabupaten_id}/data', [PesertaCont::class, 'seluruh_peserta_data_kabupaten'])->name('diklat.peserta_data_kab');
    Route::get('/diklat-peserta-data/{id}',[PesertaCont::class, 'peserta_data'])->name('diklat.peserta_data');
    Route::get('/diklat-peserta-data-kabupaten/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_view'])->name('diklat.peserta_kab_view');
    Route::get('/diklat-peserta-total',[PesertaCont::class, 'peserta_total'])->name('diklat.peserta_tot');
    Route::get('/diklat-peserta-kabupaten-total/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_total_data'])->name('diklat.peserta_kabu_tot');
    Route::get('/diklat-peserta-kabupaten-total',[PesertaCont::class, 'peserta_kabupaten_total'])->name('diklat.peserta_kabupaten_tot');
    Route::get('/diklat-peserta-kabupaten-total-cabang/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_total_cabang'])->name('diklat.peserta_kab_tot_cab');
    Route::get('/diklat-peserta-kabupaten',[PesertaCont::class,'peserta_kabupaten'])->name('diklat.peserta_kab');
    Route::get('/diklat-peserta-cabang-pilih',[PesertaCont::class, 'peserta_cabang_pilih'])->name('diklat.peserta_cabang_pilih');
    Route::get('/diklat-peserta-kabupaten-cabang-pilih/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_cabang_pilih'])->name('diklat.peserta_kabupaten_cabang_pilih');
    Route::get('/diklat-peserta-diklat-cabang/{cabang_id}',[PesertaCont::class, 'peserta_cabang'])->name('diklat.peserta_cabang');
    Route::get('/diklat-peserta-diklat-cabang-data/{cabang_id}',[PesertaCont::class, 'peserta_cabang_data'])->name('diklat.peserta_cabang_data');
    Route::get('/diklat-peserta-diklat-cabang-total/{cabang_id}',[PesertaCont::class, 'peserta_cabang_total'])->name('diklat.peserta_cabang_tot');
    Route::get('/diklat-peserta-diklat-cabang-kabupaten-total/{cabang_id}',[PesertaCont::class, 'peserta_kabupaten_cabang_total'])->name('diklat.peserta_kab_cab_tot');
    Route::get('/diklat-peserta-diklat-kabupaten-cabang/{cabang_id}',[PesertaCont::class, 'peserta_kabupaten_cabang'])->name('diklat.peserta_cab_kab');
    Route::get('/diklat-total-peserta-pelatihan/{pelatihan_id}',[PesertaCont::class, 'peserta_diklat_total'])->name('diklat.peserta_diklat_tot');
    Route::get('/diklat-peserta-create/{id}',[PesertaCont::class, 'create'])->name('diklat.peserta_create');
    Route::post('/diklat-peserta-store',[PesertaCont::class, 'store'])->name('diklat.peserta_store');
    Route::get('/diklat-peserta-lembaga-id-select/{name}',[PesertaCont::class, 'diklat_lembaga_select_id'])->name('diklat.peserta_lembaga_id');
    Route::get('/diklat-peserta-lembaga-select/{kab}',[PesertaCont::class, 'peserta_lembaga_select'])->name('diklat.peserta_lembaga_select');
    Route::get('/diklat-peserta-kota-select',[PesertaCont::class, 'peserta_kota_select'])->name('diklat.peserta_kota_select');
    Route::post('/diklat-peserta-delete',[PesertaCont::class,'delete'])->name('diklat.peserta_delete');
    Route::get('/diklat-peserta-keseluruhan',[PesertaCont::class, 'peserta_data_keseluruhan'])->name('diklat.peserta_data_keseluruhan');

    Route::post('/diklat-penilaian-store',[PenilaianCont::class,'store'])->name('diklat.penilaian_store'); //insert sekaligus update
    Route::post('/diklat-penilaian-delete',[PenilaianCont::class, 'delete'])->name('diklat.penilaian_delete');

    Route::post('/diklat-nilai-store',[NilaiCont::class,'store'])->name('diklat.nilai_store');
    Route::post('/diklat-nilai-update',[NilaiCont::class,'update'])->name('diklat.nilai_update');
    Route::get('/diklat-nilai-edit/{id}',[NilaiCont::class,'edit'])->name('diklat.nilai_edit');

    Route::get('/diklat-ijazah-depan-guru',[CetakCont::class, 'depan_guru'])->name('diklat.depan_guru');
    Route::get('/diklat-ijazah-belakang',[CetakCont::class, 'belakang'])->name('diklat.belakang');
    Route::get('/diklat-detail-ijazah-peserta',[CetakCont::class, 'detail_peserta'])->name('diklat.detail_peserta');
    Route::get('/diklat-ijazah-depan-santri',[CetakCont::class, 'depan_santri'])->name('diklat.depan_santri');
    Route::post('/diklat-cetak-depan-print', [CetakCont::class, 'cetak_depan'])->name('diklat.depan_cetak');
    Route::post('/diklat-cetak-belakang-print', [CetakCont::class, 'cetak_belakang'])->name('diklat.belakang_cetak');
    Route::post('/diklat-cetak-detail-peserta-print',[CetakCont::class, 'cetak_detail_peserta'])->name('diklat.detail_cetak');

    Route::post('/diklat-import-peserta',[ImportController::class,'importPesertaDiklat'])->name('diklat.import_peserta');

    Route::get('/diklat-dashboard',[DashboardCont::class,'index'])->name('diklat.dashboard');

    Route::get('/sertifikat',[SertifikatCont::class,'index'])->name('sertifikat');
    Route::get('/sertifikat-daftar-pelatihan',[SertifikatCont::class,'daftar_pelatihan'])->name('sertifikat.daftar.pelatihan');
    Route::post('/import/certificate',[SertifikatCont::class,'import_e_sertifikat'])->name('import.certificate');

    Route::get('/diklat-acara',[AcaraCont::class,'index'])->name('acara');
    Route::get('/diklat-acara-data',[AcaraCont::class,'data_acara'])->name('acara.data');
    Route::post('/diklat-data-post',[AcaraCont::class,'store'])->name('acara.store');
    Route::get('/peserta-acara/{acara_id}',[AcaraCont::class,'daftar_peserta_acara'])->name('acara.peserta');
    Route::get('/data-peserta-acara/{acara_id}',[AcaraCont::class,'data_peserta_acara'])->name('acara.data_peserta');

    Route::get('/export-peserta-acara/{acara_id}',[AcaraCont::class,'export_peserta_acara'])->name('export.peserta.acara');

});

Route::group(['middleware' => ['auth', 'CheckRole:bendahara']], function () {
    Route::get('/data-calon-peserta-diklat/{program_id}/{diklat_id}',[RegistrasiCont::class, 'konfirmasi']);
    Route::get('/konfirmasi-data-calon-peserta-diklat/{diklat_id}',[RegistrasiCont::class, 'data_calon_peserta']);

    Route::get('/daftar-diklat-menunggu-konfirmasi',[KonfirmasiCont::class, 'index'])->name('daftar_diklat_konfirmasi');
    Route::get('/data-diklat-menunggu-konfirmasi',[KonfirmasiCont::class, 'data_diklat_menunggu_konfirmasi'])->name('data_diklat_konfirmasi');
    Route::get('/daftar-data-peserta/{slug_diklat}',[KonfirmasiCont::class, 'daftar_peserta_diklat_menunggu_konfirmasi'])->name('daftar_peserta_diklat_konfirmasi');
    Route::get('/konfirmasi-data-peserta/{diklat_id}',[KonfirmasiCont::class, 'data_peserta_diklat_menunggu_konfirmasi'])->name('data_peserta_diklat_konfirmasi');
});

Route::post('/broadcast',[BroadcastController::class, 'broadcast_pelatihan'])->name('broadcast');

// Route::get('send-mail', function () {
   
//     $details = [
//         'title' => 'Mail from tilawatipusat.com',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     Mail::to('febrirtah@gmail.com')->send(new MyTestMail($details));
   
//     dd("Email is Sent broo.");
// });