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
            $table->bigIncrements('id');
            $table->bigInteger('nik')->nullable();
            $table->string('name');
            $table->string('tmptlahir')->nullable();
            $table->string('tgllahir')->nullable();
            $table->string('alamat');
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('telp');
            $table->string('gender');
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikanter');
            $table->string('tahunlulus');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('kepalas', function (Blueprint $table){
            $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('kepalas', function (Blueprint $table){
            $table->foreign('lembaga_id')->references('id')->on('lembagas')->onDelete('cascade')->onUpdate('cascade');
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
