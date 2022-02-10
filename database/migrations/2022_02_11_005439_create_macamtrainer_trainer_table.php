<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacamtrainerTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macamtrainer_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('macamtrainer_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
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
        Schema::dropIfExists('macamtrainer_trainer');
    }
}
