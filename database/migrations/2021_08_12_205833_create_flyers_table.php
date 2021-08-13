<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelatihan_id')->nullable();
            $table->unsignedBigInteger('acara_id')->nullable();
            $table->string('image');
            $table->timestamps();
        });

        Schema::table('flyers', function (Blueprint $table){
            $table->foreign('pelatihan_id')->references('id')->on('pelatihans')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('flyers', function (Blueprint $table){
            $table->foreign('acara_id')->references('id')->on('acaras')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flyers');
    }
}
