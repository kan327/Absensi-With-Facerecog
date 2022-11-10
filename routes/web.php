<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuruController;
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

// Login
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', "index")->middleware("isGuru");
    Route::get('/login_admin', "index_admin")->middleware("isGuru");
    Route::post('/login', "login");
    Route::post('/login_admin', "login_admin");
    Route::post('/logout', "logout");
});

// Home
Route::controller(DashboardController::class)->group(function(){
    Route::get("/" , "index")->middleware("isLoginGuru");
    Route::get("/admin", "index_admin")->name('admin')->middleware("isLoginGuru");
});

// Guru 
Route::get('/absensi', [GuruController::class, 'index'])->middleware('isLoginGuru');

// Admin
Route::controller(AdminController::class)->group(function(){
    Route::get("/admin/tambah_guru", "tambah_guru_view");
    Route::post("/admin/tambah_guru", "tambah_guru");
    Route::post("/admin/tambah_kelas", "tambah_kelas");
    Route::post("/admin/tambah_mapel", "tambah_mapel");
});

// Tampilan data siswa dan form tambah siswa
Route::controller(DataPersonController::class)->group(function(){
    Route::get("/siswa", "index");
    Route::get("/siswa/tambah", "form");
});

Route::controller(AttendanceDatamasterController::class)->group(function(){
    Route::get("/absen_masuk", "absen_masuk");
    Route::get("/absen_pulang", "absen_pulang");
    Route::get("/cam_masuk", "absen_cam_masuk");
    Route::get("/cam_pulang", "absen_cam_pulang");
});