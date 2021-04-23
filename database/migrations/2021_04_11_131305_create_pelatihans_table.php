<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(5090);
            $table->unsignedBigInteger('cabang_id');
            $table->unsignedBigInteger('program_id');
            $table->date('tanggal');
            $table->integer('nomer')->nullable();
            $table->string('name');
            $table->longText('tempat')->nullable();
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::table('pelatihans', function (Blueprint $table){
            $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade')->onUpdate('cascade');
        });

        // Schema::table('pelatihans', function (Blueprint $table){
        //     $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatihans');
    }
}
