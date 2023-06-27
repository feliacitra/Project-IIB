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

Route::post('/register',[App\Http\Controllers\Auth\RegisteredUserController::class, 'store']) ->name('register');
Route::post('/adduser', [App\Http\Controllers\MasterUser\AddUserController::class, 'store']) ->name('adduser');
Route::get('/masteruser', [App\Http\Controllers\MasterUser\MasterUserController::class, 'index']) ->name('masteruser');
Route::get('/detailuser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'show']) ->name('detailuser');
Route::get('/edituser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'edit']) ->name('edituser');
Route::get('/masteruser/{user}', [\App\Http\Controllers\MasterUser\MasterUserController::class, 'destroy'])->name('deleteuser');

require __DIR__.'/auth.php';
