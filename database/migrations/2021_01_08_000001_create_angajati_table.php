<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngajatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angajati', function (Blueprint $table) {
            $table->id();
            $table->string('angajat_nume', 50);
            $table->string('angajat_prenume_tata', 50)->nullable();
            $table->string('angajat_prenume_mama', 50);
            $table->string('angajat_prenume', 50);
            $table->string('angajat_cnp', 13)->unique();
            $table->string('angajat_nume_anterior', 50)->nullable();
            $table->date('angajat_data_nasterii');
            $table->integer('angajat_stare_civila');
            $table->unsignedInteger('angajat_cod_acces')->nullable();
            $table->unsignedInteger('angajat_functie_curenta')->nullable();
            $table->unsignedInteger('angajat_judet_nastere')->nullable();
            $table->unsignedInteger('angajat_institutie_curenta')->nullable();
            $table->unsignedInteger('angajat_localitate_nastere')->nullable();
            $table->unsignedInteger('angajat_pozitie_curenta')->nullable();
            $table->unsignedBigInteger('angajat_adaugat_by')->nullable();
            $table->boolean('angajat_status')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angajati');
    }
}
