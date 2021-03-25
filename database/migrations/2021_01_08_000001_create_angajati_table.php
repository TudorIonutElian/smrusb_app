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
            $table->unsignedBigInteger('angajat_acces_level')->nullable();

            $table->foreign('angajat_acces_level')->references('id')->on('institutii')->onDelete('set null');
        });

        // Setare trigger pentru creare angajat->adrese
        DB::unprepared('
                CREATE TRIGGER after_angajat_adaugare_adresa
                    AFTER INSERT ON angajati FOR EACH ROW
                        BEGIN
                                INSERT INTO angajati_adrese(
                                    aa_angajat)
                                VALUES (
                                    new.id);
                        END
                ');
        // Setare trigger pentru creare angajat->profile social media
        DB::unprepared('
                CREATE TRIGGER after_angajat_adaugare_profile
                    AFTER INSERT ON angajati FOR EACH ROW
                        BEGIN
                                INSERT INTO angajati_profile_social(
                                    aps_angajat)
                                VALUES (
                                    new.id);
                        END
                ');
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
