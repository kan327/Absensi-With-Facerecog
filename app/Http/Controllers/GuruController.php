<?php
namespace App\Http\Controllers;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Siswa;
use App\Models\JadwalAbsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AbsenSiswa;
use Illuminate\Support\Facades\Date;
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
        $data = JadwalAbsen::all();

        return view("guru.absensi", [
            "title" => "absensi",
            "jadwal_absens"=>$data,
            'no_jadwal'=>1
        ]);
    }

    public function data_kelas()
    {
        return view("guru.data_kelas", [
            "title" => "data_kelas",
        ]);
    }

    // menampilkan tampilan tambah jadwal
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

    // menambahkan data ke jadwal database
    public function insert_jadwal(Request $request)
    {
        $validasi = $request->validate([
            "kelas" => "required",
            "mapel" => "required",
            "mulai" => "required",
            "batas_hadir" => "required",
            "selesai" => "required",
        ],[
            "kelas.required" => "Kelas tidak boleh kosong!",
            "mapel.required" => "Mata Pelajaran tidak boleh kosong!",
            "mulai.required" => "Jam Mulai tidak boleh kosong!",
            "batas_hadir.required" => "Jam Batas Kehadiran tidak boleh kosong!",
            "selesai.required" => "Jam Selesai tidak boleh kosong!",
        ]);

        $data = JadwalAbsen::insert([
            "tanggal" => Date::today(),
            "mapel_id" => $validasi['mapel'],
            "kelas_id" => $validasi['kelas'],
            "mulai" => $validasi['mulai'],
            "selesai" => $validasi['selesai'],
            "batas_hadir" => $validasi['batas_hadir'],
        ]);

        if($data){
            $siswa = DB::select("SELECT * FROM siswas WHERE kelas_id = $validasi[kelas] ");

            for($i = 0; $i < count($siswa); $i++){

                AbsenSiswa::insert([
                    "siswa_id" => $siswa[$i]->id,
                    "kelas_id" => $validasi['kelas'],
                    "tanggal" => Date::today(),
                ]);
            }
        }

        return redirect("/absensi")->with("success", "Jadwal Absen berhasil di buat");
    }

    public function absen_siswa($tanggal, $kelas, $mapel)
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

        // $data_jadwal = DB::select("SELECT * FROM jadwal_absens WHERE kelas_id = $kelas AND mapel_id = $mapel AND tanggal = curdate()");
        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $data_siswa = Siswa::all()->where("kelas_id", $kelas);

        $data_absensi = AbsenSiswa::all()->where("kelas_id", $kelas)->where("tanggal", $tanggal);

        $belum_hadir = AbsenSiswa::all()->where("keterangan", "Belum Hadir");
        return view("guru.detail_absensi",[
            "title" => "absensi",
            "kelas" => $kelas,
            "no"=>1,
            "i"=>1,
            "mapels" => $mapel,
            "data_jadwal" => $data_jadwal,
            "data_siswas" => $data_siswa,
            "belum_hadir" => $belum_hadir,
            "data_absensi" => $data_absensi,
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
