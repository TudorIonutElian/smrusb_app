<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_adress', function (Blueprint $table) {
            $table->id('ua_id');
            $table->unsignedBigInteger('ua_user');
            $table->unsignedBigInteger('ua_judet');
            $table->unsignedBigInteger('ua_localitate');
            $table->unsignedBigInteger('ua_strada');
            $table->unsignedBigInteger('ua_numar');
            $table->unsignedBigInteger('ua_bloc');
            $table->unsignedBigInteger('ua_scara');
            $table->unsignedBigInteger('ua_etaj');
            $table->unsignedBigInteger('ua_apartament');

            $table->foreign('ua_user')->references('id')->on('users');
            //$table->foreign('ua_judet')->references('id')->on('judete');
            //$table->foreign('ua_localitate')->references('id')->on('localitati');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_adress');
    }
}
