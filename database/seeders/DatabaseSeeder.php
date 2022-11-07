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

        DB::table('users')->insert([
            "username"=>"Patir",
            "email"=>"patir@gmail.com",
            "no_hp"=> "82125662178",
            "password"=>Hash::make('123456')
        ]);

        DB::table('admins')->insert([
            "username"=>"admin",
            "password"=>Hash::make('123456')
        ]);
    }
}
