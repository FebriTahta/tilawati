<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('name')->nullable();
            $table->string('ketua')->nullable();
            $table->string('wilayah')->nullable();
            $table->string('telp')->nullable();
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
        Schema::dropIfExists('kpas');
    }
}
