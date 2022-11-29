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

      
        DB::table('data_person')->insert([
            "id_master"=> "1",
            "nama"=> "Ucup",
            "kelas"=> "X PPLG 1",
            "tanggal_lahir"=> "2022-11-12",
            "gender"=> "Laki - laki"
        ]);
        DB::table('data_person')->insert([
            "id_master"=> "2",
            "nama"=> "Tutung",
            "kelas"=> "X PPLG 1",
            "tanggal_lahir"=> "2022-10-15",
            "gender"=> "Laki - laki"
        ]);
        DB::table('data_person')->insert([
            "id_master"=> "3",
            "nama"=> "Ujang",
            "kelas"=> "X PPLG 1",
            "tanggal_lahir"=> "2006-05-22",
            "gender"=> "Laki - laki"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Ridho Rizqi",
            "kelas_id" => 1,
            "jenis_kelamin" => "Laki-laki",
            "tgl_lahir" => "2022/06/22"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Andhyka",
            "kelas_id" => 1,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Ahden",
            "kelas_id" => 1,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Kanny",
            "kelas_id" => 1,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Lumi",
            "kelas_id" => 1,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);
        DB::table('siswas')->insert([
            "nama_siswa" => "Tsaqif",
            "kelas_id" => 1,
            "jenis_kelamin" => "Laki-laki",
            "tgl_lahir" => "2022/06/22"
        ]);
        
        DB::table('siswas')->insert([
            "nama_siswa" => "Ujang",
            "kelas_id" => 2,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);

        DB::table('siswas')->insert([
            "nama_siswa" => "Ucup",
            "kelas_id" => 2,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);

        DB::table('siswas')->insert([
            "nama_siswa" => "tutung",
            "kelas_id" => 2,
            "jenis_kelamin" => "Perempuan",
            "tgl_lahir" => "2022/06/22"
        ]);

        DB::table('user_mapels')->insert([
            "user_id" => 2,
            "mapel_id" => 1,
            
        ]);
        DB::table('user_mapels')->insert([
            "user_id" => 2,
            "mapel_id" => 3,
            
        ]);
        DB::table('user_mapels')->insert([
            "user_id" => 2,
            "mapel_id" => 2,
            
        ]);
        DB::table('user_mapels')->insert([
            "user_id" => 1,
            "mapel_id" => 1,
            
        ]);
        DB::table('user_mapels')->insert([
            "user_id" => 1,
            "mapel_id" => 3,
            
        ]);


        DB::table('user_kelas')->insert([
            "user_id" => 1,
            "kelas_id" => 1,
        ]);

        DB::table('user_kelas')->insert([
            "user_id" => 1,
            "kelas_id" => 2,
        ]);

        DB::table('user_kelas')->insert([
            "user_id" => 2,
            "kelas_id" => 1,
        ]);

        DB::table('user_kelas')->insert([
            "user_id" => 2,
            "kelas_id" => 2,
        ]);
    }
}
