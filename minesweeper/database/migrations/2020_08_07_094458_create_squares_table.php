<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSquaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squares', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grids_id')->unsigned();
			$table->tinyInteger('x');
			$table->tinyInteger('y');
			$table->tinyInteger('content');
			$table->boolean('discover')->default(false);
			$table->timestamps();

			$table->foreign('grids_id')->references('id')->on('grids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('squares');
    }
}
