<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Siswa;
use App\Models\UserKelas;
use App\Models\UserMapel;
use App\Models\AbsenSiswa;
use App\Models\JadwalAbsen;
use App\Exports\SiswaExport;
// use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GuruController extends Controller
{
    public function index()
    {
        $id_guru = auth()->guard('user')->user()->id;

        
        $data_guru = User::with(['user_mapels', 'user_kelas'])->get()->where("id", $id_guru);
        
        $live_absen = JadwalAbsen::with(['user', 'kelas', 'mapel'])->where('user_id', $id_guru)->where("status", "live")->orderBy('id', 'desc')->limit(1)->get();
        
        $lives = null;
        foreach($live_absen as $live){
            $lives = $live;
        }
     
        // mengambil data absen
        if(count($live_absen) > 0){
            $live_sisw_absen = AbsenSiswa::where("user_id", $id_guru)->where("tanggal", $lives->tanggal)->where("kelas_id", $lives->kelas_id)->get();
        }else{
            $live_sisw_absen = [];
        }
        
        // foreach($live_siswa_absen as $live){
            // dump($live->tanggal);
            // dump($live->kelas_id);
            // dump($live->mapel_id);
            // dump($live);
        // }

        // dd($live_siswa_absen);
        return view("guru.dashboard_guru", [
            "title" => "dashboard_guru",
            "gurus"=>$data_guru,
            "live_absens"=>$live_absen,
            "live_siswa_absens"=>$live_sisw_absen,
            "no_absen"=>1,
        ]);
    }

    public function profile()
    {
        $id_guru = auth()->guard('user')->user()->id;
        $kelas = kelas::all();
        $mapel = mapel::all();
        $guru = User::all()->where('id', $id_guru)->first();
        // dd($kelas);

        return view("guru.profile", [
            "title" => "profile_guru",
            "data_kelas"=> $kelas,
            "data_mapels"=> $mapel,
            "data_guru"=> $guru,
            "no_kelas"=>1,
            "no_mapel"=>1,
        ]);
    }

    public function insert_profile(Request $request)
    {
        $id_guru = auth()->guard('user')->user()->id;
        $req_kelas = $request->kelas;
        $req_mapel = $request->mapel;

        for($i = 0; $i < count($req_kelas); $i++){
            // dump($req_kelas[$i]);
            
            UserKelas::insert([
                "user_id"=> $id_guru,
                "kelas_id"=> $req_kelas[$i],
            ]);
        }

        for($i = 0; $i < count($req_mapel); $i++){
            
            UserMapel::insert([
                "user_id"=> $id_guru,
                "mapel_id"=> $req_mapel[$i],
            ]);
        }

        return redirect("/profile")->with("success", "Profile berhasil di update");
    }

    public function absensi()
    {
        $id_guru = auth()->guard('user')->user()->id;
        $guru = User::with(['user_kelas'],['user_mapels'])->get()->where("id", $id_guru);

        $data = JadwalAbsen::all()->where("user_id", $id_guru);
        // dd($guru);
        return view("guru.absensi", [
            "title" => "absensi",
            "jadwal_absens"=>$data,
            'no_jadwal'=>1
        ]);
    }

    public function data_kelas()
    {
        $id_guru = auth()->guard('user')->user()->id;
        $data_guru = User::with(['user_mapels','user_kelas'])->where("id", $id_guru)->get();
        // dd($data_guru);
        
        return view("guru.data_kelas", [
            "title" => "data_kelas",
            'no_siswa'=>1,
            "data_guru"=>$data_guru,
        ]);
    }

    public function table_kelas($id)
    {
        $kelas = kelas::all()->where("id", $id)->first();
        $siswa = Siswa::all()->where("kelas_id", $kelas->id);
        // dd($siswa);
        return view("guru.table_kelas", [
            "title"=>"data_kelas",
            "data_kelas"=>$kelas,
            "data_siswa"=>$siswa,
            "no"=>1,
        ]);
    }

    public function tambah_murid($id)
    {
        // $id_siswa = DB::select('SELECT ifnull(max(id) + 1 , 1) FROM siswas ');
        // dd($id_siswa);

        $data_guru = User::with(['user_mapels', "user_kelas"])->get()->where("id", auth()->guard('user')->user()->id)->first();
        // dd($data_guru->first()->user_mapels);
        $kelas = kelas::all()->where('id', $id); 
        $mapel = mapel::all();
        return view("guru.tambah_murid",[
            "title"=>"data_kelas",
            "kelas"=>$kelas,
            "mapels"=>$mapel,
            "data_guru"=>$data_guru
            // "nbr"=>$id_siswa,
            
        ]);
    }

    public function insert_murid(Request $request)
    {
        Siswa::insert([
            'nama_siswa'=>$request->nama,
            "kelas_id"=>$request->kelas,
            "jenis_kelamin" => $request->jeniskelamin,
            "tgl_lahir" => $request->tgllahir
        ]);
       
        return redirect("/data_siswa/tambah_murid/cam_daftar")->with("success", "Data siswa berhasil di buat");


    }

    // menampilkan tampilan tambah jadwal
    public function tambah_jadwal()
    {
        $data_gurus = User::with(['user_mapels', "user_kelas"])->get()->where("id", auth()->guard('user')->user()->id);
            
        // $kelas = kelas::all(); 
        return view("guru.tambah_jadwal",[
            "title"=>"absensi",
            // "kelas"=>$kelas,
            // "mapels"=>$mapel,
            "data_gurus"=>$data_gurus
        ]);
    }

    // menambahkan data ke jadwal database
    public function insert_jadwal(Request $request)
    {
        // dd((Dat)e::today());
        $id_guru = auth()->guard('user')->user()->id;
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
        $jadwal = DB::select("SELECT * FROM jadwal_absens WHERE user_id = $id_guru AND kelas_id = $validasi[kelas] AND mapel_id = $validasi[mapel] AND tanggal = curdate()");

        // dd($jadwal);

        if(count($jadwal) > 0){
             return redirect("/absensi/tambah_jadwal")->with("wrong", "Jadwal tersebut sudah tersedia!");
        }

        $query = JadwalAbsen::insert([
            "user_id" => auth()->guard('user')->user()->id,
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
                    "user_id" => $id_guru,
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
        // dd($jadwal);
        $jadwal->delete();

        return redirect("/absensi")->with("success", "Jadwal berhasil di hapus");
    }

    public function absen_siswa($tanggal, $kelas, $mapel)
    {
        // $process = new Process(['python ../../../app/PythonScript/cam_absen_pulang.py']);
        // // $process->setTimeout(0);
        // $process->run();
        
        
        // if(!$process->isSuccessful())
        // {
        //     throw new ProcessFailedException($process);
        // }

        // $data = $process->getOutput();
        // $datas = json_decode($data, true);
        // dd($datas);
        
        // $data_jadwal = DB::select("SELECT * FROM jadwal_absens WHERE kelas_id = $kelas AND mapel_id = $mapel AND tanggal = curdate()");

        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);
        
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
        $result = "Data Gagal di update";

        // echo 'loop for';
        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = DB::table("absen_siswas")->where("id", $request->datas[$i]['id_siswa']);
            $result = "absen ok";

            $absen_siswa->update([
                "masuk" => $request->datas[$i]['mulai'],
                "keterangan" => $request->datas[$i]['check']
            ]);
            $result = "Data berhasil di update ";
            // $absen_siswa->save();

            
        }
        return $result;
        
    }

    public function manual_absen_pulang(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "";

        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = DB::table("absen_siswas")->where("id", $request->datas[$i]['id_siswa']);
            $result = "ok";

            $absen_siswa->update([
                "pulang" => $request->datas[$i]['data_pulang']
            ]);

            $result = "Siswa berhasil di pulangkan";
        }
        return $result;
    }

    public function tutup_absen(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "gagal";
        $id = auth()->guard('user')->user()->id;
        DB::table("jadwal_absens")->where("user_id", $id)->where('tanggal', $tanggal)->where('kelas_id', $kelas)->where('mapel_id', $mapel)->update([
            "status"=>"down"
        ]);

        
        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = DB::table("absen_siswas")->where("id", $request->datas[$i]['id_siswa']);
            $result = "ok";

            $absen_siswa->update([
                "masuk" => $request->datas[$i]['jam_masuk'],
                "keterangan" => $request->datas[$i]['keterangan']
            ]);

            $result = "Sesi absen telah di tutup";

        }

        return $result;
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

        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        foreach($data_jadwal as $data_jadwa){
            $data_selesai = $data_jadwa->selesai;
            $data_masuk = $data_jadwa->mulai;
            // dd($data_jadwa->selesai);
        }

        return view("guru.component.table_absen",[
            "data_absensi"=>$data_absensi,
            "data_selesai"=>$data_selesai,
            "data_mulai"=>$data_masuk,
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

    public function cam_daftar()
    {
        $data_siswa = DB::select('SELECT * FROM siswas ORDER BY id DESC LIMIT 1 ')[0]->id;
        // dd($data_siswa);

        $nbr = json_encode($data_siswa);
        // dd($nbr);
        $process = new Process(["python ../../../PythonScript/cam_daftar.py",$nbr]);
        $process->setTimeout(0);
        $process->run();
        
        
        if(!$process->isSuccessful())
        {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();
        $datas = json_decode($data, true);
        dd($datas);

        return view('guru.cam.camdaftar',[
            "title"=>"data_siswa"
        ]);
    }

    public function cam_masuk($mapel, $kelas)
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

        // // $datas = json_decode($data, true);

        return view("templates.absencam");
    }

    public function excel($tanggal, $kelas, $mapel){
        $id_guru = auth()->guard('user')->user()->id;
        $date = Carbon::createFromFormat('Y-m-d', $tanggal)->format('d-m-Y');
        // dd($date);
        return Excel::download(new SiswaExport($id_guru, $tanggal, $kelas, $mapel), 'Absensi '.$date.'.xlsx');
    }

    

}
