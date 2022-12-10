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
        Schema::create('jadwal_absens', function (Blueprint $table) {
            $table->id();
            $table->foreignId("guru_id");
            $table->date("tanggal");
            $table->foreignId("mapel_id");
            $table->foreignId("kelas_id");
            $table->time("mulai");
            $table->time("selesai");
            $table->time("batas_hadir");
            $table->string("status", 6)->default("live");
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
        Schema::dropIfExists('jadwal_absens');
    }
};
