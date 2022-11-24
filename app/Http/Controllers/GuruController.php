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
        // validasi
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

        // checking jadwal absen
        $jadwal = DB::select("SELECT * FROM jadwal_absens WHERE kelas_id = $validasi[kelas] AND mapel_id = $validasi[mapel] AND tanggal = curdate()");

        // dd($jadwal);

        if(count($jadwal) > 0){
             return redirect("/absensi/tambah_jadwal")->with("wrong", "Jadwal tersebut sudah tersedia!");
        }

        $query = JadwalAbsen::insert([
            "tanggal" => Date::today(),
            "mapel_id" => $validasi['mapel'],
            "kelas_id" => $validasi['kelas'],
            "mulai" => $validasi['mulai'],
            "selesai" => $validasi['selesai'],
            "batas_hadir" => $validasi['batas_hadir'],
        ]);

        $data = DB::select("SELECT * FROM absen_siswas WHERE kelas_id = $validasi[kelas] AND tanggal = curdate()");
        // $data = AbsenSiswa::all()->where("kelas_id", $validasi['kelas'])->where("tanggal", );
        // dd($data);
        if($query == true && count($data) < 1){

            $siswa = DB::select("SELECT * FROM siswas WHERE kelas_id = $validasi[kelas] ORDER BY nama_siswa ASC");
            
            for($i = 0; $i < count($siswa); $i++){

                AbsenSiswa::insert([
                    "siswa_id" => $siswa[$i]->id,
                    "kelas_id" => $validasi['kelas'],
                    "tanggal" => Date::today(),
                    "keterangan" => "Belum Hadir",
                ]);
            }

        }else{

        }

        return redirect("/absensi")->with("success", "Jadwal Absen berhasil di buat");
    }

    // menghapus jadwal
    public function hapus_jadwal($id)
    {
        $jadwal = JadwalAbsen::find($id);
        $jadwal->delete();

        return redirect("/absensi")->with("success", "Jadwal berhasil di hapus");
    }

    public function absen_siswa($tanggal, $kelas, $mapel)
    {
        // $process = new Process(['python ../../../app/cam_absen_pulang.py']);
        // // $process->setTimeout(0);
        // $process->run();
        
        
        // if(!$process->isSuccessful())
        // {
        //     throw new ProcessFailedException($process);
        // }

        // $data = $process->getOutput();
        // // dd($data);
        // $datas = json_decode($data, true);
        
        // $data_jadwal = DB::select("SELECT * FROM jadwal_absens WHERE kelas_id = $kelas AND mapel_id = $mapel AND tanggal = curdate()");

        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);
        // dd($data_jadwal);
        $data_siswa = Siswa::all()->where("kelas_id", $kelas);

        $data_absensi = AbsenSiswa::all()->where("kelas_id", $kelas)->where("tanggal", $tanggal);

        // dd($data_jadwal[0]);
        $belum_hadir = AbsenSiswa::all()->where("keterangan", "Belum Hadir")->where("kelas_id", $kelas)->where("tanggal", $tanggal);
        return view("guru.detail_absensi",[
            "title" => "absensi",
            "kelas" => $kelas,
            // "symphony" => $data,
            "no"=>1,
            "i"=>1,
            "mapels" => $mapel,
            "tanggals"=>$tanggal,
            "data_jadwals" => $data_jadwal,
            "data_siswas" => $data_siswa,
            "belum_hadir" => $belum_hadir,
            "data_absensi" => $data_absensi,
            // "data"=> $datas
        ]);
    }

    public function manual_absen_masuk(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "Data GAgal Ditambahkan";

        // echo 'loop for';
        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = DB::table("absen_siswas")->where("id", $request->datas[$i]['id_siswa']);
            $result = "absen ok";

            $absen_siswa->update([
                "masuk" => $request->datas[$i]['mulai'],
                "keterangan" => $request->datas[$i]['check']
            ]);
            $result = "Data Absen berhasil di update";
            // $absen_siswa->save();

            
        }
        return "Absen berhasil di perbaharui";
        
    }

    // component
    public function box_absen_keterangan($tanggal, $kelas, $mapel)
    {
        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $data_siswa = Siswa::all()->where("kelas_id", $kelas);

        $data_absensi = AbsenSiswa::all()->where("kelas_id", $kelas)->where("tanggal", $tanggal);

        // // dd($data_jadwal[0]);
        $belum_hadir = AbsenSiswa::all()->where("keterangan", "Belum Hadir")->where("kelas_id", $kelas)->where("tanggal", $tanggal);

        return view("guru.component.box_absen_keterangan",[
            "data_jadwals"=>$data_jadwal,
            "data_siswas"=>$data_siswa,
            "belum_hadir"=>$belum_hadir
        ]);
    }

    public function table_absen($tanggal, $kelas, $mapel)
    {
        $data_absensi = AbsenSiswa::all()->where("kelas_id", $kelas)->where("tanggal", $tanggal);

        return view("guru.component.table_absen",[
            "data_absensi"=>$data_absensi,
            "i"=>1,
            "no"=>1,
            "tanggals"=>$tanggal,
            "kelas"=>$kelas,
            "mapels"=>$mapel
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
}
