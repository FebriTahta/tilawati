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
            $table->id()->startingValue(223300);
            $table->unsignedBigInteger('pelatihan_id')->references('id')->on('pelatihans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('lembaga')->nullable();
            $table->string('name');
            $table->string('tmptlahir')->nullable();
            $table->date('tgllahir')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->integer('fs');
            $table->integer('tj');
            $table->integer('gm');
            $table->integer('sl');
            $table->integer('mt')->nullable();
            $table->string('bersyahadah')->nullable();
            $table->string('jilid')->nullable();
            $table->string('kriteria');
            $table->string('munaqisy')->nullable();
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
        Schema::dropIfExists('pesertas');
    }
}
