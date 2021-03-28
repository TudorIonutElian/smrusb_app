<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIstoricUserAccesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_user_acces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iua_user');
            $table->integer('iua_level');
            $table->string('iua_denumire');
            $table->date('iua_data');
            $table->enum('iua_tip', ['creare', 'activare', 'suspendare']);

            $table->foreign('iua_user', 'fk_ua_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('istoric_user_acces');
    }
}
