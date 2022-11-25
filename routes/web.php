<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

// Guru Route
Route::controller(GuruController::class)->group(function(){

    Route::get("/",  "index")->name('/')->middleware("isLoginGuru");
    Route::get("/profile",  "profile");
    Route::post("/profile",  "insert_profile");
    Route::get("/absensi",  "absensi");
    Route::get("/absensi/hapus/{id}",  "hapus_jadwal");
    Route::get("/absensi/tambah_jadwal", "tambah_jadwal");
    Route::post("/absensi/tambah_jadwal", "insert_jadwal");
    // Route::get("/data_kelas",  "data_kelas");
    Route::get("/data_siswa/{id}",  "data_siswa");
    Route::get("/data_siswa/tambah_murid",  "tambah_murid");
    Route::post("/data_siswa/tambah_murid",  "insert_murid");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "absen_siswa");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "manual_absen_masuk");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_masuk",  "cam_masuk");
    // Route::post("/manual_absen",  "manual_absen_masuk");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/box_ket", "box_absen_keterangan");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/table_absen", "table_absen");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/manual_pulang", "manual_absen_pulang");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/tutup_absen", "tutup_absen");
    
});

// Admin Route
Route::controller(AdminController::class)->group(function(){

    Route::get("/admin",  "index_admin")->name('admin')->middleware("isLoginGuru");
    Route::get("/admin/box",  "box");
    Route::get("/admin/table_mapel",  "table_mapel");
    Route::post("/admin/mapel",  "insert_mapel");
    Route::get("/admin/table_kelas",  "table_kelas");
    Route::post("/admin/kelas",  "insert_kelas");
    Route::get("/admin/guru",  "guru");
    Route::post("/admin/tambah_guru",  "tambah_guru");
    
    // delete
    Route::get("/admin/mapel/{id}", "delete_mapel");
    Route::get("/admin/kelas/{id}", "delete_kelas");
    Route::get("/admin/guru/{id}", "update_guru");
    Route::post("/admin/guru/{id}", "edit_guru");

});

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