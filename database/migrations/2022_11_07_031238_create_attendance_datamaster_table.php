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
        Schema::create('attendance_datamaster', function (Blueprint $table) {
            $table->id("attendance_id");
            $table->date("attendance_date")->index();
            $table->string("attendance_person", 70);
            $table->timestamp("attendance_in")->useCurrent();
            $table->timestamp("attendance_out")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_datamaster');
    }
};
