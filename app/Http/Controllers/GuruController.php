<?php
namespace App\Http\Controllers;
use App\Models\kelas;
use App\Models\mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GuruController extends Controller
{
    public function index()
    {
        return view("guru.dashboard_guru", [
            "title" => "dashboard_guru",
        ]);
    }

    public function profile()
    {
        return view("guru.profile", [
            "title" => "profile_guru",
        ]);
    }

    public function absensi()
    {
        return view("guru.absensi", [
            "title" => "absensi",
        ]);
    }

    public function data_kelas()
    {
        return view("guru.data_kelas", [
            "title" => "data_kelas",
        ]);
    }

    public function tambah_jadwal()
    {
        $kelas = kelas::all(); 
        $mapel = mapel::all();
        return view("guru.tambah_jadwal",[
            "title"=>"absensi",
            "kelas"=>$kelas,
            "mapels"=>$mapel
        ]);
    }

    public function absen_siswa($kelas, $mapel)
    {
        // $process = new Process(['python ../../../app/absen_masuk.py']);
        // // $process->setTimeout(0);
        // $process->run();

        // if(!$process->isSuccessful())
        // {
        //     throw new ProcessFailedException($process);
        // }

        // $data = $process->getOutput();
        // // dd(json_decode($data, true));
        // $datas = json_decode($data, true);
        return view("templates.absensiswa",[
            "kelas" => $kelas,
            "no"=>1,
            "mapels" => $mapel,
            // "data"=> $datas
        ]);
    }

    public function absen_keluar_siswa($jadwal ,$mapel, $kelas)
    {
        // require "C:\laragon\www\Absensi-With-Facerecog\app\cam_absen_masuk.py";

        $process = new Process(['python ../../../app/absen_pulang.py']);
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
            "datas"=> $datas
        ]);
    }

    public function cam_masuk($mapel, $kelas)
    {
        // $process = new Process(['python ../../../app/cam_absen_masuk.py']);
        // $process->setTimeout(3600);
        // $process->run();
        // // $camera = video_feed();

        // if(!$process->isSuccessful())
        // {
        //     throw new ProcessFailedException($process);
        // }

        // dd( $process->getOutput());

        // // $datas = json_decode($data, true);

        return view("templates.absencam");
    }

    public function read()
    {
        return "app/";
    }
}
