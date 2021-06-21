<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('lembagas', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('kode');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->longText('name')->nullable();
            $table->longText('alamat')->nullable();
            $table->unsignedBigInteger('kepala_id')->nullable();
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('website')->nullable();
            $table->string('pengelola')->nullable();
            $table->integer('jml_guru')->nullable();
            $table->integer('jml_santri')->nullable();
            $table->date('tahunberdiri')->nullable();
            $table->date('tahunmasuk')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('lembagas');
    }
}
