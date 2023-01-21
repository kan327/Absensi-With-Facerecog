<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceDatamasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Reset_profile;
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
    // Route::get("/data_kelas/tambah_murid/{id}", "tambah_murid")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "absen_siswa")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_masuk",  "cam_masuk")->middleware("isLoginGuru");
    Route::get("/dokumentasi", "dokumentasi");
    
    // View Component
    Route::get("/absensi/table_jadwal",  "table_jadwal")->middleware("isLoginGuru");// sidebar
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/box_ket", "box_absen_keterangan")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/table_absen", "table_absen")->middleware("isLoginGuru");
    
    // insert
    Route::post("/profile",  "insert_profile")->middleware("isLoginGuru");
    Route::post("/absensi/tambah_jadwal", "insert_jadwal")->middleware("isLoginGuru");
    // Route::post("/data_siswa/tambah_murid",  "insert_murid")->middleware("isLoginGuru");
    
    // edit
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}",  "manual_absen_masuk")->middleware("isLoginGuru");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/manual_pulang", "manual_absen_pulang")->middleware("isLoginGuru");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/tutup_absen", "tutup_absen")->middleware("isLoginGuru");
    
    // delete
    Route::get("/absensi/hapus/{id}/{tanggal}/{kelas}/{mapel}",  "hapus_jadwal")->middleware("isLoginGuru");
    Route::get('/profile/hapus/{id}/reset_profile', 'reset_profile')->middleware("isLoginGuru");

    // search
    Route::get("/absensi/{tahun}/{bulan}", "filter_date");
    Route::get("/absensi/{tahun}/{bulan}/{tanggal}", "filter_tanggal");
    
    // MaatWebsite
    Route::get("/absensi/excel/{tanggal}/{kelas}/{mapel}", "excel")->middleware("isLoginGuru");

    // Camera
    // Route::get("/data_siswa/tambah_murid/cam_daftar/{id}", "cam_daftar")->middleware("isLoginGuru");
    // Route::post("/data_siswa/tambah_murid/simpan", "simpan_gambar")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_masuk", "cam_masuk")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_pulang", "cam_pulang")->middleware("isLoginGuru");

    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_absen_masuk/{data_siswa}", "update_cam_masuk")->middleware("isLoginGuru");
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/cam_absen_pulang/{data_siswa}", "update_cam_pulang")->middleware("isLoginGuru");
    
    // Bot Pino Telegram
    Route::get("/absen_siswa/{tanggal}/{kelas}/{mapel}/kirim_telegram", "view_kirim_telegram")->middleware("isLoginGuru");
    Route::post("/absen_siswa/{tanggal}/{kelas}/{mapel}/kirim_telegram", "kirim_telegram")->middleware("isLoginGuru");

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

    Route::get("/admin/murid/{id}/{previous_page}/{type?}", "update_siswa")->middleware("isLoginGuru");

    Route::get("/admin/data_kelas", "data_kelas")->middleware("isLoginGuru");
    Route::get("/admin/data_kelas/{id}", "data_siswa")->middleware("isLoginGuru");
    Route::get("/admin/data_kelas/tambah_murid/{id}", "tambah_murid")->middleware("isLoginGuru");
    Route::get("/dokumentasi/admin", "dokumentasi");

    // cam 
    Route::get("/admin/data_kelas/tambah_murid/cam_daftar/{id}", "cam_daftar")->middleware("isLoginGuru");

    // search
    Route::get("/admin/pino_bot/search", "search_grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/search/", "search_guru")->middleware("isLoginGuru");
    Route::get("/admin/siswa/search", "search_siswa")->middleware("isLoginGuru");
    Route::get("/admin/table_jadwal", "table_jadwal")->middleware("isLoginGuru");
    Route::get("/admin/table_jadwal/{tahun}/{bulan}", "filter_date")->middleware("isLoginGuru");
    Route::get("/admin/table_jadwal/{tahun}/{bulan}/{tanggal}", "filter_tanggal")->middleware("isLoginGuru");
    
    // View Component 
    Route::get("/admin/box",  "box")->middleware("isLoginGuru");
    Route::get("/admin/table_mapel",  "table_mapel")->middleware("isLoginGuru");
    Route::get("/admin/table_kelas",  "table_kelas")->middleware("isLoginGuru");
    
    // insert
    Route::post("/admin/mapel",  "insert_mapel");
    Route::post("/admin/grup_kelas",  "insert_grup_kelas");
    Route::post("/admin/tambah_guru",  "tambah_guru");
    Route::post("/admin/data_kelas/tambah_murid", "insert_murid")->middleware("isLoginGuru");
    Route::post("/admin/data_siswa/tambah_murid/simpan", "simpan_gambar")->middleware("isLoginGuru");
    
    // edit
    Route::post("/admin/guru/{id}", "edit_guru");
    Route::post("/admin/mapel_update/{id}",  "edit_mapel");
    Route::post("/admin/grup_kelas/{id}",  "edit_grup_kelas");
    Route::post("/admin/murid/{id}", "edit_siswa")->middleware("isLoginGuru");

    // delete
    Route::get("/admin/mapel/{id}", "delete_mapel")->middleware("isLoginGuru");
    Route::get("/admin/kelas/{id}", "delete_kelas")->middleware("isLoginGuru");
    Route::get("/admin/hapus_guru/{id}", "delete_guru")->middleware("isLoginGuru");
    Route::get("/admin/hapus_grup_kelas/{id}", "delete_grup_kelas")->middleware("isLoginGuru");
    Route::get("/admin/hapus_siswa/{id}/{type?}", "delete_siswa")->middleware("isLoginGuru");
});

// Login
Route::controller(LoginController::class)->group(function(){

    Route::get('/login', "index")->middleware("isGuru");
    Route::get('/login_admin', "index_admin")->middleware("isGuru");
    Route::post('/login', "login");
    Route::post('/login_admin', "login_admin");
    Route::post('/logout', "logout");

});

Route::get("/link_storage", function(){
    $target = storage_path("app/public");
    $link = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($target,$link);
});