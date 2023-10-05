<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterCivitasController;
use App\Http\Controllers\MasterPenggunaController;
use App\Http\Controllers\MasterPeriodeController;
use App\Http\Controllers\MasterProgramInkubasiController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\UserProfileController;
use App\Models\MasterCategory;
use App\Http\Controllers\MasterUniversitasController;
use App\Http\Controllers\PenilaianDeskController;
use App\Http\Controllers\MasterFakultasController;
use App\Http\Controllers\MasterProgramStudyController;
use App\Http\Controllers\MasterKomponenPenilaianController;
use App\Http\Controllers\StartupController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MasterCivitasController;
use App\Http\Controllers\MasterPeriodeController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterFakultasController;
use App\Http\Controllers\MasterPenggunaController;
use App\Http\Controllers\PenilaiProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MasterProgramInkubasiController;
use Carbon\Carbon;

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
    // return view('welcome');
    return redirect('/dashboard');
});

Route::get('/admin', function() {
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('admin');

// Route::get('/dashboard', function () {
//     View::share('features', ['example', 'test']);
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::post('/changepassword', function () {
//     return view('changepassword');
// })->middleware(['auth'])->name('change-password');

// Route::get('/masteruser', function () {
//     return view('masterpengguna.masteruser');
// })->name('masteruser');

Route::post('/register',[RegisteredUserController::class, 'store']) ->name('register');

Route::middleware(['auth', 'access'])->group(function () {

    // Route::get('/dashboard', function () {
    // })->name('dashboard');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/change-password', function () {
        return view('changepassword');
    })->name('change-password');
    
    Route::get('/access', [AccessController::class, 'index'])->name('access.index');
    Route::post('/access', [AccessController::class, 'submit'])->name('access.submit');
    Route::get('/access/reset', [AccessController::class, 'reset'])->name('access.reset');
    Route::get('/access/reset/{role}', [AccessController::class, 'role_reset'])->name('access.role-reset');
    Route::post('/access/role', [AccessController::class, 'role_index'])->name('access.role');

    Route::get('/master/pengguna', [MasterPenggunaController::class, 'index'])->name('master.pengguna');
    Route::get('/notify', [DashboardController::class, 'index'])->name('notify');
    

    Route::get('/master/inkubasi', function() {
        return view('Master-ProgramInkubasi.listProgramInkubasi');
    })->name('incubationProgram');

    Route::get('/detail/profile/{user:name}', [UserProfileController::class, 'index'])->name('detail-profile');
    Route::get('/edit/profile/{user:name}', [UserProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/edit/profile/{user:name}', [UserProfileController::class, 'update'])->name('update-profile');

    Route::get('/master/startup', function() {
        return view('Master-KategoriStartup.listKategoriStartup');
    })->name('startupcategory');

    Route::get('/master/civitas', function() {
        return view('Master-Civitas.listCivitas');
    })->name('civitas');

    Route::get('/master/pengguna/add', [MasterPenggunaController::class, 'create'])->name('master.pengguna.add');
    Route::post('/master/pengguna/add', [MasterPenggunaController::class, 'store'])->name('master.pengguna.store');
    Route::get('/master/pengguna/{user:name}', [MasterPenggunaController::class, 'show'])->name('master.pengguna.detail');
    Route::get('/master/pengguna/{user:name}/edit', [MasterPenggunaController::class, 'edit'])->name('master.pengguna.edit');
    Route::put('/master/pengguna/{user:name}/edit', [MasterPenggunaController::class, 'update'])->name('master.pengguna.update');
    Route::get('/master/pengguna/{user:name}/delete', [MasterPenggunaController::class, 'destroy'])->name('master.pengguna.delete');

    Route::resource('/master/civitas', MasterCivitasController::class)->names([
        'index' => 'master.civitas',
    ])->except(['show', 'edit', 'create']);

    Route::resource('/master/periode', MasterPeriodeController::class)->names([
        'index' => 'master.periode',
    ])->except(['show', 'edit', 'create']);

    // Route::get('/master/penilaian', function() {
    //     return view('Master-KomponenPenilaian.listKomponenPenilaian');
    // })->name('penilaian');

    Route::get('/master/penilaian/editComponent', function() {
        return view('Master-KomponenPenilaian.kelolaKomponenEdit');
    })->name('editComponent');

    Route::get('/master/penilaian/viewComponent', function() {
        return view('Master-KomponenPenilaian.kelolaKomponenView');
    })->name('viewComponent');

    Route::get('/master/pendaftar', function() {
        return view('Pendaftaran-DataPendaftar.dataPendaftar');
    })->name('pendaftar');

    Route::get('/master/pendaftar/datastartup', function() {
        return view('Pendaftaran-DataPendaftar.dataStartup');
    })->name('dataStartup');

    Route::get('/master/penilaianDE/edit/{id}', [PenilaianDeskController::class, 'edit'])->name('penilaianDE.edit');
    Route::get('/master/penilaianDE/detail/{id}', [PenilaianDeskController::class, 'show'])->name('penilaianDE.show');
    Route::post('/master/penilaianDE/update/{id}', [PenilaianDeskController::class, 'update'])->name('penilaianDE.update');
    Route::get('/master/penilaianDE/{file}', [PenilaianDeskController::class, 'download'])->name('download');
    Route::get('/master/penilaianDE/', [PenilaianDeskController::class, 'filterStatus'])->name('penilaianStatus');
    Route::get('/master/penilaianDE/', [PenilaianDeskController::class, 'filterPeriode'])->name('penilaianPeriode');
    Route::resource('/master/penilaianDE', PenilaianDeskController::class)->only(['index', 'filterStatus', 'filterPeriode'])->names([
        'index' => 'penilaianDE',
    ]);
    
    // Route::get('/master/penilaianDE', function() {
    //     return view('Pendaftaran-PenilaianDE.penilaianDE');
    // })->name('penilaianDE');

    // Route::get('/master/penilaianDE/viewnilai', function() {
    //     return view('Pendaftaran-PenilaianDE.nilaiView');
    // })->name('viewnilai');

    // Route::get('/master/penilaianDE/editnilai', function() {
    //     return view('Pendaftaran-PenilaianDE.nilaiEdit');
    // })->name('editnilai');

    // Route::get('/master/inkubasi', function() {
    //     $master_programinkubasi = DB::table('master_programinkubasi')->get();
    //     return view('Master-ProgramInkubasi.listProgramInkubasi',['master_programinkubasi'=>$master_programinkubasi]);
    // })->name('incubationProgram');

    Route::resource('/master/inkubasi', MasterProgramInkubasiController::class)->names([
        'index' => 'master.inkubasi',
    ])->except(['show', 'edit', 'create']);

    Route::resource('/master/kategori/startup', MasterCategoryController::class)->names([
        'index' => 'master.kategori.startup',
    ])->except(['show', 'edit', 'create']);

    // Route::get('/daftar', function() {
    //     return view('Startup.daftarStartup');
    // })->name('daftar');

    // Route::get('/master/universitas', function() {
    //     return view('Master-Universitas.listUniversitas');
    // })->name('universitas');

    Route::resource('/master/universitas', MasterUniversitasController::class)->names([
        'index' => 'master.universitas',
    ])->except(['show', 'edit', 'create']);

    Route::resource('fakultas', MasterFakultasController::class)->only(['index', 'store', 'update', 'destroy'])->names([
        'index' => 'faculty.index',
        'store' => 'faculty.store',
        'update' => 'faculty.update',
        'destroy' => 'faculty.destroy',
    ]);

    Route::resource('startup', \App\Http\Controllers\StartupController::class)->only(['index', 'store'])->names([
        'index' => 'startup.index',
        'store' => 'startup.store',
    ]);
    Route::post('/startup/set/', [StartupController::class, 'setInkubasi'])->name('startup.setInkubasi');

    Route::resource('/master/prodi', MasterProgramStudyController::class)->names([
        'index' => 'master.prodi',
    ])->except(['show', 'edit', 'create', 'getFaculties']);

    Route::get('/master/prodi/{university}', [MasterProgramStudyController::class, 'getFaculties']);
    Route::get('/master/prodi/getProdi/{prodi}', [MasterProgramStudyController::class, 'getProdi']);

    Route::get('/master/penilaian', [MasterKomponenPenilaianController::class, 'index'])->name('penilaian');
    Route::get('/master/penilaian/{id}', [MasterKomponenPenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/master/penilaian/{id}', [MasterKomponenPenilaianController::class, 'storeQuest'])->name('quest.store');
    Route::post('/master/penilaian/copy/{id}', [MasterKomponenPenilaianController::class, 'copyQuest'])->name('quest.copy');
    Route::get('/master/penilaian/detail/{id}', [MasterKomponenPenilaianController::class, 'show'])->name('penilaian.show');
    Route::get('/master/penilaian/delete/{id}', [MasterKomponenPenilaianController::class, 'destroy'])->name('penilaian.destroy');
    Route::resource('/master/penilaian', MasterKomponenPenilaianController::class)->only(['index', 'store', 'update'])->names([
        'index' => 'master.penilaian',
        'store' => 'penilaian.store',
        'update' => 'penilaian.update'
    ]);

    Route::get('/penilai/profil', [PenilaiProfileController::class, 'edit'])->name('penilai.profil.edit');
    Route::put('/penilai/profil', [PenilaiProfileController::class, 'update'])->name('penilai.profil.update');
});


/* This is for getting user's photo profile */
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    return response()->file($filePath);
})->where('path', '.*');

/* Add middleware role use middleware('role:x') example middleware('role:admin') or middleware('role:admin,peserta') with no spaces */

// Route::get('/masteruser', [App\Http\Controllers\MasterUser\MasterUserController::class, 'index'])->middleware('role:admin')->name('masteruser');

require __DIR__.'/auth.php';
