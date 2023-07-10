<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\MasterCivitasController;
use App\Http\Controllers\MasterPenggunaController;
use App\Http\Controllers\MasterProgramInkubasiController;
use App\Http\Controllers\MasterCategoryController;
use App\Models\MasterCategory;
use Illuminate\Support\Facades\View;

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

// Route::get('/changepassword', function () {
//     return view('changepassword');
// })->middleware(['auth'])->name('change-password');

Route::get('/masteruser', function () {
    return view('masterpengguna.masteruser');
})->name('masteruser');

Route::post('/register',[RegisteredUserController::class, 'store']) ->name('register');

Route::middleware(['auth', 'access'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/changepassword', function () {
        return view('changepassword');
    })->name('change-password');
    
    Route::get('/access', [AccessController::class, 'index'])->name('access.index');
    Route::post('/access', [AccessController::class, 'submit'])->name('access.submit');
    Route::get('/access/reset', [AccessController::class, 'reset'])->name('access.reset');
    Route::get('/access/reset/{role}', [AccessController::class, 'role_reset'])->name('access.role-reset');

    Route::get('/master/pengguna', [MasterPenggunaController::class, 'index'])->name('master.pengguna');
    Route::get('/master/pengguna/add', [MasterPenggunaController::class, 'create'])->name('master.pengguna.add');
    Route::post('/master/pengguna/add', [MasterPenggunaController::class, 'store'])->name('master.pengguna.store');
    Route::get('/master/pengguna/{user:name}', [MasterPenggunaController::class, 'show'])->name('master.pengguna.detail');
    Route::get('/master/pengguna/{user:name}/edit', [MasterPenggunaController::class, 'edit'])->name('master.pengguna.edit');
    Route::put('/master/pengguna/{user:name}/edit', [MasterPenggunaController::class, 'update'])->name('master.pengguna.update');
    Route::get('/master/pengguna/{user:name}/delete', [MasterPenggunaController::class, 'destroy'])->name('master.pengguna.delete');

    Route::resource('/master/civitas', MasterCivitasController::class)->names([
        'index' => 'master.civitas',
    ])->except(['show', 'edit', 'create']);

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

    // Route::get('/master/civitas', function() {
    //     return view('Master-Civitas.listCivitas');
    // })->name('civitas');
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
