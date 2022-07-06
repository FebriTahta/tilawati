<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApicabangtilawatisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('apicabangtilawatis', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('kode')->index();
            $table->string('name')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->unsignedBigInteger('kepala_id')->nullable();
            $table->string('kepalacabang')->nullable();
            $table->string('kadivre')->nullable();
            $table->string('teritorial')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('ekspedisi')->nullable();
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
        Schema::dropIfExists('apicabangtilawatis');
    }
}
