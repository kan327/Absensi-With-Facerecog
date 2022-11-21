<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\kelas;
use App\Models\mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index_admin()
    {
        // mengambil data guru
        $guru = User::all();

        // mengambil data mapel
        $mapel = mapel::all();
        
        // mengambil data kelas
        $kelas = kelas::all();

        // dump($guru);
        return view('admin.dashboard_admin', [
            "title" => "dashboard_admin",
            "gurus" =>  $guru,
            "mapels" => $mapel,
            "kelas" => $kelas,
            "no_guru" => 1,
            "no_mapel" => 1,
            "no_kelas" => 1
        ]);
    }

    public function box()
    {
        $kelas = kelas::all();
        $guru = User::all();
        $mapel = mapel::all();

        return view("admin.component.box", [
            "kelas"=>$kelas,
            "gurus"=>$guru,
            "mapels"=>$mapel,
        ]);
    }

    // menampilkan data dari table mapel
    public function table_mapel()
    {
        $data = mapel::all();

        return view("admin.component.table_mapel", [
            "mapels"=>$data,
            "no_mapel"=>1
        ]);
    }

    // menambahkan data mapel
    public function insert_mapel(Request $request)
    {
        $validasi = $request->validate([
            "pelajaran"=>"required|unique:mapels"
        ],[
            "pelajaran.required"=> "Pelajaran tidak boleh kosong!"
        ]);

        mapel::insert([
            "pelajaran"=>$validasi['pelajaran']
        ]);

        return redirect("/admin");
    }

    // menghapus data mapel

    public function delete_mapel($id)
    {
        $mapel = mapel::find($id);
        $mapel->delete();

        return redirect("/admin")->with("success", "Mapel berhasil di hapus");

    }

    //  menampilkan data dari table kelas
    public function table_kelas()
    {
        $data = kelas::all();

        return view("admin.component.table_kelas", [
            "kelas"=>$data,
            "no_kelas"=>1
        ]);
    }

    // menambahkan data pada table kelas
    public function insert_kelas(Request $request)
    {
        $validasi = $request->validate([
            "kelas"=>"required|unique:kelas"
        ],[
            "kelas.required"=>"Kelas tidak boleh kosong!",
            "kelas.unique"=>"Kelas tidak boleh sama!"
        ]);

        kelas::insert([
            "kelas"=>$validasi['kelas']
        ]);

        return redirect("/admin");
    }

    // menghapus data kelas
    public function delete_kelas($id)
    {
        $kelas = kelas::find($id);
        $kelas->delete();

        return redirect('/admin')->with("success", "Kelas berhasil di hapus");
    }

    // menambahkan data guru
    public function guru()
    {
        return view("admin.tambah_guru");
    }

    // membuat akun guru
    public function tambah_guru(Request $request)
    {
        $validasi = $request->validate([
            "name" => "required",
            "nip" => "required",
            "email" => "required|email:dns",
            "no_hp" => "required|max:13",
            "username" => "required|max:12",
            "password" => "required|min:5",
        ],[
            "name.required" => "Nama guru wajib di isi!",
            "nip.required" => "Nomer Induk Pegawai wajib di isi!",
            "email.required" => "Email wajib di isi!",
            "email.email" => "Email harus valid!",
            "no_hp.required" => "Nomor handphone wajib di isi!",
            "no_hp.max" => "Nomor handphone maximal 13 karakter!",
            "username.required" => "Username wajib di isi!",
            "username.max" => "Username maximal 12 karakter!",
            "password.required" => "Password wajib di isi!",
            "password.min" => "Password minimal 5 karakter!",
        ]);

        $data = User::insert([
            "nip" => $validasi['nip'],
            "name" => $validasi['name'],
            "username" => $validasi['username'],
            "email" => $validasi['email'],
            "no_hp" => $validasi['no_hp'],
            "password" => Hash::make($validasi['password']),
        ]);

        return redirect('/admin')->with("success", "Akun Guru Berhasil Dibuat");
    }

    public function delete_guru($id)
    {
        $guru = User::find($id);
        $guru->delete();

        return redirect('/admin')->with("success", "Data guru berhasil di hapus");
    }

    // view guru update
    public function update_guru($id)
    {
        $guru = User::find($id);

        return view("admin.edit_guru",[
            "gurus"=>$guru
        ]);
    }

    // update data guru
    public function edit_guru(Request $request, $id)
    {
        $validasi = $request->validate([
            "name" => "required",
            "nip" => "required",
            "email" => "required|email:dns",
            "no_hp" => "required|max:13",
            "username" => "required|max:12",
            "password" => "required|min:5",
        ],[
            "name.required" => "Nama guru wajib di isi!",
            "nip.required" => "Nomer Induk Pegawai wajib di isi!",
            "email.required" => "Email wajib di isi!",
            "email.email" => "Email harus valid!",
            "no_hp.required" => "Nomor handphone wajib di isi!",
            "no_hp.max" => "Nomor handphone maximal 13 karakter!",
            "username.required" => "Username wajib di isi!",
            "username.max" => "Username maximal 12 karakter!",
            "password.required" => "Password wajib di isi!",
            "password.min" => "Password minimal 5 karakter!",
        ]);

        $data = DB::table("users")->where("id", $id);

        $data->update([
            "nip" => $validasi['nip'],
            "name" => $validasi['name'],
            "username" => $validasi['username'],
            "email" => $validasi['email'],
            "no_hp" => $validasi['no_hp'],
            "password" => $validasi['password'],
        ]);

        // $data->save();

        return redirect("/admin")->with("success", "Data guru berhasil di ubah");
    }





    // membuat kelas
    public function tambah_kelas(Request $request)
    {
        $validasi = $request->validate([
            "kelas" => "required|unique:kelas" 
        ],[
            "kelas.required"=>"Kelas tidak boleh kosong!",
            "kelas.unique"=>"Kelas tersebut sudah ada!"
        ]);

        kelas::insert([
            "kelas" => $validasi['kelas']
        ]);

        return redirect("/admin")->with("success", 'Kelas Baru Berhasil Dibuat');
    }

    // membuat mapel
    public function tambah_mapel(Request $request)
    {
        $validasi = $request->validate([
            "pelajaran" => "required|unique:mapels" 
        ],[
            "pelajaran.required"=>"Mata pelajaran tidak boleh kosong!",
            "pelajaran.unique"=>"Mata pelajaran tersebut sudah ada!"
        ]);

        mapel::insert([
            "pelajaran"=> $validasi['pelajaran']
        ]);

        return redirect("/admin")->with("success", "Mapel Baru Berhasil Dibuat");
    }
}
