<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nip" => mt_rand(0000000001, 9999999999),
            "name" => $this->faker->name(),
            "username"=> $this->faker->userName(),
            "email"=> $this->faker->unique()->safeEmail(),
            "no_hp" => $this->faker->phoneNumber(),
            "password" => Hash::make("123456"),
            "jenis_kelamin"=> Arr::random(['Laki-Laki', "Perempuan"]),
        ];
    }
}
