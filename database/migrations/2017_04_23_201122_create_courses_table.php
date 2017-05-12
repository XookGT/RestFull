<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
            $table->string('description',500)->nullable();
            $table->integer('starts');
            $table->integer('id_categorie')->unsigned();
            $table->integer('id_level')->unsigned();

            $table->foreign('id_categorie')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('id_level')
                ->references('id')
                ->on('levels')
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
        Schema::dropIfExists('courses');
    }
}
