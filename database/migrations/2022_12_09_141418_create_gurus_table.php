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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('name', 30);
            $table->string('username', 20);
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->enum("jenis_kelamin", ['L', "P"]);
            $table->string('password');
            // $table->string('status', 6)->default("up");
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
        Schema::dropIfExists('gurus');
    }
};
