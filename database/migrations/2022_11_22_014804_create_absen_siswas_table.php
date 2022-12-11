<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use SoftDeletes;
    public function up()
    {
        Schema::create('absen_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("guru_id");
            $table->foreignId("siswa_id");
            $table->foreignId("kelas_id");
            $table->foreignId("mapel_id");
            $table->date("tanggal");
            $table->string("masuk")->default("--");
            $table->string("pulang")->default("--") ;
            $table->string("keterangan")->default("Belum Hadir");
            $table->string("keterangan_absensi")->nullable();
            $table->softDeletes();
            $table->timestamps();
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
