<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // use SoftDeletes;
    public function up()
    {
        Schema::create('guru_mapels', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references("id")->on("gurus");
            $table->unsignedBigInteger('mapel_id');
            $table->foreign('mapel_id')->references("id")->on("mapels"); 
            // $table->softDeletes();
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
        Schema::dropIfExists('guru_mapels');
    }
};
