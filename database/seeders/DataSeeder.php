<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswas')->insert([
            'nama_siswa' => 'Fathir Apkmal',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2006-12-01',
        ]);

        DB::table('siswas')->insert([
            'nama_siswa' => 'Fathir Apkmal',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2006-12-01',
        ]);
        DB::table('siswas')->insert([
            'nama_siswa' => 'Lumi Novry M',
            'kelas_id' => '2',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2006-12-01',
        ]);
    }
}
