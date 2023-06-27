<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AccessController;
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

Route::get('/dashboard', function () {
    View::share('features', ['example', 'test']);
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/changepassword', function () {
    return view('changepassword');
})->middleware(['auth'])->name('change-password');


Route::get('/access', [AccessController::class, 'index'])->middleware(['auth', 'admin'])->name('access.index');
Route::post('/access', [AccessController::class, 'submit'])->middleware(['auth', 'admin'])->name('access.submit');
Route::get('/access/reset', [AccessController::class, 'reset'])->middleware(['auth', 'admin'])->name('access.reset');

Route::get('/masteruser', function () {
    return view('masterpengguna.masteruser');
});

Route::get('/adduser', function () {
    return view('masterpengguna.adduser');
});

Route::post('/register',[RegisteredUserController::class, 'store']) ->name('register');


require __DIR__.'/auth.php';
