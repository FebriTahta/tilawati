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
        Schema::create('lembagas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('kode')->index();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->longText('name')->nullable()->index();
            $table->longText('alamat')->nullable();
            $table->unsignedBigInteger('kepala_id')->references('id')->on('kepalas')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('jenjang_id')->references('id')->on('jenjangs')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('provinsi_id')->references('id')->on('provinsi')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->references('id')->on('kabupaten')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->references('id')->on('kecamatan')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->references('id')->on('kelurahan')->onUpdate('cascade')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable()->index();
            $table->string('website')->nullable();
            $table->string('pengelola')->nullable();
            $table->integer('jml_guru')->nullable();
            $table->integer('jml_santri')->nullable();
            $table->date('tahunberdiri')->nullable();
            $table->date('tahunmasuk')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('lembagas', function (Blueprint $table){
            $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade');
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
