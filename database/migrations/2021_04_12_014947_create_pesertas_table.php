<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(223300);
            $table->bigInteger('nik')->nullable();
            $table->unsignedBigInteger('acara_id')->nullable();
            $table->unsignedBigInteger('pelatihan_id')->nullable();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->text('slug')->nullable();
            $table->date('tanggal');
            $table->string('name')->index();
            $table->string('tmptlahir')->nullable()->index();
            $table->string('tgllahir')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable()->index();
            $table->string('telp')->nullable()->index();
            $table->string('email')->nullable();
            // $table->integer('tf')->nullable();
            // $table->integer('fs')->nullable();
            // $table->integer('tj')->nullable();
            // $table->integer('gm')->nullable();
            // $table->integer('sl')->nullable();
            // $table->integer('mt')->nullable();
            // $table->integer('im')->nullable();
            // $table->integer('il')->nullable();
            // $table->integer('i')->nullable();
            $table->string('bersyahadah')->nullable();
            $table->string('jilid')->nullable();
            $table->string('kriteria')->nullable();
            $table->string('munaqisy')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pesertas', function (Blueprint $table){
            $table->foreign('pelatihan_id')->references('id')->on('pelatihans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}
