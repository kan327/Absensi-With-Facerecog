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
        Schema::create('jadwal_absens', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->foreignId("mapel_id");
            $table->foreignId("kelas_id");
            $table->time("mulai");
            $table->time("selesai");
            $table->time("batas_hadir");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_absens');
    }
};
