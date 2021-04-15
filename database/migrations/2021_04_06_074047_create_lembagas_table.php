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
            $table->id();
            $table->unsignedBigInteger('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->string('kepala')->nullable();
            $table->unsignedBigInteger('jenis_id')->references('id')->on('jenis')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('alamat')->nullable();
            $table->unsignedBigInteger('propinsi_id')->references('id')->on('propinsis')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kota_id')->references('id')->on('kotas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('pengelola')->nullable();
            $table->string('totguru')->nullable();
            $table->string('totsantri')->nullable();
            $table->string('waktubelajar')->nullable();
            $table->string('tahunberdiri')->nullable();
            $table->string('tglmasuk')->nullable();
            $table->string('keanggotaan');
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
        Schema::dropIfExists('lembagas');
    }
}
