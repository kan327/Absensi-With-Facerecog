<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nama_siswa"=> $this->faker->name(),
            "kelas_id"=> Arr::random([1, 2, 3]),
            "jenis_kelamin" => Arr::random(['Laki-Laki', "Perempuan"]),
            "tgl_lahir" => $this->faker->dateTimeBetween("2005-01-01", "2006-12-31")->format("Y-m-d"),
        ];
    }
}
