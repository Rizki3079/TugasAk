<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'login')->name('login');
    Route::post('/login-process', 'actionlogin')->name('actionlogin');
    Route::get('/logout', 'actionlogout')->name('logout');

});

// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/template', function () {
    return view('welcome');
});

//auth
Route::get('/', function () {
    return view('landingpage');
});

//auth
// Route::get('/login', function () {
//     return view('admin.auth.login2');
// });
// Route::get('/registrasi', function () {
//     return view('admin.auth.registrasi');
// });

//dashboard admin
Route::middleware('auth:admin,superAdmin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('pelanggan/datatable', [CustomerController::class, 'datatable'])->name('pelanggan.datatable');
    Route::get('/pelanggan', [CustomerController::class, 'index'])->name('pelanggan.index');
    Route::post('/pelanggan/{id}', [CustomerController::class, 'edit'])->name('pelanggan.edit');
    Route::delete('/pelanggan/{id}', [CustomerController::class, 'destroy'])->name('pelanggan.destroy');
    // Route::resource('pelanggan', CustomerController::class);
});



// //akun
// Route::get('/akun', function () {
//     return view('admin.akun.index');
// });

//data pembeli
Route::get('/dataPembeli', function () {
    return view('admin.dataTiket.dataPembeli.index');
});
Route::get('/tiket', function () {
    return view('admin.dataTiket.tiket.index');
});
Route::get('/laporanTiketMasuk', function () {
    return view('admin.dataTiket.laporanTiketMasuk.index');
});

//data kunjungan
Route::get('/dataKunjungan', function () {
    return view('admin.dataKunjungan.index');
});
