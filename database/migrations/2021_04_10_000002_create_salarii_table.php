<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarii', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_institutie');
            $table->unsignedBigInteger('s_angajat');
            $table->unsignedBigInteger('s_functie');
            $table->unsignedBigInteger('s_stat');
            $table->unsignedBigInteger('s_pozitie');
            $table->date('s_start_date');
            $table->date('s_end_date');
            $table->integer('s_suma_initiala');
            $table->integer('s_bonus');
            $table->integer('s_suma_finala');
            $table->boolean('s_achitat');
            $table->integer('s_tip_achitare');
            $table->date('s_data_achitarii')->nullable();

            $table->foreign('s_institutie')->references('id')->on('institutii');
            $table->foreign('s_angajat')->references('id')->on('angajati');
            $table->foreign('s_functie')->references('id')->on('functii');
            $table->foreign('s_stat')->references('id')->on('stat_organizare');
            $table->foreign('s_pozitie')->references('id')->on('pozitii_stat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarii');
    }
}
