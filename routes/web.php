<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

// Home
Route::get("/", [GuruController::class , "index"]);
Route::get("/profile", [GuruController::class , "profile"]);
Route::get("/absensi", [GuruController::class , "absensi"]);
Route::get("/data_kelas", [GuruController::class , "data_kelas"]);
Route::post("/mapel", [GuruController::class , "insert_mapel"]);

// Route::get("/admin", [AdminController::class , "index_admin"]);
Route::get("/admin", [AdminController::class , "index_admin"])->name('admin')->middleware("isLoginGuru");

Route::controller(DashboardController::class)->group(function(){
});

// Login
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', "index")->middleware("isGuru");
    Route::get('/login_admin', "index_admin")->middleware("isGuru");
    Route::post('/login', "login");
    Route::post('/login_admin', "login_admin");
    Route::post('/logout', "logout");
});


// // Guru 
// Route::get('/test', [DataPersonController::class, 'test']);
// Route::get('/absensi', [GuruController::class, 'index'])->middleware('isLoginGuru');
// Route::get("/absensi/siswa_masuk/{kelas}/{mapel}", [GuruController::class, "absen_siswa"]);
// Route::get("/absensi/siswa_masuk/cam_masuk", [GuruController::class, "cam_masuk"]);
// Route::get("/absensi/siswa_keluar/{kelas}/{mapel}", [GuruController::class, "absen_keluar_siswa"]);

// // Admin
// Route::controller(AdminController::class)->group(function(){
//     Route::get("/admin/read_mapel", "read_mapel");
//     Route::get("/admin/tambah_guru", "tambah_guru_view");
//     Route::post("/admin/tambah_guru", "tambah_guru");
//     Route::post("/admin/tambah_kelas", "tambah_kelas");
//     Route::post("/admin/tambah_mapel", "tambah_mapel");
// });

// // Tampilan data siswa dan form tambah siswa
// Route::controller(DataPersonController::class)->group(function(){
//     Route::get("/siswa", "index");
//     Route::get("/siswa/tambah", "form");
//     Route::post("/siswa/tambah", "tambah_siswa");
// });

// Route::controller(AttendanceDatamasterController::class)->group(function(){
//     Route::get("/absen_masuk", "absen_masuk");
//     Route::get("/absen_pulang", "absen_pulang");
//     Route::get("/cam_masuk", "absen_cam_masuk");
//     Route::get("/cam_pulang", "absen_cam_pulang");
// });