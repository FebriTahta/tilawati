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
            $table->id();
            $table->string('name');
            $table->string('status');
            $table->string('kepala')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('propinsi_id')->references('id')->on('propinsis')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kota_id')->references('id')->on('kotas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alamat')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->string('ekspedisi')->nullable();
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
        Schema::dropIfExists('cabangs');
    }
}
