<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutatiiProfesionaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutatii_profesionale', function (Blueprint $table) {
            $table->id();
            $table->string('mp_act_numar');
            $table->date('mp_act_data_emitere');
            $table->date('mp_act_data_aplicare');
            $table->unsignedBigInteger('mp_institutie_id');
            $table->unsignedBigInteger('mp_angajat_id')->nullable();
            $table->unsignedBigInteger('mp_cuprins_id')->nullable();
            $table->unsignedBigInteger('mp_fel_numire_id')->nullable();
            $table->unsignedBigInteger('mp_pozitie_id')->nullable();
            $table->unsignedBigInteger('mp_functie_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mutatii_profesionale');
    }
}
