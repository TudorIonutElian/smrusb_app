<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngajatiAdreseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angajati_adrese', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aa_angajat');
            $table->unsignedBigInteger('aa_judet')->nullable();
            $table->unsignedBigInteger('aa_localitate')->nullable();
            $table->string('aa_strada')->nullable();
            $table->string('aa_numar')->nullable();
            $table->string('aa_bloc')->nullable();
            $table->string('aa_scara')->nullable();
            $table->string('aa_etaj')->nullable();
            $table->string('aa_apartament')->nullable();
            $table->string('aa_telefon_fix', 10)->nullable();
            $table->string('aa_telefon_mobil', 10)->nullable();
            $table->boolean('aa_status');

            $table->foreign('aa_angajat', 'fk_adresa_user')->references('id')->on('angajati')->onDelete('cascade');
            $table->foreign('aa_judet', 'fk_adresa_judet')->references('id')->on('judete')->onDelete('cascade');
            $table->foreign('aa_localitate', 'fk_adresa_localitate')->references('id')->on('localitati')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angajati_adrese');
    }
}
