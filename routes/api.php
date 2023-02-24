<?php

use App\Http\Controllers\ApiAbsensiController;
use App\Http\Controllers\ApiAbsenSiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ApiAbsensiController::class)->group(function (){

    # Api Admin Pino Bot
    # List Admin
    Route::get("/list_admin", "list_admin");
    # Daftar Admin
    Route::post("/daftar_admin", "daftar_admin");

    # Api Pino Bot
    # List Kelas
    Route::get("/list_kelas", "list_kelas");
    # List Guru
    Route::get("/list_guru", "list_guru");
    # Check Absensi Where Status = Hadir
    Route::get("/AbsenSiswa/{kelas}/{mapel}/{tanggal}", "index");
    # Check Absensi Where Status = Tidak Hadir
    Route::get("/AbsenSiswa/{kelas}/{mapel}/{tanggal}/{kehadiran}", "absen_siswa_tidak_hadir");

});
