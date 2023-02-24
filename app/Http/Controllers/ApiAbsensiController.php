<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use App\Models\AdminPinoBot;
use App\Models\Guru;
use App\Models\JadwalAbsen;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;    

class ApiAbsensiController extends Controller
{
    # Api Admin Pino Bot
    # List Admin
    public function list_admin()
    {
        $data_admin = AdminPinoBot::all();

        return response()->json([
            "status" => true,
            "message" => "Daftar Admin Pino Bot",
            "data" => $data_admin
        ], 200);   
    }

    # Daftar Admin
    public function daftar_admin(Request $request)
    {
        $adminPinoBot = AdminPinoBot::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'status' => $request->status,
            'id_telegram' => $request->id_telegram
        ]);

        return response()->json([
            'data' => $adminPinoBot
        ]);
    }

    public function index($kelas, $mapel, $tanggal)
    {
        $data_kelas = kelas::all()->where("kelas", $kelas)->first()->id;
        $data_mapel = mapel::all()->where("pelajaran", $mapel)->first()->id;
        $absen_siswas = AbsenSiswa::with(["siswa", "kelas", "mapel", "guru"])->where("tanggal", $tanggal)->where("kelas_id", $data_kelas)->where("mapel_id", $data_mapel)->get();
        $data_jadwal = JadwalAbsen::with(["kelas", "mapel", "guru"])->where("tanggal", $tanggal)->where("kelas_id", $data_kelas)->where("mapel_id", $data_mapel)->get()->first();

        $data_absen = [];
        foreach($absen_siswas as $absensi){
           $data_absen[] = [
            "id_siswa" => $absensi->siswa_id,
            "nama"=>$absensi->siswa->nama_siswa,
            "kelas" => $absensi->kelas->kelas,
            "jam_masuk" => $absensi->masuk,
            "jam_pulang" => $absensi->pulang,
            "keterangan" => $absensi->keterangan,
            "kehadiran" => $absensi->keterangan_absensi,
           ];

        }
        return response()->json([
            "status" => true,
            "message" => "Data Absen Siswa $kelas, Tanggal ".Carbon::parse($data_jadwal->tanggal)->translatedFormat('d F Y'),
            "guru_mapel"=> $data_jadwal->guru->name,
            "kelas" => $data_jadwal->kelas->kelas,
            "mapel" => $data_jadwal->mapel->pelajaran,
            "tanggal" => Carbon::parse($data_jadwal->tanggal)->translatedFormat('d F Y'),
            "data" => $data_absen
        ], 200);

    }

    public function absen_siswa_tidak_hadir($kelas, $mapel, $tanggal, $kehadiran)
    {
        $data_kelas = kelas::all()->where("kelas", $kelas)->first()->id;
        $data_mapel = mapel::all()->where("pelajaran", $mapel)->first()->id;
        $absen_siswas = AbsenSiswa::with(["siswa", "kelas", "mapel", "guru"])->where("tanggal", $tanggal)->where("kelas_id", $data_kelas)->where("mapel_id", $data_mapel)->where("keterangan_absensi", $kehadiran)->get();
        $data_jadwal = JadwalAbsen::with(["kelas", "mapel", "guru"])->where("tanggal", $tanggal)->where("kelas_id", $data_kelas)->where("mapel_id", $data_mapel)->get()->first();

        $data_absen = [];
        foreach($absen_siswas as $absensi){
           $data_absen[] = [
            "id_siswa" => $absensi->siswa_id,
            "nama"=>$absensi->siswa->nama_siswa,
            "kelas" => $absensi->kelas->kelas,
            "jam_masuk" => $absensi->masuk,
            "jam_pulang" => $absensi->pulang,
            "keterangan" => $absensi->keterangan,
            "kehadiran" => $absensi->keterangan_absensi,
           ];

        }
        return response()->json([
            "status" => true,
            "message" => "Data Absen Siswa Tidak Hadir $kelas, Tanggal ".Carbon::parse($data_jadwal->tanggal)->translatedFormat('d F Y'),
            "guru_mapel"=> $data_jadwal->guru->name,
            "kelas" => $data_jadwal->kelas->kelas,
            "mapel" => $data_jadwal->mapel->pelajaran,
            "tanggal" => Carbon::parse($data_jadwal->tanggal)->translatedFormat('d F Y'),
            "kehadiran" => "Tidak Hadir",
            "data" => $data_absen
        ], 200);
    }

    public function list_guru()
    {
        $data_guru = Guru::all("id", "nip", "name", "jenis_kelamin", "username", "email", "no_hp");

        return response()->json([
            "status" => true,
            "message" => "Daftar Guru",
            "data" => $data_guru
        ], 200);   
    }

    public function list_kelas()
    {
        $data_kelas = kelas::all("id", "kelas", "nama_grup", "nama_walas", "chat_id");

        return response()->json([
            "status" => true,
            "message" => "Daftar Kelas",
            "data" => $data_kelas
        ], 200);   
    }
}
