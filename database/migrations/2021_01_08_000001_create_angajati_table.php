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
            $table->unsignedBigInteger('angajat_cod_acces')->nullable();
            $table->unsignedBigInteger('angajat_functie_curenta')->nullable();
            $table->unsignedBigInteger('angajat_judet_nastere')->nullable();
            $table->unsignedBigInteger('angajat_institutie_curenta')->nullable();
            $table->unsignedBigInteger('angajat_localitate_nastere')->nullable();
            $table->unsignedBigInteger('angajat_pozitie_curenta')->nullable();
            $table->unsignedBigInteger('angajat_adaugat_by')->nullable();
            $table->boolean('angajat_status')->default(true);

            $table->foreign('angajat_functie_curenta', 'a_f_curent')->references('id')->on('functii')->onDelete('cascade');
            $table->foreign('angajat_judet_nastere', 'a_j_nastere')->references('id')->on('judete')->onDelete('cascade');
            $table->foreign('angajat_institutie_curenta', 'a_i_curent')->references('id')->on('institutii')->onDelete('cascade');
            $table->foreign('angajat_localitate_nastere', 'a_l_curent')->references('id')->on('localitati')->onDelete('cascade');
            $table->foreign('angajat_adaugat_by', 'a_uab_curent')->references('id')->on('users')->onDelete('cascade');

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
