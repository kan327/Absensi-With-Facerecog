<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    return view('main_guru');
});

// Guru Route
Route::controller(GuruController::class)->group(function(){

    // views
    Route::get("/",  "index")->name('/')->middleware("isLoginGuru");
    Route::get("/profile",  "profile")->middleware("isLoginGuru"); //sidebar
    Route::get("/absensi",  "absensi")->middleware("isLoginGuru");// sidebar
    Route::get("/absensi/tambah_jadwal", "tambah_jadwal")->middleware("isLoginGuru");
    Route::get("/data_kelas",  "data_kelas")->middleware("isLoginGuru"); //sidebaar
    Route::get("/data_kelas/{id}",  "table_kelas")->middleware("isLoginGuru"); //sidebaar
    Route::get("/data_kelas/tambah_murid/{id}",  "tambah_murid")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "absen_siswa")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_masuk",  "cam_masuk")->middleware("isLoginGuru");
    
    // View Component
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/box_ket", "box_absen_keterangan")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/table_absen", "table_absen")->middleware("isLoginGuru");
    
    // insert
    Route::post("/profile",  "insert_profile");
    Route::post("/absensi/tambah_jadwal", "insert_jadwal");
    Route::post("/data_siswa/tambah_murid",  "insert_murid");
    
    // edit
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "manual_absen_masuk");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/manual_pulang", "manual_absen_pulang");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/tutup_absen", "tutup_absen");
    
    // delete
    Route::get("/absensi/hapus/{id}",  "hapus_jadwal")->middleware("isLoginGuru");
    
    // MaatWebsite
    Route::get("/absensi/excel/{tanggal}/{kelas}/{mapel}", "excel")->middleware("isLoginGuru");

    // Camera
    Route::get("/data_siswa/tambah_murid/cam_daftar", "cam_daftar")->middleware("isLoginGuru");
    Route::get("/absen_siswa/akses_cam_daftar", "akses_cam_daftar");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_masuk", "cam_masuk")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_pulang", "cam_pulang")->middleware("isLoginGuru");
    
    // simpan dataset
    Route::get("/data_siswa/tambah_murid/simpan_dataset", "simpan_dataset")->middleware("isLoginGuru");
    
});

// Admin Route
Route::controller(AdminController::class)->group(function(){

    // View
    Route::get("/admin",  "index_admin")->name('admin')->middleware("isLoginGuru");
    Route::get("/admin/guru",  "guru")->middleware("isLoginGuru");
    Route::get("/admin/guru/{id}", "update_guru")->middleware("isLoginGuru");
    Route::get("/admin/pino_bot/", "pino_bot")->middleware("isLoginGuru");
    Route::get("/admin/grup_kelas", "grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/grup_kelas/{id}", "update_grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/murid/{id}", "update_siswa")->middleware("isLoginGuru");
    
    // search
    Route::get("/admin/pino_bot/search", "search_grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/search/", "search_guru")->middleware("isLoginGuru");
    Route::get("/admin/siswa/search", "search_siswa")->middleware("isLoginGuru");
    
    // View Component 
    Route::get("/admin/box",  "box")->middleware("isLoginGuru");
    Route::get("/admin/table_mapel",  "table_mapel")->middleware("isLoginGuru");
    Route::get("/admin/table_kelas",  "table_kelas")->middleware("isLoginGuru");
    
    // insert
    Route::post("/admin/mapel",  "insert_mapel");
    Route::post("/admin/grup_kelas",  "insert_grup_kelas");
    Route::post("/admin/tambah_guru",  "tambah_guru");
    
    // edit
    Route::post("/admin/guru/{id}", "edit_guru");
    Route::post("/admin/grup_kelas/{id}",  "edit_grup_kelas");
    Route::post("/admin/murid/{id}", "edit_siswa")->middleware("isLoginGuru");

    // delete
    Route::get("/admin/mapel/{id}", "delete_mapel")->middleware("isLoginGuru");
    Route::get("/admin/kelas/{id}", "delete_kelas")->middleware("isLoginGuru");
    Route::get("/admin/hapus_guru/{id}", "delete_guru")->middleware("isLoginGuru");
    Route::get("/admin/hapus_grup_kelas/{id}", "delete_grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/hapus_siswa/{id}", "delete_siswa")->middleware("isLoginGuru");

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