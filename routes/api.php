<?php

use App\Http\Controllers\ApiAbsensiController;
use App\Http\Controllers\ApiAbsenSiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ApiAbsensiController::class)->group(function (){
    // data absensi
    Route::get("/AbsenSiswa/{kelas}/{mapel}/{tanggal}", "index");

    // filter tidak hadir
    Route::get("/AbsenSiswa/{kelas}/{mapel}/{tanggal}/{kehadiran}", "absen_siswa_tidak_hadir");

    // list guru
    Route::get("/list_guru", "list_guru");

    // list kelas
    Route::get("/list_kelas", "list_kelas");
});
