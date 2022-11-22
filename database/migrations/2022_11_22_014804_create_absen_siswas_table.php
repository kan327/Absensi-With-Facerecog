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
        Schema::create('absen_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("siswa_id");
            $table->foreignId("kelas_id");
            $table->date("tanggal");
            $table->string("masuk")->default("--");
            $table->string("pulang")->default("--") ;
            $table->string("keterangan")->default("Belum Hadir");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_siswas');
    }
};
