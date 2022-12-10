<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\GuruMapel;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\Siswa;
use App\Models\User;
use App\Models\UserKelas;
use App\Models\UserMapel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // menambah data guru
        

        Guru::factory(5)->create();

        // menambah data admin
        Admin::create([
            "username"=>"admin",
            "password"=>Hash::make('123456')
        ]);

        // menambah matpel
        mapel::create([
            "pelajaran"=>"PBO"
        ]);
        mapel::create([
            "pelajaran"=>"PWD"
        ]);
        mapel::create([
            "pelajaran"=>"Basis Data"
        ]);

        // menambah kelas
        kelas::create([
            "kelas"=>"XI PPLG 1",
            "nama_grup"=>"PPLG 1 2022",
            "nama_walas"=> "Shinta Nuralifah",
            "chat_id"=> 87978979,
        ]);
        kelas::create([
            "kelas"=>"XI PPLG 2",
            "nama_grup"=>"PPLG 2 2022",
            "nama_walas"=> "Shinta Nuralifah",
            "chat_id"=> 78878787878,
        ]);
        kelas::create([
            "kelas"=>"XI PPLG 3",
            "nama_grup"=>"PPLG 3 2022",
            "nama_walas"=> "Shinta Nuralifah",
            "chat_id"=> 66768687,
        ]);

        Siswa::factory(30)->create();

        GuruMapel::create([
            "guru_id" => 2,
            "mapel_id" => 1,
            
        ]);
        GuruMapel::create([
            "guru_id" => 2,
            "mapel_id" => 3,
            
        ]);
        GuruMapel::create([
            "guru_id" => 2,
            "mapel_id" => 2,
            
        ]);
        GuruMapel::create([
            "guru_id" => 1,
            "mapel_id" => 1,
            
        ]);
        GuruMapel::create([
            "guru_id" => 1,
            "mapel_id" => 3,
            
        ]);


        GuruKelas::create([
            "guru_id" => 1,
            "kelas_id" => 1,
        ]);

        GuruKelas::create([
            "guru_id" => 1,
            "kelas_id" => 2,
        ]);

        GuruKelas::create([
            "guru_id" => 2,
            "kelas_id" => 1,
        ]);

        GuruKelas::create([
            "guru_id" => 2,
            "kelas_id" => 2,
        ]);

        Guru::create([
            "nip"=>'678678676',
            "name"=>"Fathir Akmal",
            "username"=>"Patir",
            "email"=>"patir@gmail.com",
            "no_hp"=> "82125662178",
            "jenis_kelamin"=> "Laki-Laki",
            "password"=>Hash::make('123456')
        ]);

        Guru::create([
            "nip"=>'678678678',
            "name"=>"Ridho Rizqi",
            "username"=>"Ridho",
            "email"=>"ridho@gmail.com",
            "no_hp"=> "822342342",
            "jenis_kelamin"=> "Laki-Laki",
            "password"=>Hash::make('123456')
        ]);
    }
}
