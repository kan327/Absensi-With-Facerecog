<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\mapel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("layouts.main", [
            "title" => "dashboard",
        ]);
    }

    public function index_admin()
    {
        // mengambil data guru
        $data = User::all();

        // mengambil data mapel
        $mapel = mapel::all();
        
        // mengambil data kelas
        $kelas = kelas::all();
        return view('layouts.mainAdmin', [
            "title" => "dashboard_admin",
            "data" =>  $data,
            "mapel" => $mapel,
            "kelas" => $kelas,
            "no_guru" => 1,
            "no_mapel" => 1,
            "no_kelas" => 1
        ]);
    }
}
