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
use App\Http\Controllers\TTDController;
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
use App\Http\Controllers\SyahadahCont;
use App\Http\Controllers\ProfileCont;
use App\Http\Controllers\NilaiCont;
use App\Http\Controllers\TeritoriCont;
use App\Http\Controllers\KepalaCont;
use App\Http\Controllers\RegistrasiCont;
use App\Http\Controllers\LandingCont;
use App\Http\Controllers\KonfirmasiCont;
use App\Http\Controllers\ExportCont;
use App\Http\Controllers\SertifikatCont;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\WebinarCont;
use App\Http\Controllers\ErrorCont;
use App\Http\Controllers\ApicabangCont;
use App\Http\Controllers\CekController;
use App\Http\Controllers\TemplateDownloadCont;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\KodeAdminCont;
use App\Http\Controllers\DashboardCabang;
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
    // return view('maintenance');
});

Route::get('/urut-cabang',[CabangCont::class,'urut_cabang']);
Route::post('/download-template',[TemplateDownloadCont::class,'download_template'])->name('download.template');

Route::get('/e-certificate/{slug_diklat}',[LandingCont::class,'ecertificate']);
Route::get('/data/e-certificate/{diklat_id}',[LandingCont::class,'ecertificate_data']);
Route::get('/tes_data',[LandingCont::class,'tes_data']);
Route::get('/pilih-daftar-kabupaten',[SubController::class, 'fetch_kabupaten'])->name('kabupaten');
Route::post('/pilih-tambah-kota-lembaga',[LembagaCont::class, 'add_kota'])->name('add_kota_lembaga');
Route::post('/pilih-tambah-kota',[PesertaCont::class, 'add_kota'])->name('add_kota');
Route::post('/pilih-tambah-kota2',[PesertaCont::class, 'add_kota2'])->name('add_kota2');
Route::post('/pilih-tambah-kota3',[PesertaCont::class, 'add_kota3'])->name('add_kota3');
Route::post('/pilih-tambah-tgl',[PesertaCont::class, 'add_tgl'])->name('add_tgl');
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

Route::get('/fetchnampro/{namaprogram}',[SubController::class, 'fetchnampro']);

//fetch program dan pelatihan untuk print
Route::get('/fetchpp/{id}',[SubController::class, 'fetchpp']);
//submit registrasi pendaftaran online
Route::post('/pendaftaran-peserta-diklat',[RegistrasiCont::class,'registrasi'])->name('diklat.registrasi1');
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
    Route::get('/dashboard/cabang-total',[DashboardController::class,'daterangecabang'])->name('cabang.filter');//get data cabang range ajax dashboard
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
    // Route::get('/pelatihan-user-data',[UserController::class, 'getuser_data'])->name('user.data');
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
    Route::post('/pelatihan-teritorial-post',[TeritorialController::class, 'store'])->name('teritorial.store');
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
    // Route::get('/pelatihan-lembaga-data-cabang',[LembagaController::class, 'getlembaga_data_cabang'])->name('lembaga.data.cabang');
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
    Route::post('/hapus-pelatihan-cabang', [SubController::class, 'hapuscabang'])->name('cabang.pelatihan.hapus');
    //import
    Route::post('/importPeserta',[ImportController::class,'importPeserta'])->name('import.peserta');
    Route::post('/importPesertaGuru',[ImportController::class,'importPesertaGuru'])->name('import.pesertaG');
    Route::post('/importPesertaToT',[ImportController::class,'importPesertaToT'])->name('import.pesertaToT');
    Route::post('/importPesertaTahfidz',[ImportController::class,'importPesertaTahfidz'])->name('import.pesertaTahfidz');
    Route::post('/importPesertaMunaqisy',[ImportController::class,'importPesertaMunaqisy'])->name('import.pesertaMunaqisy');
    Route::post('/importCabang',[ImportController::class, 'importCabang'])->name('import.cabang');
    Route::post('/importRpq',[ImportController::class, 'importRpq'])->name('import.rpq');
    Route::post('/importLembaga',[ImportController::class, 'importLembaga'])->name('import.lembaga');
    Route::post('/importTrainer',[ImportController::class, 'importTrainer'])->name('import.trainer');
    Route::post('/importMunaqisy',[ImportController::class, 'importMunaqisy'])->name('import.munaqisy');
    Route::post('/importKpa',[ImportController::class,'importKpa'])->name('import.kpa');
    Route::post('/importSupervisor',[ImportController::class,'importSupervisor'])->name('import.supervisor');
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
    Route::post('/diklat-lembaga-update',[LembagaCont::class,'store2'])->name('diklat.lembaga_store2');
    Route::get('/diklat-lembaga-data',[LembagaCont::class, 'lembaga_data'])->name('diklat.lembaga_data');
    Route::get('/diklat-lembaga-data-cabang/{cabang_id}',[LembagaCont::class, 'lembaga_data_cabang'])->name('diklat.lembaga_data_cabang');
    Route::get('/diklat-lembaga-total',[LembagaCont::class, 'lembaga_total'])->name('diklat.lembaga_tot');
    Route::get('/diklat-lembaga-total2',[LembagaCont::class, 'lembaga_total2'])->name('diklat.lembaga_tot2');
    Route::get('/diklat-lembaga-kabupaten-total',[LembagaCont::class, 'lembaga_kabupaten'])->name('diklat.lembaga_kab');
    Route::get('/diklat-lembaga-provinsi-total',[LembagaCont::class, 'lembaga_provinsi'])->name('diklat.lembaga_pro');
    Route::get('/diklat-lembaga-aktif',[LembagaCont::class,'lembaga_aktif'])->name('diklat.lembaga_aktif');
    Route::get('/diklat-lembaga-non-aktif',[LembagaCont::class,'lembaga_nonaktif'])->name('diklat.lembaga_nonaktif');
    Route::get('/diklat-lembaga-aktif2',[LembagaCont::class,'lembaga_aktif2'])->name('diklat.lembaga_aktif2');
    Route::get('/diklat-lembaga-non-aktif2',[LembagaCont::class,'lembaga_nonaktif2'])->name('diklat.lembaga_nonaktif2');

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

    Route::get('/diklat-webinar-cteate',[WebinarCont::class, 'create'])->name('webinar.create');
    Route::get('/diklat-webinar',[WebinarCont::class, 'index'])->name('diklat.webinar');
    Route::get('/diklat-webinar-data',[WebinarCont::class, 'webinar_data'])->name('diklat.webinar_data');
    Route::get('/diklat-webinar-total',[WebinarCont::class, 'webinar_total'])->name('diklat.webinar_tot');
    Route::get('/diklat-webinar-cabang-total', [WebinarCont::class,'webinar_cabang_total'])->name('diklat.webinar_cabang_tot');
    Route::get('/diklat-webinar-program-total', [WebinarCont::class,'webinar_program_total'])->name('diklat.webinar_program_tot');
    Route::get('/diklat-webinar-cabang-data/{cabang_id}', [WebinarCont::class,'webinar_cabang_data'])->name('diklat.webinar_cabang_data');
    Route::get('/diklat-webinar-program-data', [WebinarCont::class,'webinar_program_data'])->name('diklat.webinar_program_data');

    Route::get('/diklat-diklat',[DiklatCont::class, 'index'])->name('diklat.diklat');
    Route::get('/diklat-diklat-data',[DiklatCont::class, 'diklat_data'])->name('diklat.diklat_data');
    Route::get('/diklat-diklat-total',[DiklatCont::class, 'diklat_total'])->name('diklat.diklat_tot');
    Route::get('/diklat-diklat-cabang-select',[DiklatCont::class, 'diklat_cabang_select'])->name('diklat.diklat_cabang_select');
    Route::get('/diklat-diklat-create', [DiklatCont::class, 'create'])->name('diklat.create');
    Route::get('/diklat-diklat-cabang-id-select/{name}',[DiklatCont::class, 'diklat_cabang_select_id'])->name('diklat.diklat_cabang_id');
    Route::post('/diklat-diklat-store',[DiklatCont::class, 'store'])->name('diklat.store');
    Route::post('/diklat-diklat-store-edit-wa',[DiklatCont::class, 'storeeditwa'])->name('diklat.storeeditwa');
    Route::post('/diklat-diklat-store-image-flyer',[DiklatCont::class,'storeflyer'])->name('diklat.storeflyer');
    Route::post('/diklat-diklat-delete',[DiklatCont::class, 'delete'])->name('diklat.delete');
    Route::get('/diklat-diklat-cabang-total', [DiklatCont::class,'diklat_cabang_total'])->name('diklat.diklat_cabang_tot');
    Route::get('/diklat-diklat-program-total', [DiklatCont::class,'diklat_program_total'])->name('diklat.diklat_program_tot');
    Route::get('/diklat-diklat-cabang-data', [DiklatCont::class,'diklat_cabang_data'])->name('diklat.diklat_cabang_data');
    Route::get('/diklat-diklat-program-data', [DiklatCont::class,'diklat_program_data'])->name('diklat.diklat_program_data');
    Route::get('/diklat-diklat-program-cabang/{cabang_id}',[DiklatCont::class,'diklat_cabang_pilih']);
    Route::get('/diklat-diklat-cabang-data/{cabang_id}',[DiklatCont::class,'diklat_cabang_data_view'])->name('diklat.diklat_cabang_data_view');
    Route::get('/diklat-diklat-data-cabang/{cabang_id}',[DiklatCont::class, 'diklat_data_cabang'])->name('diklat.diklat_data_cabang');
    Route::get('/diklat-diklat-total-diklat-cabang/{cabang_id}',[DiklatCont::class, 'total_diklat_cabang'])->name('diklat.diklat_cabang_total');
    Route::get('/diklat-diklat-program-data/{program_id}',[DiklatCont::class,'diklat_program_data_view']);
    Route::get('/diklat-diklat-data-program/{program_id}',[DiklatCont::class,'diklat_data_program']);
    Route::get('/diklat-diklat-total-diklat-program/{program_id}',[DiklatCont::class, 'total_diklat_program']);
    Route::get('/diklat-diklat-total-program-cabang/{cabang_id}',[DiklatCont::class, 'diklat_program_cabang_total']);
    Route::get('/diklat-diklat-total-peserta-cabang/{caban_id}',[DiklatCont::class,'diklat_peserta_cabang_total']);

    Route::get('/halaman-update-data-peserta/{peserta_id}',[PesertaCont::class, 'update_peserta_view']);
    Route::get('/diklat-total-seluruh-peserta-bersyahadah',[PesertaCont::class, 'total_seluruh_peserta_bersyahadah']);
    Route::post('/update-data-peserta',[PesertaCont::class, 'update_data_peserta'])->name('update.data.peserta');
    Route::get('/diklat-peserta-webinar/{id}',[PesertaCont::class, 'index2'])->name('diklat.peserta_webinar');
    Route::get('/diklat-peserta/{id}',[PesertaCont::class, 'index'])->name('diklat.peserta');
    Route::get('/diklat-peserta-data',[PesertaCont::class, 'seluruh_peserta'])->name('diklat.seluruh_peserta');
    Route::get('/diklat-seluruh-peserta-data',[PesertaCont::class, 'seluruh_peserta_data'])->name('diklat.seluruh_peserta_data');
    Route::get('/diklat-seluruh-syahadah-peserta/{program_id}',[PesertaCont::class, 'syahadah'])->name('diklat.syahadah_peserta');
    Route::get('/diklat-total-selruh-peserta-program/{progra_id}',[PesertaCont::class, 'total_peserta_program'])->name('diklat.total_peserta_program');
    Route::get('/diklat-peserta-data-kabupaten/{kabupaten_id}/data', [PesertaCont::class, 'seluruh_peserta_data_kabupaten'])->name('diklat.peserta_data_kab');
    Route::get('/diklat-peserta-data/{id}',[PesertaCont::class, 'peserta_data'])->name('diklat.peserta_data');
    Route::get('/diklat-peserta-data-kabupaten/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_view'])->name('diklat.peserta_kab_view');
    Route::get('/diklat-peserta-total',[PesertaCont::class, 'peserta_total'])->name('diklat.peserta_tot');
    Route::get('/diklat-peserta-kabupaten-total/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_total_data'])->name('diklat.peserta_kabu_tot');
    Route::get('/diklat-peserta-kabupaten-total',[PesertaCont::class, 'peserta_kabupaten_total'])->name('diklat.peserta_kabupaten_tot');
    Route::get('/diklat-peserta-kabupaten-total-cabang/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_total_cabang'])->name('diklat.peserta_kab_tot_cab');
    Route::get('/diklat-peserta-program-total',[PesertaCont::class, 'peserta_program_total'])->name('diklat.peserta_program_tot');
    Route::get('/diklat-peserta-cabang-program-total/{cabang_id}',[PesertaCont::class, 'peserta_cabang_program_total']);
    Route::get('/diklat-peserta-program-pilih',[PesertaCont::class, 'peserta_program_pilih'])->name('diklat.peserta_program_pilih');
    Route::get('/diklat-peserta-cabang-program-pilih/{cabang_id}',[PesertaCont::class, 'peserta_cabang_program_pilih']);
    Route::get('/diklat-peserta-diklat-program/{program_id}',[PesertaCont::class, 'peserta_program'])->name('diklat.peserta_program');
    Route::get('/diklat-peserta-diklat-program-data/{program_id}',[PesertaCont::class, 'peserta_program_data'])->name('diklat.peserta_program_data');
    Route::get('/diklat-peserta-kabupaten',[PesertaCont::class,'peserta_kabupaten'])->name('diklat.peserta_kab');
    Route::get('/diklat-peserta-cabang-pilih',[PesertaCont::class, 'peserta_cabang_pilih'])->name('diklat.peserta_cabang_pilih');
    Route::get('/diklat-peserta-kabupaten-cabang-pilih/{kabupaten_id}',[PesertaCont::class, 'peserta_kabupaten_cabang_pilih'])->name('diklat.peserta_kabupaten_cabang_pilih');
    Route::get('/diklat-peserta-diklat-cabang/{cabang_id}',[PesertaCont::class, 'peserta_cabang'])->name('diklat.peserta_cabang');
    Route::get('/diklat-peserta-diklat-cabang-data/{cabang_id}',[PesertaCont::class, 'peserta_cabang_data'])->name('diklat.peserta_cabang_data');
    Route::get('/diklat-peserta-diklat-cabang-total/{cabang_id}',[PesertaCont::class, 'peserta_cabang_total'])->name('diklat.peserta_cabang_tot');
    Route::get('/diklat-peserta-diklat-cabang-kabupaten-total/{cabang_id}',[PesertaCont::class, 'peserta_kabupaten_cabang_total'])->name('diklat.peserta_kab_cab_tot');
    Route::get('/diklat-peserta-data-cabang-bersyahadah/{cabang_id}',[PesertaCont::class, 'total_seluruh_peserta_cabang_bersyahadah']);
    Route::get('/diklat-peserta-diklat-kabupaten-cabang/{cabang_id}',[PesertaCont::class, 'peserta_kabupaten_cabang'])->name('diklat.peserta_cab_kab');
    Route::get('/diklat-total-peserta-pelatihan/{pelatihan_id}',[PesertaCont::class, 'peserta_diklat_total'])->name('diklat.peserta_diklat_tot');
    Route::get('/diklat-peserta-create/{id}',[PesertaCont::class, 'create'])->name('diklat.peserta_create');
    Route::post('/diklat-peserta-store',[PesertaCont::class, 'store'])->name('diklat.peserta_store');
    Route::get('/diklat-peserta-lembaga-id-select/{name}',[PesertaCont::class, 'diklat_lembaga_select_id'])->name('diklat.peserta_lembaga_id');
    Route::get('/diklat-peserta-lembaga-select/{kab}',[PesertaCont::class, 'peserta_lembaga_select'])->name('diklat.peserta_lembaga_select');
    Route::get('/diklat-peserta-kota-select',[PesertaCont::class, 'peserta_kota_select'])->name('diklat.peserta_kota_select');
    Route::post('/diklat-peserta-delete',[PesertaCont::class,'delete'])->name('diklat.peserta_delete');
    Route::get('/diklat-peserta-keseluruhan',[PesertaCont::class, 'peserta_data_keseluruhan'])->name('diklat.peserta_data_keseluruhan');
    Route::post('/ubah-alamat-modul',[PesertaCont::class,'ubah_alamat_modul'])->name('diklat.peserta_alamatx');
    Route::get('/remove-kecamatan-kelurahan/{id}',[PesertaCont::class,'remove_kecamatan_kelurahan']);

// memecah peserta diklat
    Route::post('/memecah-peserta-diklat',[DiklatCont::class,'pindahkan_peserta']);


//  Percabangan Laporan Peserta
    Route::get('/halaman-data-peserta-berdasarkan-cabang-dan-program/{cabang_id}/{program_id}',[PesertaCont::class, 'halaman_peserta_cabang_program']);


    Route::get('/peserta_yang_kabupatennya_kosong/{pelatihan_id}',[PesertaCont::class,'peserta_yang_kabupatennya_kosong']);

    Route::post('/diklat-penilaian-store',[PenilaianCont::class,'store'])->name('diklat.penilaian_store'); //insert sekaligus update
    Route::post('/diklat-penilaian-delete',[PenilaianCont::class, 'delete'])->name('diklat.penilaian_delete');

    Route::post('/diklat-nilai-store',[NilaiCont::class,'store'])->name('diklat.nilai_store');
    Route::post('/diklat-nilai-update',[NilaiCont::class,'update'])->name('diklat.nilai_update');
    Route::get('/diklat-nilai-edit/{id}',[NilaiCont::class,'edit'])->name('diklat.nilai_edit');
 
    Route::get('/diklat-ijazah-depan-guru',[CetakCont::class, 'depan_guru'])->name('diklat.depan_guru');
    Route::get('/diklat-ijazah-depan-guru-lama',[CetakCont::class, 'depan_guru_lama'])->name('diklat.depan_guru_lama');

    Route::get('/diklat-ijazah-belakang',[CetakCont::class, 'belakang'])->name('diklat.belakang');
    Route::get('/diklat-detail-ijazah-peserta',[CetakCont::class, 'detail_peserta'])->name('diklat.detail_peserta');
    Route::get('/diklat-ijazah-depan-santri',[CetakCont::class, 'depan_santri'])->name('diklat.depan_santri');
    Route::post('/diklat-cetak-depan-print', [CetakCont::class, 'cetak_depan'])->name('diklat.depan_cetak');
    Route::post('/diklat-cetak-depan-print2', [CetakCont::class, 'cetak_depan_syahadah'])->name('diklat.depan_cetak_syahadah');
    Route::post('/diklat-cetak-belakang-print', [CetakCont::class, 'cetak_belakang'])->name('diklat.belakang_cetak');
    Route::post('/diklat-cetak-belakang-print-bagian-1', [CetakCont::class, 'cetak_belakang_bagian_1'])->name('diklat.belakang_cetak_bagian_1');
    Route::post('/diklat-cetak-belakang-print-bagian-2', [CetakCont::class, 'cetak_belakang_bagian_2'])->name('diklat.belakang_cetak_bagian_2');
    Route::post('/diklat-cetak-belakang-print2', [CetakCont::class, 'cetak_belakang2'])->name('diklat.belakang_cetak2');
    Route::post('/diklat-cetak-detail-peserta-print',[CetakCont::class, 'cetak_detail_peserta'])->name('diklat.detail_cetak');
    Route::post('/diklat-cetak-surat-pengiriman',[CetakCont::class,'cetak_surat_pengiriman'])->name('diklat.cetak_surat_pengiriman');
    Route::post('/diklat-cetak-surat-pengiriman-satu',[CetakCont::class,'cetak_surat_pengiriman_satu'])->name('diklat.cetak_surat_pengiriman_satu');
    Route::post('/diklat-cetak-surat-pengiriman-beberapa',[CetakCont::class,'cetak_surat_pengiriman_beberapa'])->name('diklat.cetak_surat_pengiriman_beberapa');
    Route::post('/pelatihan-cetak-depan-print-beberapa', [CetakCont::class, 'cetak_depan_beberapa'])->name('depan.cetak_beberapa');
    Route::post('/pelatihan-cetak-belakang-print-beberapa', [CetakCont::class, 'cetak_belakang_beberapa'])->name('belakang.cetak_beberapa');
    Route::post('/pelatihan-cetak-peserta-depan-versi-lama-beberapa',[CetakCont::class,'cetak_depan_lama_beberapa'])->name('depan.cetak_versi_lama_beberapa');
    Route::post('/pelatihan-cetak-peserta-depan-versi-lama',[CetakCont::class,'cetak_depan_lama'])->name('depan.cetak_versi_lama');
    
    Route::post('/peserta-hapus-beberapa',[PesertaCont::class,'hapus_beberapa'])->name('peserta.hapus_beberapa');

    Route::post('/diklat-import-peserta',[ImportController::class,'importPesertaDiklat'])->name('diklat.import_peserta');

    // FOR NEW CHART
    Route::get('/diklat-dashboard',[DashboardCont::class,'index'])->name('diklat.dashboard');
    Route::get('/chart-lembaga-formal',[DashboardCont::class,'lembaga_formal'])->name('chart.lembaga.formal');
    Route::get('/chart-lembaga-non-formal',[DashboardCont::class,'lembaga_non_formal'])->name('chart.lembaga.nonformal');
    Route::get('/chart-perkembangan-pengguna',[DashboardCont::class,'perkembangan_pengguna'])->name('chart.perkembangan.pengguna');
    Route::get('/chart-perkembangan-pengguna-bulanan',[DashboardCont::class,'perkembangan_pengguna_bulanan'])->name('chart.perkembangan.bulanan');
    // MAPS
    Route::get('/maps-data-cabang',[DashboardCont::class,'maps_data_cabang'])->name('maps.data.cabang');
    Route::post('/maps-data-cabang-store',[CabangCont::class,'store_location_cabang'])->name('maps.cabang.store');

    Route::get('/sertifikat',[SertifikatCont::class,'index'])->name('sertifikat');
    Route::get('/sertifikat-daftar-pelatihan',[SertifikatCont::class,'daftar_pelatihan'])->name('sertifikat.daftar.pelatihan');
    Route::post('/import/certificate',[SertifikatCont::class,'import_e_sertifikat'])->name('import.certificate');
    Route::post('/store-induksertifikat',[SertifikatCont::class,'store_induksertifikat'])->name('store.induksertifikat');
    Route::get('/data-induk-sertifikat',[SertifikatCont::class,'data_induksertifikat'])->name('data.induksertifikat');
    Route::post('/generate-program-id',[SertifikatCont::class,'generate_program_id']);
    Route::post('/delete-induk-sertifikat',[SertifikatCont::class, 'delete_induksertifikat'])->name('delete.induksertifikat');

    Route::get('/diklat-acara',[AcaraCont::class,'index'])->name('acara');
    Route::get('/diklat-acara-data',[AcaraCont::class,'data_acara'])->name('acara.data');
    Route::post('/diklat-data-post',[AcaraCont::class,'store'])->name('acara.store');
    Route::get('/peserta-acara/{acara_id}',[AcaraCont::class,'daftar_peserta_acara'])->name('acara.peserta');
    Route::get('/data-peserta-acara/{acara_id}',[AcaraCont::class,'data_peserta_acara'])->name('acara.data_peserta');

    Route::get('/export-peserta-acara/{acara_id}',[AcaraCont::class,'export_peserta_acara'])->name('export.peserta.acara');
    Route::get('/export-seluruh-peserta',[ExportCont::class,'export_seluruh_peserta'])->name('export.seluruh.peserta');
    Route::get('/export-broadcast-peserta',[ExportCont::Class,'export_broadcast_peserta'])->name('export.broadcast.peserta');
    Route::get('/export-broadcast-peserta-webinar',[ExportCont::class,'export_broadcast_peserta_webinar'])->name('export.broadcast.peserta_webinar');
    Route::post('/export-peserta-pendaftaran',[ExportCont::class,'export_peserta_pendaftaran'])->name('export.peserta.pendaftaran');
    Route::get('/export-data-cabang',[ExportCont::class,'export_data_cabang'])->name('export.data.cabang');
    Route::get('/export-kpa-cabang',[ExportCont::class,'export_kpa_cabang'])->name('export.kpa.cabang');
    Route::get('/export-template-trainer',[ExportCont::class,'export_template_trainer_cabang'])->name('export.template.trainer.cabang');
    Route::get('/export-data-trainer-seluruhnya',[ExportCont::class,'export_data_trainer_all']);
    Route::get('/export-template-trainer-data/{cabang_id}',[ExportCont::class,'export_template_trainer_cabang_data'])->name('export.template.trainer.cabang.data');
    Route::get('/export-template-kpa',[ExportCont::class,'export_template_kpa_cabang'])->name('exmport.template.kpa.cabang');
    Route::get('/export-template-kpa-data/{cabang_id}',[ExportCont::class,'export_template_kpa_cabang_data'])->name('exmport.template.kpa.cabang.data');
    Route::get('/export-template-lembaga',[ExportCont::class,'export_template_lembaga_cabang'])->name('export.template.lembaga.cabang');
    Route::get('/export-template-lembaga/{cabang_id}',[ExportCont::class,'export_template_lembaga_cabang_data'])->name('export.template.lembaga.cabang.data');
    Route::get('/export-download-data-cabang',[ExportCont::class,'download_data_cabang']);
    Route::get('/export-template-munaqisy',[ExportCont::class,'export_template_munaqisy_cabang']);
    Route::get('/export-template-munaqisy-data/{cabang_id}',[ExportCont::class,'export_template_munaqisy_cabang_data']);
    Route::get('/export-template-supervisor-data/{cabang_id}',[ExportCont::class,'export_template_supervisor_cabang_data']);

    Route::get('/kode-negara',[KodeAdminCont::class,'page_negara'])->name('negara');
    Route::get('/data-kode-negara',[KodeAdminCont::class,'data_negara'])->name('data_negara');
    Route::get('/data-kode-phone-negara',[KodeAdminCont::class,'data_phonecode'])->name('data_phonecode');
    Route::get('/data-kabupaten',[KodeAdminCont::class,'data_kabupaten'])->name('data_kabupaten');
    Route::post('/import-data-kode-negara',[KodeAdminCont::class,'import_kode'])->name('import_kode');
    Route::post('/import-data-kode-negara-aksen-indo',[KodeAdminCont::class,'import_kode2'])->name('import_kode2');
    Route::get('/kode-phone',[KodeAdminCont::class,'page_phone'])->name('phone');
    Route::get('/kode-kabupaten',[KodeAdminCont::class,'page_kabupaten']);

    Route::get('/data-calon-peserta-diklat/{program_id}/{diklat_id}',[RegistrasiCont::class, 'konfirmasi']);
    Route::get('/konfirmasi-data-calon-peserta-diklat/{diklat_id}',[RegistrasiCont::class, 'data_calon_peserta']);

    Route::get('/daftar-diklat-menunggu-konfirmasi',[KonfirmasiCont::class, 'index'])->name('daftar_diklat_konfirmasi');
    Route::get('/data-diklat-menunggu-konfirmasi',[KonfirmasiCont::class, 'data_diklat_menunggu_konfirmasi'])->name('data_diklat_konfirmasi');
    Route::get('/daftar-data-peserta/{slug_diklat}',[KonfirmasiCont::class, 'daftar_peserta_diklat_menunggu_konfirmasi'])->name('daftar_peserta_diklat_konfirmasi');
    Route::get('/konfirmasi-data-peserta/{diklat_id}',[KonfirmasiCont::class, 'data_peserta_diklat_menunggu_konfirmasi'])->name('data_peserta_diklat_konfirmasi');
    Route::post('/konfirmasi-data-peserta-acc',[KonfirmasiCont::class,'acc'])->name('acc');

    // NEW KONFIRMASI PESERTA DIKLAT DARI CABANG
    Route::get('/konfirmasi-data-calon-peserta/{cabang_id}',[KonfirmasiCont::class,'new_konfirmasi_index'])->name('new.konfirmasi.index');
    Route::get('/total_peserta_menunggu_konfirmasi/{cabang_id}',[KonfirmasiCont::class,'total_peserta_menunggu_konfirmasi']);
    Route::get('/data_forward_konfirm_cabang/{pelatihan_id}',[DiklatCont::class,'data_forward_konfirm_cabang']);
    Route::post('/submit-forward-cabang',[DiklatCont::class,'submit_forward_cabang'])->name('submit.forward.cabang');
    Route::get('/remove-share-forward/{forward_id}',[DiklatCont::class,'remove_share_forward']);

    Route::post('/peserta-pindah-pelatihan',[DiklatCont::class,'peserta_pindah_pelatihan'])->name('peserta_pindah_pelatihan');
    Route::post('/generate_qr',[DiklatCont::class,'generate_qr'])->name('generate_qr');
    Route::post('/download_qr',[DiklatCont::class,'download_qr'])->name('download_qr');

    Route::post('/generate_qr_tilawati',[DashboardCont::class,'generate_qr_tilawati'])->name('generate_qr_tilawati');
    Route::post('/download_qr_tilawati',[DashboardCont::class,'download_qr_tilawati'])->name('download_qr_tilawati');
    Route::post('/generate-user',[DashboardCont::class, 'generate'])->name('generate_user');
    Route::get('/search-infografis-data',[DashboardCont::class,'total_infografis_data']);
    
    // NEW INFO GRAFIS



    // NEW DATA USER DLL
    Route::get('/daftar-pengguna',[UserController::class,'daftar_pengguna'])->name('daftar_pengguna');
    Route::get('/data-pengguna',[UserController::class, 'getuser_data'])->name('user.data');
    Route::post('/reset-password',[UserController::class,'reset_password'])->name('reset_pass');
    Route::post('/ubah-password',[UserController::class,'ganti_pass'])->name('ganti_pass');
    Route::post('/export-user',[ExportCont::class,'export_user'])->name('export.user');
    Route::post('/buat-user-baru',[UserController::class,'buat_user_baru']);

    Route::get('/export-data-peserta/{cabang_id}/{pelatihan_id}',[ExportCont::class,'export_data_peserta']);

    // NEW DATA SUPERVISOR RAKERNAS
    Route::get('/data-supervisor/cabang',[CabangCont::class,'data_supervisor'])->name('data.supervisor.cabang');
    Route::get('/list-supervisor/cabang',[CabangCont::class,'list_supervisor_cabang'])->name('list.supervisor.cabang');
    Route::get('/hapus/data/supervisor/{cabang_id}',[CabangCont::class,'remove_supervisor']);
    Route::post('/store-supervisor-cabang',[CabangCont::class,'store_supervisor_cabang']);
    Route::post('/remove-supervisor-cabang',[CabangCont::class,'remove_supervisor_cabang']);
    // NEW DATA MUNAQISY RAKERNAS
    Route::get('/data-munaqisy/cabang',[CabangCont::class,'data_munaqisy'])->name('data.munaqisy.cabang');
    Route::get('/list-munaqisy/cabang',[CabangCont::class,'list_munaqisy_cabang'])->name('list.munaqisy.cabang');
    Route::get('/hapus/data/munaqisy/{cabang_id}',[CabangCont::class,'remove_munaqisy']);
    Route::post('/store-munaqisy-cabang',[CabangCont::class,'store_munaqisy_cabang']);
    Route::post('/remove-munaqisy-cabang',[CabangCont::class,'remove_munaqisy_cabang']);
    // Route::get('/data-munaqisy',[SubController::class,'hapus_data_munaqisy'])->name();

    

    // NEW DATA CABANG RAKERNAS
    Route::get('/data-trainer/cabang',[CabangCont::class,'data_trainer'])->name('data.trainer.cabang');
    Route::get('/edit-trainer/cabang/{trainer_id}',[CabangCont::class,'edit_trainer'])->name('edit.trainer');
    Route::get('/list-data-trainer/cabang',[CabangCont::class,'list_trainer_cabang'])->name('list.trainer.cabang');
    Route::get('/show-list-data-trainer/{cabang_id}',[CabangCont::class,'show_list_trainer_cabang'])->name('show.list.trainer.cabang');
    Route::post('/store-data-trainer/cabang',[CabangCont::class,'store_trainer_cabang'])->name('store.trainer.cabang');
    Route::post('/delete-data-trainer/cabang',[CabangCont::class,'delete_trainer_cabang'])->name('delete.trainer.cabang');
    Route::post('/update-data-trainer',[CabangCont::class,'update_data_trainer'])->name('update.data.trainer');
    Route::post('/add-data-trainer',[CabangCont::class,'add_data_trainer'])->name('add.data.trainer');
    // NEW DATA KPA CABANG RAKERNAS
    Route::get('/data-kpa/cabang',[CabangCont::class,'data_kpa'])->name('data.kpa.cabang');
    Route::get('/show-data-kpa/{cabang_id}',[CabangCont::class,'show_data_kpa'])->name('show.data.kpa.cabang');
    Route::post('/store-data-kpa/cabang',[CabangCont::class,'store_kpa_cabang'])->name('store.kpa.cabang');
    Route::post('/delete-data-kpa/cabang',[CabangCont::class,'delete_kpa_cabang'])->name('delete.kpa.cabang');
    // KEPALA CABANG
    Route::post('/update-cabang',[CabangCont::class,'update_cabang'])->name('update.cabang');
    Route::get('/generate_kepala',[CabangCont::class,'generate_kepala']);
    Route::post('/cabang-hapus',[CabangCont::class,'cabang_hapus'])->name('cabang.hapus');

    //LEMBAGA DELETE
    Route::post('/lembaga-hapus',[LembagaCont::class,'lembaga_hapus'])->name('lembaga.hapus');
    Route::get('/halaman-update-lembaga/{lembaga_kode}',[LembagaCont::class,'halaman_edit']);

    //LAPORAN RECAP TOTAL CABANG 
    Route::get('/program-cabang-pilih',[PesertaCont::class,'program_cabang_pilih']);
    
    // EXPORT TEMPLATE DIKLAT NEW 
    Route::get('/export-template-diklat/{jenis}',[ExportCont::class,'export_template_diklat']);
    Route::get('/export-peserta-diklat/{pelatihan_id}',[ExportCont::class,'export_data_peserta']);
    Route::get('/export-peserta-diklat-full/{pelatihan}',[ExportCont::class,'export_data_peserta_full']);
    Route::get('/export-peserta-diklat-untuk-import/{pelatihan}',[ExportCont::class,'export_data_peserta_untuk_import']);
    

    // EXPORT LEMBAGA SEARCH
    Route::post('/export-lembaga-search-provinsi',[ExportCont::class,'export_lembaga_search_provinsi']);

    // EXPORT LAPORAN CABANG BERKALA
    Route::post('/export-laporan-data-cabang',[ExportCont::class,'export_laporan_data_cabang']);
    Route::post('/export-laporan-data-perkembangan',[ExportCont::class,'export_laporan_data_perkembangan']);

    //IMPORT WITHOUT QUEUE & QR
    Route::post('/import-peserta-diklat2',[ImportController::class,'import_peserta_diklat2'])->name('import-peserta-diklat2');
    //QR 
    Route::get('/cek-qr-code/{pelatihan_id}',[CekController::class,'cek_qr']);
    Route::get('/generate_qr_peserta/{pelatihan_id}',[CekController::class,'generate_qr_peserta']);
    Route::post('/force_qr',[CekController::class,'force_qr']);
    Route::get('/reset-status-qr/{pelatihan_id}', [CekController::class,'reset_stat_qr']);

    // HAPUS SEMuA LEMBAGA CABANG
    Route::get('/hapus-lembaga/{cabang_id}',[LembagaCont::class,'hapus_semua']);

    Route::get('/minta-modul/{pelatihan_id}',[PesertaCont::class,'minta_modul']);

    // API FE & BE
    Route::get('/tampilan-api-cabang-tilawati',[ApicabangCont::class,'index_api_tilawati']);
    Route::post('/import-cabang-api-tilawati',[ImportController::class, 'importapicabangtilawati'])->name('import.cabangapi');
    Route::post('/update-api-cabang',[ApicabangCont::class,'update_api_cabang'])->name('update.apicabang');
    Route::get('/export-api-data-perwakilan-cabang',[ExportCont::class,'download_api_perwakilan_cabang']);
    
    Route::get('/tampilan-api-cabang-nurul-falah',[ApicabangCont::class,'index_api_nf']);
    Route::post('/import-cabang-api-nf',[ImportController::class,'importapicabangnf'])->name('import.cabangapinf');
    Route::post('/update-api-cabang-nf',[ApicabangCont::class,'update_api_cabang_nf'])->name('update.apicabangnf');
    Route::get('/export-api-data-cabang-nf',[ExportCont::class,'download_api_cabang_nf']);



    // E SYAHADAH ADMIN
    Route::get('/daftar-syahadah-elektronik',[SyahadahCont::class,'index_admin']);
    Route::get('/daftar-syahadah-cabang/{cabang_id}',[SyahadahCont::class,'data_syahadah_cabang']);
    Route::post('/terbitkan-syahadah',[SyahadahCont::class,'terbitkan_syahadah']);
    Route::post('/tarik-syahadah',[SyahadahCont::class,'tarik_syahadah']);
    Route::get('/data-syahadah-pusat',[SyahadahCont::class,'syahadah_pusat']);
    Route::get('/data-syahadah-cabang/{cabang_id}',[SyahadahCont::class,'syahadah_cabang']);
    Route::get('/total-syahadah-terbit-pusat',[SyahadahCont::class,'syahadah_terbit_pusat']);
    Route::get('/total-syahadah-terbit-cabang/{cabang_id}',[SyahadahCont::class,'syahadah_terbit_cabang']);
    Route::get('/daftar-syahadah-elektronik-peserta/{pelatihan_id}',[SyahadahCont::class,'index_peserta']);
    
    // CETAK SYAHADAH BARU
    Route::get('/cetak-syahadah-depan-b5/{pelatihan_id}',[CetakCont::class,'cetak_syahadah_depan_b5']);
    Route::get('/cetak-syahadah-belakang-b5/{pelatihan_id}',[CetakCont::class,'cetak_syahadah_belakang_b5']);
    Route::get('/cetak-syahadah-depan-belakang-b5/{pelatihan_id}',[CetakCont::class,'cetak_syahadah_depan_belakang_b5']);

    Route::post('/upload-ttd-kepala-cabang',[CabangCont::class,'upload_ttd']);
    Route::post('/upload-ttd-ulang-kepala-cabang',[CabangCont::class,'upload_ttd_ulang']);
    Route::get('/daftar-ttd-cabang', [TTDController::class,'data_ttd']);
    Route::get('/total-ttd-cabang', [TTDController::class,'total_ttd']);
    Route::get('/download-ttd-cabang/{cabang_id}',[TTDController::class,'download_ttd']);
    Route::post('/remove-ttd-cabang',[TTDController::class,'remove_ttd']);
    Route::post('/audit-ttd-cabang',[TTDController::class,'audit_ttd']);
    Route::get('/uji-ttd/{cabang_id}',[TTDController::class,'uji_ttd']);

    //Pengurus Cabang
    Route::post('/post-pengurus-cabang',[CabangCont::class,'pengurus_cabang_post']);

    //Daftar Peserta Tiap Cabang
    Route::get('/daftar-peserta-cabang-keseluruhan',[CabangCont::class,'daftar_peserta_cabang_keseluruhan'])->name('my.peserta');
    Route::get('/status-peserta-cabang',[CabangCont::class,'status_peserta_cabang']);

    //GET DATA WILAYAH
    Route::get('/get-wilayah-cabang/{cabang_id}',[CabangCont::class,'get_wilayah_cabang']);
    Route::post('/upload-dokumen-syirkah',[CabangCont::class,'upload_dokumen_syirkah']);
    Route::post('/remove-dokumen-syirkah',[CabangCont::class,'remove_dokumen_syirkah']);
});

Route::group(['middleware' => ['auth', 'CheckRole:bendahara']], function () {
    
});

Route::post('/broadcast',[BroadcastController::class, 'broadcast_pelatihan'])->name('broadcast');
Route::get('/blass-broadcasr',[BroadcastController::class,'blass_broadcast'])->name('blass.broadcast');

Route::post('/error-penilaian-kategori',[ErrorCont::class,'post_error']);
Route::get('/fixing-problem',[ErrorCont::class,'fixing'])->name('fixing');
// Route::get('send-mail', function () {
   
//     $details = [
//         'title' => 'Mail from tilawatipusat.com',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     Mail::to('febrirtah@gmail.com')->send(new MyTestMail($details));
   
//     dd("Email is Sent broo.");
// });