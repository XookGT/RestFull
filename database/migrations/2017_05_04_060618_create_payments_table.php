<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('from_cc',45);
            $table->string('descripcon',500)->nullable;
            $table->integer('id_xook_cc')->unsigned();
            $table->string('pdf_baucher',500)->nullable;
            $table->string('transfer_code',45);
            $table->integer('id_state_payment')->unsigned();
            $table->integer('id_payment_method')->unsigned();


            $table->foreign('id_xook_cc')
                ->references('id')
                ->on('xook_c_cs')
                ->onDelete('cascade');

            $table->foreign('id_payment_method')
                ->references('id')
                ->on('payment_methods')
                ->onDelete('cascade');

            $table->foreign('id_state_payment')
                ->references('id')
                ->on('payment_states')
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
        Schema::dropIfExists('payments');
    }
}
