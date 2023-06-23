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

Route::post('/register',[App\Http\Controllers\Auth\RegisteredUserController::class, 'store']) ->name('register');


require __DIR__.'/auth.php';
