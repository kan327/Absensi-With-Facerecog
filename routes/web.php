<?php

use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/', [DashboardController::class, 'index'])->middleware("auth:user");

// Login
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', "index")->name('login')->middleware('guest:user');
    Route::get('/login_admin', "index_admin")->name("login_admin")->middleware("guest:user");
    Route::post('/login', "login");
    Route::post('/login_admin', "login_admin");
    Route::post('/logout', "logout");
});

// Add Guru
Route::get('/absensi', [RegisterController::class, 'index'])->middleware("auth:user");

// Tampilan data siswa dan form tambah siswa
Route::controller(DataPersonController::class)->group(function(){
    Route::get("/siswa", "index");
    Route::get("/siswa_form", "form");
});

Route::controller(AttendanceDatamasterController::class)->group(function(){
    Route::get("/absen_masuk", "absen_masuk");
    Route::get("/absen_pulang", "absen_pulang");
    Route::get("/cam_masuk", "absen_cam_masuk");
    Route::get("/cam_pulang", "absen_cam_pulang");
});