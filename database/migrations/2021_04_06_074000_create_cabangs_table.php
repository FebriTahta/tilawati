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
            $table->text('kode')->unique()->index();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->index();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('kepala_id')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->index();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('teritorial')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        // Schema::table('cabangs', function (Blueprint $table){
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        // });
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
