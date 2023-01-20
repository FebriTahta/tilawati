<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyirkahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syirkahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->longText('syirkah_dc')->nullable();
            $table->string('ekstensi')->nullable();
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
        Schema::dropIfExists('syirkahs');
    }
}
