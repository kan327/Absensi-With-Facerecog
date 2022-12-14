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
        return view("guru.dashboard_guru", [
            "title" => "dashboard_guru",
            "tanggal" => $tanggal,
            "gurus"=>$data_guru,
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

        return view("guru.profile", [
            "title" => "profile_guru",
            "data_kelas"=> $kelas,
            "data_mapels"=> $mapel,
            "kelas_gurus"=> $kelas_guru,
            "mapel_gurus"=> $mapel_guru,
            "data_guru"=> $guru,
            "no_kelas"=>1,
            "no_mapel"=>1,
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

        $data = JadwalAbsen::all()->where("guru_id", $id_guru);
        return view("guru.absensi", [
            "title" => "absensi",
            'time_now' => $time_now,
            "jadwal_absens"=>$data,
            'no_jadwal'=>1
        ]);
    }

    public function data_kelas()
    {
        $id_guru = auth()->user()->id;
        // data_guru
        $data_guru = Guru::with(['guru_mapel','guru_kelas'])->where("id", $id_guru)->get()->first;
        $kelas_guru = GuruKelas::with(['guru','kelas'])->where("guru_id", $id_guru)->get();
        
        return view("guru.data_kelas", [
            "title" => "data_kelas",
            'no_siswa'=>1,
            "data_guru"=>$data_guru,
            "kelas_gurus"=>$kelas_guru
        ]);
    }

    public function table_kelas($id)
    {
        $kelas = kelas::all()->where("id", $id)->first();
        $siswa = Siswa::where("kelas_id", $kelas->id)->orderBy("nama_siswa", "ASC")->get();
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
        $id_siswa = DB::select('SELECT ifnull(max(id) + 1 , 1) as id_siswas FROM siswas');
        // dd($id_siswa);

        $data_guru = Guru::with(['guru_mapel', "guru_kelas"])->get()->where("id", auth()->user()->id)->first();
        // dd($data_guru->first()->guru_mapel);
        $kelas = kelas::all()->where('id', $id); 
        $mapel = mapel::all();
        return view("guru.tambah_murid",[
            "title"=>"data_kelas",
            "kelas"=>$kelas,
            "mapels"=>$mapel,
            "data_guru"=>$data_guru,
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
        $data_gurus = Guru::with(['guru_mapel', "guru_kelas"])->get()->where("id", auth()->user()->id);
            
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
        $date_now = Carbon::now()->format("Y-m-d");
        // dd($date_now);
        $jadwal = JadwalAbsen::all()->where('guru_id', $id_guru)->where("kelas_id",$validasi['kelas'])->where("mapel_id",$validasi['mapel'])->where("tanggal", $date_now);
        // dd($jadwal);
        if(count($jadwal) > 0){
             return redirect("/absensi")->with("wrong", "Jadwal Tersebut Sudah Tersedia!");
        }

        $query = JadwalAbsen::create([
            "guru_id" => auth()->user()->id,
            "tanggal" => Date::today(),
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
                "keterangan" => $request->datas[$i]['keterangan']
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
        $data_siswa = Siswa::find($id);
        // dd($data_siswa->nama_siswa);
        return view("guru.cam.camdaftar", [
            "title"=>"data_kelas",
            "nama_siswa" => $data_siswa->nama_siswa,
            "id_siswa" => $id,
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
        $data_absen = AbsenSiswa::with(['siswa', 'mapel','kelas', 'guru'])->where("tanggal", $tanggal)->where("kelas_id", $kelas)->where("mapel_id", $mapel)->whereNotIn('keterangan', ['Hadir', 'Terlambat'])->get();
        $data_kelas = kelas::all()->where("id", $kelas);

        return view("guru.kirim_telegram",[
            "title" => "absensi",
            "sub_title" => "kirim_telegram",
            "data_absen" => $data_absen,
            "data_kelas" => $data_kelas,
            "tanggals" =>$tanggal,
            "id_kelas" => $kelas,
            "id_mapels" => $mapel
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
        return redirect("/absen_siswa/$tanggal/$kelas/$mapel/");
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
