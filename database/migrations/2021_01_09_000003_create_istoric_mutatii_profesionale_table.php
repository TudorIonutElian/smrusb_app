<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIstoricMutatiiProfesionaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_mutatii_profesionale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imp_mutatie_id');
            $table->string('imp_act_numar');
            $table->date('imp_act_data_emitere');
            $table->date('imp_act_data_aplicare');
            $table->unsignedBigInteger('imp_institutie_id');
            $table->unsignedBigInteger('imp_angajat_id')->nullable();
            $table->unsignedBigInteger('imp_cuprins_id')->nullable();
            $table->unsignedBigInteger('imp_fel_numire_id')->nullable();
            $table->unsignedBigInteger('imp_pozitie_id')->nullable();
            $table->unsignedBigInteger('imp_functie_id')->nullable();
            $table->date('imp_data_creare_istoric')->nullable();

        });

        // Setare trigger pentru creare mutatie profesionala
        DB::unprepared('
                CREATE TRIGGER after_mutatii_creare
                    AFTER INSERT ON mutatii_profesionale FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_mutatii_profesionale(
                                imp_mutatie_id,
                                imp_act_numar,
                                imp_act_data_emitere,
                                imp_act_data_aplicare,
                                imp_institutie_id,
                                imp_angajat_id,
                                imp_cuprins_id,
                                imp_fel_numire_id,
                                imp_pozitie_id,
                                imp_functie_id,
                                imp_data_creare_istoric
                                )
                            VALUES (
                                new.id,
                                new.mp_act_numar,
                                new.mp_act_data_emitere,
                                new.mp_act_data_aplicare,
                                new.mp_institutie_id,
                                new.mp_angajat_id,
                                new.mp_cuprins_id,
                                new.mp_fel_numire_id,
                                new.mp_pozitie_id,
                                new.mp_functie_id,
                                CURDATE()
                                );
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
        Schema::dropIfExists('istoric_mutatii_profesionale');
    }
}
