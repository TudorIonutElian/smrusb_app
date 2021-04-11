<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontajLunarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontaj_lunar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pl_institutie');
            $table->unsignedBigInteger('pl_pozitie');
            $table->unsignedBigInteger('pl_angajat');
            $table->date('pl_start_date');
            $table->date('pl_end_date');
            $table->integer('pl_numar_ore');
            $table->boolean('pl_este_aprobat');

            $table->foreign('pl_institutie')->references('id')->on('institutii');
            $table->foreign('pl_pozitie')->references('id')->on('pozitii_stat');
            $table->foreign('pl_angajat', 'fk_pl_ang')->references('id')->on('angajati');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontaj_lunar');
    }
}
