<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificativeAngajatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angajati_calificative', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ca_angajat');
            $table->unsignedBigInteger('ca_institutie');
            $table->date('ca_data_inceput');
            $table->date('ca_data_sfarsit');
            $table->unsignedBigInteger('ca_calificativ_initial');
            $table->boolean('ca_are_contestatie');
            $table->unsignedBigInteger('ca_calificativ_final');
            $table->boolean('ca_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificative_angajati');
    }
}
