<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
           
            $table->integer('id_tutorial')->unsigned();
            $table->integer('id_bill')->unsigned();
            $table->integer('stars');

            $table->primary(['id_tutorial', 'id_bill']);


            $table->foreign('id_tutorial')
                ->references('id')
                ->on('tutorials')
                ->onDelete('cascade');

            $table->foreign('id_bill')
                ->references('id')
                ->on('bills')
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
        Schema::dropIfExists('scores');
    }
}
