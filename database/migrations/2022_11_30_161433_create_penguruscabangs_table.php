<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenguruscabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruscabangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('bagian')->nullable();
            $table->string('nama_pengurus')->nullable();
            $table->string('telp_pengurus')->nullable();
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
        Schema::dropIfExists('penguruscabangs');
    }
}
