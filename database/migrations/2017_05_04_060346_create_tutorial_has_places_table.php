<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialHasPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_has_places', function (Blueprint $table) {
            $table->integer('id_tutorial')->unsigned();
            $table->integer('id_place')->unsigned();

            $table->primary(['id_tutorial', 'id_place']);

            $table->foreign('id_tutorial')
                ->references('id')
                ->on('tutorials')
                ->onDelete('cascade');

            $table->foreign('id_place')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorial_has_places');
    }
}
