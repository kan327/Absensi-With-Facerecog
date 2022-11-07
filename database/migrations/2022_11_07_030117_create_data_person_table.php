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
        Schema::create('data_person', function (Blueprint $table) {
            $table->string("id_master", 7)->primary();
            $table->string("nama", 70);
            $table->string("kelas", 30);
            $table->bigInteger("nisn");
            $table->string("gender", 20);
            $table->timestamp("added_on")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_person');
    }
};
