<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('peserta_id')->nullable();
			$table->string('name');
            $table->integer('no')->nullable();
            $table->string('link');
            $table->timestamps();
        });

        Schema::table('certificates', function (Blueprint $table){
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
        Schema::dropIfExists('certificates');
    }
}
