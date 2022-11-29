<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_excels', function (Blueprint $table) {
            $table->id();
            $table->string("nama_guru");
            $table->string("nama_siswa");
            $table->string("masuk")->default("--");
            $table->string("pulang")->default("--");
            $table->string("nama_kelas");
            $table->date("tanggal");
            $table->string("keterangan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_excels');
    }
};
