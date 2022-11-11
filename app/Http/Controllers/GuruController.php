<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GuruController extends Controller
{
    public function index()
    {
        return view('layouts.main', [
            "title"=>"absensi", 
        ]);
    }

    public function absen_siswa($kelas, $mapel)
    {
        $process = new Process(['python ../../../app/absen_masuk.py']);
        // $process->setTimeout(0);
        $process->run();

        if(!$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        // dd(json_decode($data, true));
        $datas = json_decode($data, true);
        return view("guru.absensiswa",[
            "kelas" => $kelas,
            "no"=>1,
            "mapel" => $mapel,
            "data"=> $datas
        ]);
    }

    public function absen_keluar_siswa($kelas, $mapel)
    {
        $process = new Process(['python ../../../app/absen_masuk.py']);
        // $process->setTimeout(0);
        $process->run();

        if(!$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        // dd(json_decode($data, true));
        $datas = json_decode($data, true);
        return view("guru.absensiswapulang",[
            "kelas" => $kelas,
            "no"=>1,
            "mapel" => $mapel,
            "data"=> $datas
        ]);
    }

    public function read()
    {
        return "app/";
    }
}
