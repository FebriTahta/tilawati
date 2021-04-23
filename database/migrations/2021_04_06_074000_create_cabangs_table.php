<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('status');
            $table->string('kepala')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alamat')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            // $table->string('email')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->string('kecamatan');
            $table->string('teritorial');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('cabangs', function (Blueprint $table){
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
        Schema::dropIfExists('cabangs');
    }
}
