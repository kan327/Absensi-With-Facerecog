<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function tambah_guru_view()
    {
        return view("layouts.mainAdmin", [
            "title" => "tambah_guru"
        ]);
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

        return redirect('/admin')->with("success", "Akun Baru Berhasil Dibuat");
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
            "pelajaran" => $validasi['pelajaran']
        ]);

        return redirect("/admin")->with("success", "Mapel Baru Berhasil Dibuat");
    }
}
