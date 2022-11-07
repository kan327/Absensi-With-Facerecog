<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceDatamasterController extends Controller
{
    // Tampilan siswa masuk
    public function absen_masuk()
    {
        return view("templates.absensiswa");
    }

    // Tampilan siswa pulang page
    public function absen_pulang()
    {
        return view("templates.absensiswapulang");
    }

    // Tampilan absen cam masuk
    public function absen_cam_masuk()
    {
        return view("templates.absencam");
    }

    // Tampilan absen cam pulang
    public function absen_cam_pulang()
    {
        return view("templates.absencampulang");
    }

}
