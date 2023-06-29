<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\MasterPenggunaController;
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

    Route::get('/master/pengguna/add', function () {
        return view('masterpengguna.adduser');
    })->name('master.pengguna.add');

    Route::get('/master/pengguna/{id}', function($id) {
        return view('masterpengguna.detailuser');
    })->name('master.pengguna.detail');

    Route::get('/master/pengguna', [MasterPenggunaController::class, 'index'])->name('master.pengguna');
    
    Route::post('/adduser', [App\Http\Controllers\MasterUser\AddUserController::class, 'store']) ->name('adduser');
    Route::get('/masteruser', [App\Http\Controllers\MasterUser\MasterUserController::class, 'index']) ->name('masteruser');
    Route::get('/detailuser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'show']) ->name('detailuser');
    Route::get('/edituser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'edit']) ->name('edituser');
    Route::get('/masteruser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'destroy'])->name('deleteuser');
});

/* This is for edituser, please modify based on the right source*/
Route::get('/edituser', function () {
    return view('masterpengguna.edituser');
})->name('edituser');


require __DIR__.'/auth.php';
