<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('description',50)->nullable;
            $table->decimal('subtotal',5,2);
            $table->decimal('porcentage',3,2);
            $table->decimal('total',5,2);


            $table->integer('id_tutorial')->unsigned();
            $table->integer('id_place')->unsigned();
            $table->integer('id_state_tutorial_payment')->unsigned();
            $table->integer('id_tutor_payment')->unsigned();


            $table->foreign('id_tutorial')
                ->references('id_tutorial')
                ->on('tutorial_has_places')
                ->onDelete('cascade');
                
          $table->foreign('id_place')
                ->references('id_place')
                ->on('tutorial_has_places')
                ->onDelete('cascade');


            $table->foreign('id_state_tutorial_payment')
                ->references('id')
                ->on('state_tutorial_payments')
                ->onDelete('cascade');

            $table->foreign('id_tutor_payment')
                ->references('id')
                ->on('tutor_payments')
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
        Schema::dropIfExists('tutorials_payments');
    }
}
