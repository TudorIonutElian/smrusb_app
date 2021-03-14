<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIstoricRegiuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_regiuni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regiune');
            $table->date('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('detalii', 100);
            $table->string('denumire_istoric', 100)->nullable();
            $table->string('denumire_actual', 100)->nullable();
            $table->integer('tip');

            $table->foreign('regiune')->references('id')->on('regiuni');
        });

        // Setare trigger pentru creare regiuni
        DB::unprepared('
                CREATE TRIGGER after_regiuni_creare
                    AFTER INSERT ON regiuni FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_regiuni(
                                regiune,
                                detalii,
                                tip,
                                denumire_istoric,
                                denumire_actual)
                            VALUES (
                                new.id,
                                CONCAT("Regiunea ", new.denumire, " a fost creata."),
                                new.stare,
                                new.denumire,
                                new.denumire);
                        END
                ');

        // Setare trigger pentru update regiuni
        DB::unprepared('
                CREATE TRIGGER after_regiuni_update
                    AFTER UPDATE ON regiuni FOR EACH ROW
                        BEGIN
                            IF NEW.STARE = 0 && OLD.STARE = 1 THEN
                                INSERT INTO istoric_regiuni(
                                    regiune,
                                    detalii,
                                    tip,
                                    denumire_istoric,
                                    denumire_actual)
                                VALUES (
                                    new.id,
                                    CONCAT("Regiunea ", new.denumire, " a fost suspendata."),
                                    new.stare,
                                    old.denumire,
                                    new.denumire);
                            END IF;
                            IF NEW.STARE = 1 && OLD.STARE = 0 THEN
                                INSERT INTO istoric_regiuni(
                                    regiune,
                                    detalii,
                                    tip,
                                    denumire_istoric,
                                    denumire_actual)
                                VALUES (
                                    new.id,
                                    CONCAT("Regiunea ", new.denumire, " a fost reactivata."),
                                    new.stare,
                                    old.denumire,
                                    new.denumire);
                            END IF;
                            IF NEW.STARE = 1 && OLD.STARE = 1 || NEW.STARE = 0 && OLD.STARE = 0  THEN
                                INSERT INTO istoric_regiuni(
                                    regiune,
                                    detalii,
                                    tip,
                                    denumire_istoric,
                                    denumire_actual)
                                VALUES (
                                    new.id,
                                    CONCAT("Denumirea regiunii ", old.denumire, " a fost schimbata in ", new.denumire, "."),
                                    new.stare,
                                    old.denumire,
                                    new.denumire);
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
        Schema::dropIfExists('istoric_regiuni');
    }
}
