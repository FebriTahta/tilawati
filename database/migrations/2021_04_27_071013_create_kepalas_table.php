<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepalas', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('nik')->nullable();
            $table->string('name')->nullable();
            $table->string('tmptlahir')->nullable();
            $table->string('tgllahir')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('telp')->nullable();
            $table->string('gender')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikanter')->nullable();
            $table->string('tahunlulus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepalas');
    }
}
