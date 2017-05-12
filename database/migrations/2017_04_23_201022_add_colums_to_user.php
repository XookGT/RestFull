<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('lastname',45)->after('name');
            $table->string('celphone',20)->after('email')->unique();
            $table->string('celphone2',20)->after('celphone')->nullable();
            $table->string('url_crimina_record',100)->after('celphone2')->nullable();
            $table->dateTime('birthdate');
            $table->string('dni',45)->after('url_crimina_record')->nullable();
            $table->string('dni_pdf',100)->after('dni')->nullable();
            $table->string('url_cv',100)->after('dni_pdf')->nullable();
            $table->integer('id_profile_status')->unsigned();
            $table->integer('super')->unsigned()->nullable();

            $table->foreign('id_profile_status')
                ->references('id')
                ->on('profile_statuses')
                ->onDelete('cascade');

            $table->foreign('fk_super')
                ->references('id')
                ->on('users')
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
        Schema::table('users', function($table)
        {
            $table->dropColumn('lastname');
            $table->dropColumn('celphone');
            $table->dropColumn('celphone2');
            $table->dropColumn('url_crimina_record');
            $table->dropColumn('dni');
            $table->dropColumn('dni_pdf');
            $table->dropColumn('url_cv');
            $table->dropColumn('id_rol');
        }
        );
    }
}
