<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXookCCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xook_c_cs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_cc',25);
            $table->integer('id_bank')->unsigned();

            $table->foreign('id_bank')
                ->references('id')
                ->on('banks')
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
        Schema::dropIfExists('xook_c_cs');
    }
}
