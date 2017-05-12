<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_days', function (Blueprint $table) {
            $table->integer('id_tutoria')->unsigned();
            $table->integer('id_place')->unsigned();
            $table->integer('id_day')->unsigned();
            $table->time('start_time');
            $table->time('end_time');

             $table->foreign('id_tutoria')
                ->references('id_tutorial')
                ->on('tutorial_has_places')
                ->onDelete('cascade');

             $table->foreign('id_place')
                ->references('id_place')
                ->on('tutorial_has_places')
                ->onDelete('cascade');

             $table->foreign('id_day')
                ->references('id')
                ->on('days')
                ->onDelete('cascade');

            $table->primary(['id_tutoria', 'id_place', 'id_day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorial_days');
    }
}
