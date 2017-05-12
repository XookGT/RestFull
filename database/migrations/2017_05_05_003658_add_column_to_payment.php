<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function(Blueprint $table)
        {

            $table->integer('id_bill')->unsigned();

            $table->foreign('id_bill')
                ->references('id')
                ->on('bills')
                ->onDelete('cascade');

        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('payments', function($table)
        {
            $table->dropColumn('id_bill');
        }
        );
    }
}
