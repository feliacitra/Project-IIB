<?php

use Illuminate\Support\Facades\Route;

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
})->name('admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/changepassword', function () {
    return view('changepassword');
});

Route::get('/masteruser', function () {
    return view('masterpengguna.masteruser');
})->name('masteruser');

Route::get('/adduser', function () {
    return view('masterpengguna.adduser');
})->name('adduser');

/* This is for detailuser, please modify based on the right source*/
Route::get('/detailuser', function () {
    return view('masterpengguna.detailuser');
})->name('detailuser');

/* This is for edituser, please modify based on the right source*/
Route::get('/edituser', function () {
    return view('masterpengguna.edituser');
})->name('edituser');

/* Add middleware role use middleware('role:x') example middleware('role:admin') or middleware('role:admin,peserta') with no spaces */

Route::post('/register',[App\Http\Controllers\Auth\RegisteredUserController::class, 'store']) ->name('register');

Route::post('/adduser', [App\Http\Controllers\MasterUser\AddUserController::class, 'store']) ->name('adduser');

Route::get('/masteruser', [App\Http\Controllers\MasterUser\MasterUserController::class, 'index'])->middleware('role:admin')->name('masteruser');

Route::get('/detailuser/{user:name}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'show']) ->middleware('role:admin')->name('detailuser');

Route::get('/edituser/{user:name}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'edit']) ->middleware('role:admin')->name('edituser');

Route::get('/masteruser/{user:name}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'destroy']) ->name('deleteuser');

Route::put('/edituser/{user:name}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'update']) ->middleware('role:admin')->name('updateuser');

require __DIR__.'/auth.php';
