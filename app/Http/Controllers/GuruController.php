<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Guru;
use App\Models\User;
use App\Models\image;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Siswa;
use App\Models\GuruKelas;
use App\Models\GuruMapel;
use App\Models\UserKelas;
use App\Models\AbsenSiswa;
// use Maatwebsite\Excel\Excel;
use App\Models\JadwalAbsen;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GuruController extends Controller
{
    public function index()
    {

        $id_guru = auth()->user()->id;
        
        $data_guru = Guru::with(['guru_mapel', 'guru_kelas'])->where("id", $id_guru)->get();
        
        $live_absen = JadwalAbsen::with(['guru', 'kelas', 'mapel'])->where('guru_id', $id_guru)->where("status", "live")->orderBy('id', 'desc')->limit(1)->get();
        
        // format tanggal
        $date = Date::today();

        $tanggal = $date->format("D, d F Y");

        $year_now = Carbon::now("Asia/Jakarta")->format("Y");

        $lives = null;
        foreach($live_absen as $live){
            $lives = $live;
        }
     
        // mengambil data absen
        if(count($live_absen) > 0){
            $live_sisw_absen = AbsenSiswa::where("guru_id", $id_guru)->where("tanggal", $lives->tanggal)->where("kelas_id", $lives->kelas_id)->where("mapel_id",$lives->mapel_id)->get();
        }else{
            $live_sisw_absen = [];
        }

        // dd($live_siswa_absen);

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.dashboard_guru", [
            "title" => "dashboard_guru",
            "tanggal" => $tanggal,
            "year_now"=> $year_now,
            "gurus"=>$data_guru,
            "jum_kelas"=>count($jumlah_kelas),
            "jum_mapel"=>count($jumlah_mapel),
            "kelas_guru" => count($data_guru->first()->guru_kelas),
            "mapel_guru" => count($data_guru->first()->guru_mapel),
            "live_absens"=>$live_absen,
            "live_siswa_absens"=>$live_sisw_absen,
            "no_absen"=>1,
        ]);
        

    }

    public function profile()
    {
        $id_guru = auth()->user()->id;
        // data master kelas
        $kelas = kelas::all();
        // data master mapel
        $mapel = mapel::all();
        // data master guru
        $guru = Guru::all()->where('id', $id_guru)->first();

        // kelas guru
        $kelas_guru = GuruKelas::with(['kelas', 'guru'])->where("guru_id", $id_guru)->get();

        // mapel guru
        $mapel_guru = GuruMapel::with(["guru", "mapel"])->where("guru_id", $id_guru)->get();

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.profile", [
            "title" => "profile_guru",
            "data_kelas"=> $kelas,
            "data_mapels"=> $mapel,
            "kelas_gurus"=> $kelas_guru,
            "mapel_gurus"=> $mapel_guru,
            "data_guru"=> $guru,
            "no_kelas"=>1,
            "no_mapel"=>1,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
        ]);
    }

    public function insert_profile(Request $request)
    {
        $id_guru = auth()->user()->id;
        $req_kelas = $request->kelas;
        $req_mapel = $request->mapel;

        for($i = 0; $i < count($req_kelas); $i++){
            // dump($req_kelas[$i]);
                
            GuruKelas::create([
                "guru_id"=> $id_guru,
                "kelas_id"=> $req_kelas[$i],
            ]);

        }

        for($i = 0; $i < count($req_mapel); $i++){
            
            GuruMapel::create([
                "guru_id"=> $id_guru,
                "mapel_id"=> $req_mapel[$i],
            ]);
        }

        return redirect("/")->with("success", "Profile Berhasil Di Ubah");
    }

    public function absensi()
    {
        $id_guru = auth()->user()->id;
        $guru = Guru::with(['guru_kelas', 'guru_mapel'])->where("id", $id_guru)->get();
        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");

        // difforuhmans
        // dd(Carbon::parse("2022/10/10")->diffForHumans());
        $date_now = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $data = JadwalAbsen::all()->where("guru_id", $id_guru);

        // tahun
        $year_now = Carbon::now("Asia/Jakarta")->format("Y");

        // bulan
        $nama_bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $format_bulan = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

        // tanggal
        $tanggal = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];

        // validate
        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        if(count($jumlah_mapel) > 0 && count($jumlah_kelas) > 0){
            return view("guru.absensi", [
                "title" => "absensi",
                'time_now' => $time_now,
                "jum_kelas" => count($jumlah_kelas),
                "jum_mapel" => count($jumlah_mapel),
                "date_now" => $date_now,
                "jadwal_absens"=>$data,
                'no_jadwal'=>1,
                "year_now" => $year_now,
                "nama_bulan" => $nama_bulan,
                "format_bulan" => $format_bulan,
                "tanggals" => $tanggal,
            ]);
        }

        return redirect("/")->with("validate", 'Anda Harus Memilih Kelas Dan Mapel');

    }

    public function table_jadwal()
    {
        $id_guru = auth()->user()->id;
        $date_now = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");
        $data_jadwal = JadwalAbsen::where("guru_id", $id_guru)->get();

        return view("guru.component.table_jadwal", [
            "jadwal_absens" => $data_jadwal,
            "date_now" => $date_now,
            "time_now"=> $time_now
        ]);
    }

    // filter tanpa tanggal dengan ajax
    public function filter_date($tahun, $bulan)
    {
        $id_guru = auth()->user()->id;
        $date_now = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");

        $data_jadwal = JadwalAbsen::where("guru_id", $id_guru)->where("tanggal", "like", "%$tahun-$bulan-%")->get();

        if(count($data_jadwal) < 1){
            return '
            <div class="absolute left-1/2 top-1/2 flex flex-col items-center" style="transform: translate(-50%, -50%);">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.5 25.6193C19.9436 25.6193 25.1667 20.2903 25.1667 13.716C25.1667 7.14156 19.9436 1.81257 13.5 1.81257C7.05635 1.81257 1.83333 7.14156 1.83333 13.716C1.83333 20.2903 7.05635 25.6193 13.5 25.6193ZM13.5 27.1073C20.7486 27.1073 26.625 21.1117 26.625 13.716C26.625 6.32023 20.7486 0.324646 13.5 0.324646C6.25135 0.324646 0.375 6.32023 0.375 13.716C0.375 21.1117 6.25135 27.1073 13.5 27.1073Z"
                                    fill="#2C3E50" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.76042 15.2039C9.76667 15.2039 10.5833 13.8722 10.5833 12.228C10.5833 10.5839 9.76667 9.2522 8.76042 9.2522C7.75417 9.2522 6.9375 10.5839 6.9375 12.228C6.9375 13.8722 7.75417 15.2039 8.76042 15.2039ZM18.2396 15.2039C19.2458 15.2039 20.0625 13.8722 20.0625 12.228C20.0625 10.5839 19.2458 9.2522 18.2396 9.2522C17.2333 9.2522 16.4167 10.5839 16.4167 12.228C16.4167 13.8722 17.2333 15.2039 18.2396 15.2039ZM11.5458 21.538L11.5137 21.564C11.3635 21.6883 11.171 21.7466 10.9786 21.7261C10.7862 21.7056 10.6096 21.608 10.4878 21.4547C10.366 21.3013 10.3088 21.1049 10.3289 20.9086C10.349 20.7123 10.4447 20.5322 10.595 20.4079L10.6927 20.3276C11.556 19.6133 12.4507 18.8731 13.8092 18.4981C15.2106 18.1113 17.0241 18.1306 19.7475 18.7384C19.8411 18.7594 19.9297 18.7989 20.0082 18.8547C20.0868 18.9105 20.1539 18.9816 20.2055 19.0639C20.2572 19.1462 20.2925 19.238 20.3093 19.3342C20.3262 19.4304 20.3243 19.5291 20.3039 19.6245C20.2834 19.72 20.2446 19.8104 20.1899 19.8905C20.1352 19.9707 20.0655 20.0391 19.9849 20.0918C19.9042 20.1445 19.8142 20.1805 19.7199 20.1977C19.6256 20.215 19.529 20.2131 19.4354 20.1922C16.8162 19.6074 15.2682 19.6372 14.1905 19.9347C13.1332 20.2264 12.45 20.7903 11.5458 21.538V21.538Z"
                                    fill="#2C3E50" />
                            </svg>
                            <p class="font-semibold text-placeholder">Pencarian Tidak Ditemukan! <span class="text-bg-blue-dark font-bold"> Cari Lagi</span></p>
                        </div>
            ';
        }else{

            return view("guru.component.table_jadwal", [
                "jadwal_absens" => $data_jadwal,
                "date_now" => $date_now,
                "time_now"=> $time_now
            ]);

        }

    }

    // filter dengan tanggal dan ajax
    public function filter_tanggal($tahun, $bulan, $tanggal)
    {
        $id_guru = auth()->user()->id;
        $date_now = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");
        
        $data_jadwal = JadwalAbsen::where("guru_id", $id_guru)->where("tanggal", "like", "%$tahun-$bulan-$tanggal%")->get();

        if(count($data_jadwal) < 1){
            return '
            <div class="absolute left-1/2 top-1/2 flex flex-col items-center" style="transform: translate(-50%, -50%);">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.5 25.6193C19.9436 25.6193 25.1667 20.2903 25.1667 13.716C25.1667 7.14156 19.9436 1.81257 13.5 1.81257C7.05635 1.81257 1.83333 7.14156 1.83333 13.716C1.83333 20.2903 7.05635 25.6193 13.5 25.6193ZM13.5 27.1073C20.7486 27.1073 26.625 21.1117 26.625 13.716C26.625 6.32023 20.7486 0.324646 13.5 0.324646C6.25135 0.324646 0.375 6.32023 0.375 13.716C0.375 21.1117 6.25135 27.1073 13.5 27.1073Z"
                                    fill="#2C3E50" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.76042 15.2039C9.76667 15.2039 10.5833 13.8722 10.5833 12.228C10.5833 10.5839 9.76667 9.2522 8.76042 9.2522C7.75417 9.2522 6.9375 10.5839 6.9375 12.228C6.9375 13.8722 7.75417 15.2039 8.76042 15.2039ZM18.2396 15.2039C19.2458 15.2039 20.0625 13.8722 20.0625 12.228C20.0625 10.5839 19.2458 9.2522 18.2396 9.2522C17.2333 9.2522 16.4167 10.5839 16.4167 12.228C16.4167 13.8722 17.2333 15.2039 18.2396 15.2039ZM11.5458 21.538L11.5137 21.564C11.3635 21.6883 11.171 21.7466 10.9786 21.7261C10.7862 21.7056 10.6096 21.608 10.4878 21.4547C10.366 21.3013 10.3088 21.1049 10.3289 20.9086C10.349 20.7123 10.4447 20.5322 10.595 20.4079L10.6927 20.3276C11.556 19.6133 12.4507 18.8731 13.8092 18.4981C15.2106 18.1113 17.0241 18.1306 19.7475 18.7384C19.8411 18.7594 19.9297 18.7989 20.0082 18.8547C20.0868 18.9105 20.1539 18.9816 20.2055 19.0639C20.2572 19.1462 20.2925 19.238 20.3093 19.3342C20.3262 19.4304 20.3243 19.5291 20.3039 19.6245C20.2834 19.72 20.2446 19.8104 20.1899 19.8905C20.1352 19.9707 20.0655 20.0391 19.9849 20.0918C19.9042 20.1445 19.8142 20.1805 19.7199 20.1977C19.6256 20.215 19.529 20.2131 19.4354 20.1922C16.8162 19.6074 15.2682 19.6372 14.1905 19.9347C13.1332 20.2264 12.45 20.7903 11.5458 21.538V21.538Z"
                                    fill="#2C3E50" />
                            </svg>
                            <p class="font-semibold text-placeholder">Pencarian Tidak Ditemukan! <span class="text-bg-blue-dark font-bold"> Cari Lagi</span></p>
                        </div>
            ';
        }else{

            return view("guru.component.table_jadwal", [
                "jadwal_absens" => $data_jadwal,
                "date_now" => $date_now,
                "time_now"=> $time_now
            ]);

        }
    }

    public function data_kelas()
    {
        $id_guru = auth()->user()->id;
        // data_guru
        $data_guru = Guru::with(['guru_mapel','guru_kelas'])->where("id", $id_guru)->get()->first;
        $kelas_guru = GuruKelas::with(['guru','kelas'])->where("guru_id", $id_guru)->get();
        
        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();
        

        return view("guru.data_kelas", [
            "title" => "data_kelas",
            'no_siswa'=>1,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
            "data_guru"=>$data_guru,
            "kelas_gurus"=>$kelas_guru
        ]);
    }

    public function table_kelas($id)
    {   
        $id_guru = auth()->user()->id;
        $kelas = kelas::all()->where("id", $id)->first();
        $siswa = Siswa::where("kelas_id", $kelas->id)->orderBy("nama_siswa", "ASC")->get();
        // dd($siswa);

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.table_kelas", [
            "title"=>"data_kelas",
            "data_kelas"=>$kelas,
            "data_siswa"=>$siswa,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
            "no"=>1,
        ]);
    }

    public function tambah_murid($id)
    {
        $id_guru = auth()->user()->id;
        $id_siswa = DB::select('SELECT ifnull(max(id) + 1 , 1) as id_siswas FROM siswas');
        // dd($id_siswa);

        $data_guru = Guru::with(['guru_mapel', "guru_kelas"])->get()->where("id", auth()->user()->id)->first();
        // dd($data_guru->first()->guru_mapel);
        $kelas = kelas::all()->where('id', $id); 
        $mapel = mapel::all();

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.tambah_murid",[
            "title"=>"data_kelas",
            "kelas"=>$kelas,
            "mapels"=>$mapel,
            "data_guru"=>$data_guru,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
            "id_siswa"=>$id_siswa,
            
        ]);
    }

    public function insert_murid(Request $request)
    {
        Siswa::create([
            "id"=> $request->id_siswas,
            'nama_siswa'=>$request->nama,
            "kelas_id"=>$request->kelas,
            "jenis_kelamin" => $request->jeniskelamin,
            "tgl_lahir" => $request->tgllahir
        ]);
       
        return redirect("/data_siswa/tambah_murid/cam_daftar/$request->id_siswas");


    }

    // menampilkan tampilan tambah jadwal
    public function tambah_jadwal()
    {
        $id_guru = auth()->user()->id;
        $data_gurus = Guru::with(['guru_mapel', "guru_kelas"])->get()->where("id", auth()->user()->id);
            
        // $kelas = kelas::all(); 

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.tambah_jadwal",[
            "title"=>"absensi",
            // "kelas"=>$kelas,
            // "mapels"=>$mapel,
            "data_gurus"=>$data_gurus,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
            "sidebar" => 'no'
        ]);
    }

    // menambahkan data ke jadwal database
    public function insert_jadwal(Request $request)
    {
        $id_guru = auth()->user()->id;

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
        $date_now = Carbon::now("Asia/Jakarta")->format("Y-m-d");
        // dd($date_now);
        $jadwal = JadwalAbsen::where('guru_id', $id_guru)->where("kelas_id",$validasi['kelas'])->where("mapel_id",$validasi['mapel'])->where("tanggal", $date_now)->get();
        // dd($jadwal);
        if(count($jadwal) > 0){
             return redirect("/absensi")->with("wrong", "Jadwal Tersebut Sudah Tersedia!");
        }

        $query = JadwalAbsen::create([
            "guru_id" => auth()->user()->id,
            "tanggal" => Carbon::now("Asia/Jakarta")->format("Y/m/d"),
            "mapel_id" => $validasi['mapel'],
            "kelas_id" => $validasi['kelas'],
            "mulai" => $validasi['mulai'],
            "selesai" => $validasi['selesai'],
            "batas_hadir" => $validasi['batas_hadir'],
        ]);

        $data = AbsenSiswa::where("guru_id", $id_guru)->where("kelas_id", $validasi["kelas"])->where("mapel_id", $validasi['mapel'])->where("tanggal", $date_now)->where("guru_id", $id_guru)->get();
        // $data = AbsenSiswa::all()->where("kelas_id", $validasi['kelas'])->where("tanggal", );
        // dd($data);
        if($query == true && count($data) < 1){

            $siswa = Siswa::with(['kelas'])->where("kelas_id", $validasi["kelas"])->orderBy("nama_siswa","ASC")->get();
            // dd($siswa);
            for($i = 0; $i < count($siswa); $i++){

                AbsenSiswa::create([
                    "guru_id" => $id_guru,
                    "siswa_id" => $siswa[$i]->id,
                    "kelas_id" => $validasi['kelas'],
                    "mapel_id" => $validasi['mapel'],
                    "tanggal" => Date::today(),
                    "keterangan" => "Belum Hadir",
                ]);
            }

        }
        return redirect("/absensi")->with("success", "Jadwal Absen Berhasil Di Buat");

    }

    // menghapus jadwal
    public function hapus_jadwal($id, $tanggal, $kelas, $mapel)
    {
        $jadwal = JadwalAbsen::find($id);
        $absen_siswa = AbsenSiswa::where("guru_id", auth()->user()->id)->where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel);
        // dd($absen_siswa);
        $absen_siswa->delete();
        $jadwal->delete();

        return redirect("/absensi")->with("success", "Jadwal Berhasil Di Hapus");
    }

    public function reset_profile($id){
        // $id_guru = auth()->user()->id;
        $guru_kelas = GuruKelas::where("guru_id", $id);
        $guru_mapel = GuruMapel::where("guru_id", $id);

        $guru_kelas->delete();
        $guru_mapel->delete();

        return redirect("/")->with("success", "Profile Berhasil Di Reset");
    }


    public function absen_siswa($tanggal, $kelas, $mapel)
    {   
        $id_guru = auth()->user()->id;

        $data_jadwal = JadwalAbsen::all()->where("guru_id", $id_guru)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal)->first();
        
        $data_siswa = Siswa::all()->where("kelas_id", $kelas);
        $data_kelas = kelas::all()->where("id", $kelas);

        $belum_hadir = AbsenSiswa::all()->where("guru_id", $id_guru)->where("keterangan", "Belum Hadir")->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.detail_absensi",[
            "title" => "absensi",
            "data_kelas" => $data_kelas,
            "kelas" => $kelas,
            "batas_hadir" => $data_jadwal->first()->batas_hadir,
            "no"=>1,
            "i"=>1,
            "mapels" => $mapel,
            "tanggals"=>$tanggal,
            "time_now" => $time_now,
            "data_jadwals" => $data_jadwal,
            "data_siswas" => $data_siswa,
            "belum_hadir" => $belum_hadir,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
        ]);
    }
     
    

    public function manual_absen_masuk(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "Data Gagal di update";

        $id_guru = auth()->user()->id;

        // guru
        $guru = Guru::all()->where("id", $id_guru);

        // kelas
        $data_kelas = kelas::all()->where("id", $kelas);

        // echo 'loop for';
        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = AbsenSiswa::where("tanggal", $tanggal)->where("guru_id", $id_guru)->where('kelas_id', $kelas)->where("mapel_id", $mapel)->where("id", $request->datas[$i]['id_siswa']);

            $result = "absen ok";

            $absen_siswa->update([
                "masuk" => $request->datas[$i]['mulai'],
                "keterangan" => $request->datas[$i]['check'],
                "keterangan_absensi" => $request->datas[$i]['check_absen'],
            ]);


            $result = "Data Berhasil di Ubah ";
            // $absen_siswa->save();

            
        }
        return $result;

        
    }

    public function manual_absen_pulang(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "";

        $id_guru = auth()->user()->id;

        // guru
        $guru = Guru::all()->where("id", $id_guru);
        
        // kelas
        $data_kelas = kelas::all()->where("id", $kelas);

        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = AbsenSiswa::where("tanggal", $tanggal)->where("guru_id", $id_guru)->where('kelas_id', $kelas)->where("mapel_id", $mapel)->where("id", $request->datas[$i]['id_siswa']);

            $result = "ok";

            $absen_siswa->update([
                "pulang" => $request->datas[$i]['data_pulang'],
                "keterangan" => $request->datas[$i]['set_keterangans'],
                "keterangan_absensi"=> $request->datas[$i]['keterangan_absens']
            ]);

            $result = "Siswa Berhasil Di Pulangkan" ;
        }
        return $result;
    }

    public function tutup_absen(Request $request, $tanggal, $kelas, $mapel)
    {
        $result = "gagal";

        // id guru
        $id = auth()->user()->id;

        JadwalAbsen::where("guru_id", $id)->where('tanggal', $tanggal)->where('kelas_id', $kelas)->where('mapel_id', $mapel)->update([
            "status"=>"down"
        ]);

        
        for($i = 0; $i < count($request->datas); $i++){

            $absen_siswa = AbsenSiswa::where("tanggal", $tanggal)->where("guru_id", $id)->where('kelas_id', $kelas)->where("mapel_id", $mapel)->where("id", $request->datas[$i]['id_siswa']);

            $result = "ok";

            $absen_siswa->update([
                "masuk" => $request->datas[$i]['jam_masuk'],
                "keterangan" => $request->datas[$i]['keterangan'],
                "keterangan_absensi" => $request->datas[$i]['kehadiran']
            ]);

            $result = "Sesi Absen Telah Di Tutup";

        }

        return $result;
    }

    // component
    public function box_absen_keterangan($tanggal, $kelas, $mapel)
    {
        $id_guru = auth()->user()->id;
        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal)->first();

        $data_siswa = Siswa::all()->where("kelas_id", $kelas);

        $data_absensi = AbsenSiswa::all()->where("guru_id", $id_guru)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $belum_hadir = AbsenSiswa::all()->where("guru_id", $id_guru)->where("keterangan", "Belum Hadir")->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $hadir = AbsenSiswa::all()->where("guru_id", $id_guru)->where("keterangan", "Hadir")->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        return view("guru.component.box_absen_keterangan",[
            "data_jadwals"=>$data_jadwal,
            "data_siswas"=>$data_siswa,
            "hadirs"=>$hadir,
            "belum_hadir"=>$belum_hadir
        ]);
    }

    public function table_absen($tanggal, $kelas, $mapel)
    {
        $id_guru = auth()->user()->id;
        $data_absensi = AbsenSiswa::all()->where("guru_id", $id_guru)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        $data_jadwals = JadwalAbsen::all()->where("guru_id", $id_guru)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal)->first();

        $time_now = Carbon::now("Asia/Jakarta")->format("H:i:s");
        $data_jadwal = JadwalAbsen::all()->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("tanggal", $tanggal);

        foreach($data_jadwal as $data_jadwa){
            $data_selesai = $data_jadwa->selesai;
            $data_masuk = $data_jadwa->mulai;
            $batas_hadir = $data_jadwa->batas_hadir;
            // dd($data_jadwa->selesai);
        }

        return view("guru.component.table_absen",[
            "data_absensi"=>$data_absensi,
            "time_now" => $time_now,
            "data_selesai"=>$data_selesai,
            "batas_hadir"=>$batas_hadir,
            "data_mulai"=>$data_masuk,
            "data_jadwals" => $data_jadwals,
            "i"=>1,
            "no"=>1,
            "tanggals"=>$tanggal,
            "kelas"=>$kelas,
            "mapels"=>$mapel
        ]);
    }

    public function absen_keluar_siswa($jadwal ,$mapel, $kelas)
    {
        return view("guru.absensiswapulang",[
            "kelas" => $kelas,
            "no"=>1,
            "mapel" => $mapel
        ]);
    }

    public function cam_daftar($id)
    {
        $id_guru = auth()->user()->id;
        $data_siswa = Siswa::find($id);
        // dd($data_siswa->nama_siswa);

        // validate

        $jumlah_mapel = GuruMapel::where("guru_id", $id_guru)->get();

        $jumlah_kelas = GuruKelas::where("guru_id", $id_guru)->get();

        return view("guru.cam.camdaftar", [
            "title"=>"data_kelas",
            "nama_siswa" => $data_siswa->nama_siswa,
            "id_siswa" => $id,
            "jum_kelas" => count($jumlah_kelas),
            "jum_mapel" => count($jumlah_mapel),
        ]);

    }


    public function simpan_gambar(Request $request)
    {
        $i = 1;
        $img = $request->image;
        $folderPath = "public/cam_js/images/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        while($i < 16) {
            $fileName = $request->nama_siswa . '.' . $i . '.jpg';
            $i++;
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);
        }
        
       
        // dd('Image uploaded successfully: '.$fileName);
        return redirect("/data_kelas")->with("success", "Data Murid Berhasil Disimpan");
        
    }

    public function cam_masuk($tanggal, $kelas, $mapel)
    {

        $data_absen = Siswa::with(['kelas'])->where("kelas_id", $kelas)->get();
        $data_kelas = kelas::find($kelas);
        
        return view("guru.cam_absen_masuk", [
            "title"=>"absensi",
            "data_kelas" => $data_kelas,
            "data_siswa" => $data_absen,
            "tanggals"=>$tanggal,
            "kelas"=>$kelas,
            "mapels"=>$mapel,
        ]);
    }

    public function update_cam_masuk($tanggal, $kelas, $mapel, $data_siswa)
    {
        $data_siswas = Siswa::where("nama_siswa", $data_siswa)->get();
        $jadwal_absen = JadwalAbsen::where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("guru_id", auth()->user()->id)->get();
        $data_absen = AbsenSiswa::where("siswa_id", $data_siswas->first()->id);

        $data_absen->update([
            "masuk" => Carbon::now("Asia/Jakarta")->format("H:i:s"),
            "keterangan" => "Hadir"
        ]);
        return "
        <p class='bg-green-600 w-full flex align-middle justify-between py-[2%] px-[2%] rounded-md text-white font-bold'>$data_siswa Berhasil Melakukan Absensi <span class='material-symbols-outlined'>check_circle</span></p>
        ";
    }

    public function cam_pulang($tanggal, $kelas, $mapel)
    {

        $data_absen = Siswa::with(['kelas'])->where("kelas_id", $kelas)->get();
        $data_kelas = kelas::find($kelas);

        return view("guru.cam_absen_pulang", [
            "title"=>"absensi",
            "data_kelas" => $data_kelas,
            "data_siswa"=> $data_absen,
            "tanggals"=>$tanggal,
            "kelas"=>$kelas,
            "mapels"=>$mapel,
        ]);
    }

    public function view_kirim_telegram($tanggal, $kelas, $mapel)
    {
        $id_guru = auth()->user()->id;

        $data_absen = AbsenSiswa::with(['siswa', 'mapel','kelas', 'guru'])->where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("guru_id", $id_guru)->whereNotIn('keterangan', ['Hadir', 'Terlambat'])->whereNotIn("keterangan_absensi", ['Hadir'])->get();

        $hadir = AbsenSiswa::with(['siswa', 'mapel','kelas', 'guru'])->where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("guru_id", $id_guru)->where("keterangan", "Hadir")->where("keterangan_absensi", "Hadir")->get();

        $tidak_hadir = AbsenSiswa::with(['siswa', 'mapel','kelas', 'guru'])->where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("guru_id", $id_guru)->where("keterangan_absensi", "Tidak Hadir")->get();

        $data_jadwal = JadwalAbsen::with(["kelas","mapel"])->where("tanggal" ,$tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->get();

        $data_kelas = kelas::all()->where("id", $kelas);

        return view("guru.kirim_telegram",[
            "title" => "absensi",
            "sub_title" => "kirim_telegram",
            "data_absen" => $data_absen,
            "hadir" => $hadir,
            "data_jadwal" => $data_jadwal,
            "tidak_hadir" => $tidak_hadir,
            "data_kelas" => $data_kelas,
            "tanggals" =>$tanggal,
            "id_kelas" => $kelas,
            "id_mapels" => $mapel,
            "sidebar" => 'no'
        ]);
    }

    public function kirim_telegram(Request $request, $tanggal, $kelas, $mapel)
    {
        $url = "https://api.telegram.org/bot5819520124:AAEivrJQBC61xDmrFRGzj0SQ35fAwxt5gG8/sendMessage?parse_mode=markdown&chat_id=" . $request->chat_id. "&text=". urlencode($request->message);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
       echo 'Pesan gagal terkirim, error :' . $err;
    }else{
        return redirect("/absen_siswa/$tanggal/$kelas/$mapel/")->with("success", "Pesan Berhasil Terkirim");
    }

    }

    public function update_cam_pulang($tanggal, $kelas, $mapel, $data_siswa)
    {
        $data_siswas = Siswa::where("nama_siswa", $data_siswa)->get();
        $jadwal_absen = JadwalAbsen::where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->where("guru_id", auth()->user()->id)->get();
        $data_absen = AbsenSiswa::where("siswa_id", $data_siswas->first()->id);

        $data_absen->update([
            "pulang" => Carbon::now("Asia/Jakarta")->format("H:i:s"),
            "keterangan_absensi" => "Hadir"
        ]);
        return "
        <p class='bg-green-600 w-full flex align-middle justify-between py-[2%] px-[2%] rounded-md text-white font-bold'>$data_siswa Berhasil Dipulangkan <span class='material-symbols-outlined'>check_circle</span></p>

        ";
    }

    // dokumentasi
    public function dokumentasi()
    {
        return view("guru.dokumentasi", [
            "title" => "dokumentasi",
        ]);
    }

    // export excel 
    public function excel($tanggal, $kelas, $mapel){
        
        // id guru
        $id_guru = auth()->user()->id;
        
        // kelas
        $data_kelas = kelas::all()->where("id", $kelas);

        // guru
        $guru = Guru::all()->where('id', $id_guru);

        $data_mapel = mapel::all()->where("id", $mapel);
        // dd($guru);
        // absen siswa
        $absen_siswa = AbsenSiswa::with(['kelas', 'guru', 'siswa'])->where('tanggal', $tanggal)->where("guru_id", $id_guru)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->get();
    
        $date = Carbon::parse($tanggal)->translatedFormat('d F Y');

        // return (new SiswaExport($absen_siswa->pluck("id"), $tanggal, $kelas, $mapel))->download("Absensi $tanggal Kelas {$data_kelas->first()->kelas} Mata Pelajaran {$data_mapel->first()->pelajaran}.xlsx");
        return Excel::download(new SiswaExport($absen_siswa->pluck("id"), $tanggal, $kelas, $mapel), "Absensi $date Kelas {$data_kelas->first()->kelas} Mata Pelajaran {$data_mapel->first()->pelajaran}.xlsx");
    }
    
}
