<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePozitiiStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pozitii_stat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ps_stat');
            $table->unsignedInteger('ps_pozitie');
            $table->string('ps_denumire_cuprins');
            $table->unsignedBigInteger('ps_functie');
            $table->unsignedBigInteger('ps_angajat');
            $table->date('ps_data_numire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pozitii_stat');
    }
}
