<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
            $table->string('description',500)->nullable();
            $table->integer('starts');
            $table->integer('rank');
            $table->integer('id_tutor')->unsigned();
            $table->integer('id_course')->unsigned();

            $table->foreign('id_tutor')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_course')
                ->references('id')
                ->on('courses')
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
        Schema::dropIfExists('tutorials');
    }
}
