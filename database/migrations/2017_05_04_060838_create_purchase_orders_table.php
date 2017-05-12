<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('creation_date');
            $table->dateTime('programming_date');
            $table->decimal('hour_cost', 5, 2);
            $table->integer('hour');
            $table->decimal('total_cost', 5, 2);

            $table->integer('id_state')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('id_tutorial')->unsigned();
            $table->integer('id_place')->unsigned();


            $table->foreign('id_state')
                ->references('id')
                ->on('state_purchase_orders')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('id_tutorial')
                ->references('id_tutorial')
                ->on('tutorial_has_places')
                ->onDelete('cascade');

            $table->foreign('id_place')
                ->references('id_place')
                ->on('tutorial_has_places')
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
        Schema::dropIfExists('purchase_orders');
    }
}
