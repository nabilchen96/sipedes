<?php

use App\Http\Controllers\PenilaianProposalController;
use Illuminate\Support\Facades\Route;
// use Barryvdh\DomPDF\Facade as PDF; // Import namespace penuh
use Barryvdh\DomPDF\Facade\Pdf;

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

//LOGIN
Route::get('/', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

//REGISTER
Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/registerOtp', 'App\Http\Controllers\AuthController@registerOtp');
Route::post('/registerOtpCek', 'App\Http\Controllers\AuthController@registerOtpCek');
Route::get('/register2', 'App\Http\Controllers\AuthController@register2');
Route::post('/registerProses', 'App\Http\Controllers\AuthController@registerProses');

//PENCARIAN DAERAH
Route::get('/search-wilayah', 'App\Http\Controllers\WilayahController@searchWilayah');

//RESET PASSWORD
Route::get('/reset-password', function () {
    return view('frontend.auth.reset_password');
});
Route::post('/resetOtp', 'App\Http\Controllers\AuthController@resetOtp');
Route::post('/reset-password-proses', 'App\Http\Controllers\AuthController@resetPasswordProses');

//BACKEND
Route::group(['middleware' => 'auth'], function () {

    //DASHBOARD
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::get('data-peta', 'App\Http\Controllers\DashboardController@dataPeta');

    //USER
    Route::get('/user', 'App\Http\Controllers\UserController@index');
    Route::get('/data-user', 'App\Http\Controllers\UserController@data');
    Route::post('/store-user', 'App\Http\Controllers\UserController@store');
    Route::post('/update-user', 'App\Http\Controllers\UserController@update');
    Route::post('/delete-user', 'App\Http\Controllers\UserController@delete');
    Route::get('/export-excel-user', 'App\Http\Controllers\UserController@exportExcel');
    Route::post('/import-excel-user', 'App\Http\Controllers\UserController@importExcel');

    //WILAYAH
    Route::get('/wilayah', 'App\Http\Controllers\WilayahController@index');
    Route::get('/data-wilayah', 'App\Http\Controllers\WilayahController@data');
    Route::post('/store-wilayah', 'App\Http\Controllers\WilayahController@store');
    Route::post('/update-wilayah', 'App\Http\Controllers\WilayahController@update');
    Route::post('/delete-wilayah', 'App\Http\Controllers\WilayahController@delete');

    //JABATAN
    Route::get('/jabatan', 'App\Http\Controllers\JabatanController@index');
    Route::get('/data-jabatan', 'App\Http\Controllers\JabatanController@data');
    Route::post('/store-jabatan', 'App\Http\Controllers\JabatanController@store');
    Route::post('/update-jabatan', 'App\Http\Controllers\JabatanController@update');
    Route::post('/delete-jabatan', 'App\Http\Controllers\JabatanController@delete');

    //BANK
    Route::get('/bank', 'App\Http\Controllers\BankController@index');
    Route::get('/data-bank', 'App\Http\Controllers\BankController@data');
    Route::post('/store-bank', 'App\Http\Controllers\BankController@store');
    Route::post('/update-bank', 'App\Http\Controllers\BankController@update');
    Route::post('/delete-bank', 'App\Http\Controllers\BankController@delete');

    //PROFIL
    Route::get('/profil', 'App\Http\Controllers\ProfilController@index');
    Route::get('/data-profil', 'App\Http\Controllers\ProfilController@data');
    Route::get('/detail-profil/{id}', 'App\Http\Controllers\ProfilController@detail');
    Route::post('/update-profil', 'App\Http\Controllers\ProfilController@update');

    //PEGAWAI
    Route::get('/detail-pegawai/{id}', 'App\Http\Controllers\PegawaiController@detail');
    Route::post('/update-pegawai', 'App\Http\Controllers\PegawaiController@update');

    //KELUARGA
    Route::get('/detail-keluarga/{id}', 'App\Http\Controllers\KeluargaController@detail');
    Route::get('/data-keluarga/{id}', 'App\Http\Controllers\KeluargaController@data');
    Route::post('/store-keluarga', 'App\Http\Controllers\KeluargaController@store');
    Route::post('/update-keluarga', 'App\Http\Controllers\KeluargaController@update');
    Route::post('/delete-keluarga', 'App\Http\Controllers\KeluargaController@delete');
});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
