<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIstoricInstitutiiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_institutii', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('istoric_institutii_institutie');
            $table->date('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('detalii', 100);
            $table->integer('tip');

            $table->foreign('istoric_institutii_institutie')->references('id')->on('institutii');
        });

        // Setare trigger pentru creare institutii
        DB::unprepared('
                CREATE TRIGGER after_institutii_creare
                    AFTER INSERT ON institutii FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_institutii(
                                istoric_institutii_institutie,
                                detalii,
                                tip
                                )
                            VALUES (
                                new.id,
                                CONCAT("Institutia ", new.institutie_denumire, " a fost creata."),
                                0
                                );
                        END
                ');

        // Setare trigger pentru update institutii
        DB::unprepared('
                CREATE TRIGGER after_institutii_update
                    AFTER UPDATE ON institutii FOR EACH ROW
                        BEGIN
                            IF NEW.institutie_este_activa = 0 && OLD.institutie_este_activa = 1 THEN
                                INSERT INTO istoric_institutii(
                                    istoric_institutii_institutie,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Institutia ", new.institutie_denumire, " a fost suspendata."),
                                    2
                                );
                            END IF;
                            IF NEW.institutie_este_activa = 1 && OLD.institutie_este_activa = 0 THEN
                                INSERT INTO istoric_institutii(
                                    istoric_institutii_institutie,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Institutia ", new.institutie_denumire, " a fost activata."),
                                    1
                                );
                            END IF;
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
        Schema::dropIfExists('istoric_institutii');
    }
}
