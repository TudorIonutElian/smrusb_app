<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariiCassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarii_cass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sc_institutie');
            $table->unsignedBigInteger('sc_angajat');
            $table->integer('sc_suma');
            $table->integer('sc_cass');
            $table->boolean('sc_achitat');
            $table->date('sc_data_achitarii');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarii_cass');
    }
}
