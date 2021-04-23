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
            $table->unsignedBigInteger('pelatihan_id');
            $table->string('lembaga')->nullable();
            $table->string('name');
            $table->string('tmptlahir')->nullable();
            $table->string('tgllahir')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->integer('fs')->nullable();
            $table->integer('tj')->nullable();
            $table->integer('gm')->nullable();
            $table->integer('sl')->nullable();
            $table->integer('mt')->nullable();
            $table->integer('il')->nullable();
            $table->integer('im')->nullable();
            $table->integer('i')->nullable();
            $table->string('bersyahadah')->nullable();
            $table->string('jilid')->nullable();
            $table->string('kriteria')->nullable();
            $table->string('munaqisy')->nullable();
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
