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
            $table->unsignedBigInteger('ps_cuprins');
            $table->unsignedBigInteger('ps_functie');
            $table->unsignedBigInteger('ps_angajat')->nullable();
            $table->date('ps_data_numire')->nullable();
            $table->string('ps_numar_act')->nullable();
            $table->date('ps_data_emitere')->nullable();
            $table->date('ps_data_creare')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('ps_data_radiere')->nullable();
            $table->boolean('ps_status')->default(true);

            $table->foreign('ps_stat', 'fk_pozitie_stat')->references('id')->on('stat_organizare');
            $table->foreign('ps_cuprins', 'fk_pozitie_cuprins')->references('id')->on('stat_cuprins');
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
