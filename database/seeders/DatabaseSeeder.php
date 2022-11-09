<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        DB::table('users')->insert([
            "nip"=>'678678676',
            "name"=>"Fathir Akmal",
            "username"=>"Patir",
            "email"=>"patir@gmail.com",
            "no_hp"=> "82125662178",
            "password"=>Hash::make('123456')
        ]);

        DB::table('users')->insert([
            "nip"=>'678678678',
            "name"=>"Ridho Rizqi",
            "username"=>"Ridho",
            "email"=>"ridho@gmail.com",
            "no_hp"=> "822342342",
            "password"=>Hash::make('123456')
        ]);

        // menambah data admin
        DB::table('admins')->insert([
            "username"=>"admin",
            "password"=>Hash::make('123456')
        ]);

        // menambah matpel
        DB::table('mapels')->insert([
            "pelajaran"=>"PBO"
        ]);
        DB::table('mapels')->insert([
            "pelajaran"=>"PWD"
        ]);
        DB::table('mapels')->insert([
            "pelajaran"=>"Basis Data"
        ]);

        // menambah kelas
        DB::table('kelas')->insert([
            "kelas"=>"XI PPLG 1"
        ]);
        DB::table('kelas')->insert([
            "kelas"=>"XI PPLG 2"
        ]);
        DB::table('kelas')->insert([
            "kelas"=>"XI PPLG 3"
        ]);
    }
}
