<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGridHasDisciplineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grid_has_discipline', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grid_idgrid');
            $table->foreign('grid_idgrid')->references('id')->on('grid')->onDelete('cascade');
            $table->unsignedInteger('discipline_iddiscipline');
            $table->foreign('discipline_iddiscipline')->references('id')->on('disciplines')->onDelete('cascade');
            $table->string('classes')->enum('0','1','2','3')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grid_has_discipline');
    }
}
