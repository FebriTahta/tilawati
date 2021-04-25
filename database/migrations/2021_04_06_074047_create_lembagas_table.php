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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->string('kepala')->nullable();
            $table->unsignedBigInteger('jenis_id')->references('id')->on('jenis')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('alamat')->nullable();
            $table->unsignedBigInteger('province_id')->references('id')->on('provinces')->onUpdate('cascade');
            $table->unsignedBigInteger('city_id')->references('id')->on('cities')->onUpdate('cascade');
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('tahunberdiri')->nullable();
            $table->string('tglmasuk')->nullable();
            $table->string('status');
            $table->timestamps();
             $table->softDeletes();
        });

        Schema::table('lembagas', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
