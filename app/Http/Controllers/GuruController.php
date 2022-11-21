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

    public function insert_mapel(Request $request)
    {
        return "It's a Response From Ajax LOL";
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

    public function cam_masuk()
    {
        $process = new Process(['python ../../../app/cam_absen_masuk.py']);
        $process->setTimeout(3600);
        $process->run();
        // $camera = video_feed();

        if(!$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }

        dd( $process->getOutput());

        // $datas = json_decode($data, true);

        return view("guru.absencam");
    }

    public function read()
    {
        return "app/";
    }
}
