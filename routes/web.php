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
});

Route::post('/register',[RegisteredUserController::class, 'store']) ->name('register');

Route::middleware(['auth', 'access'])->group(function () {
    Route::get('/dashboard', function () {
        $features = session('features');
        $menu = array();
        if (isSubStringInArray('pengguna', $features)) {
            $menu[] = "<a href=\"" . route('master.pengguna') . " }}\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Pengguna</span>
                        </a>";
        }
        if (isSubStringInArray('program-inkubasi', $features)) {
            $menu[] = "<a href=\"" . route('master.pengguna') . " }}\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Program Inkubasi</span>
                        </a>";
        }
        if (isSubStringInArray('kategori-startup', $features)) {
            $menu[] = "<a href=\"" . route('master.pengguna') . " }}\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Kategori Startup</span>
                        </a>";
        }
        return view('dashboard')->with('menus', $menu);
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
    });

    Route::get('/master/pengguna', [MasterPenggunaController::class, 'index'])->name('master.pengguna');
});


require __DIR__.'/auth.php';
