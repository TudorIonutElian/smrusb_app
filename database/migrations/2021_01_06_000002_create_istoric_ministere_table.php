<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateIstoricMinistereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_ministere', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('istoric_ministere_minister');
            $table->dateTime('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('detalii', 100);
            $table->integer('tip');

            $table->foreign('istoric_ministere_minister')->references('id')->on('ministere');
        });

        // Setare trigger pentru creare ministere
        DB::unprepared('
                CREATE TRIGGER after_ministere_creare
                    AFTER INSERT ON ministere FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_ministere(
                                istoric_ministere_minister,
                                detalii,
                                tip
                                )
                            VALUES (
                                new.id,
                                CONCAT("Ministerul ", new.minister_denumire, " a fost creat."),
                                0
                                );
                        END
                ');

        // Setare trigger pentru update ministere
        DB::unprepared('
                CREATE TRIGGER after_ministere_update
                    AFTER UPDATE ON ministere FOR EACH ROW
                        BEGIN
                            IF NEW.minister_is_active = 0 && OLD.minister_is_active = 1 THEN
                                INSERT INTO istoric_ministere(
                                    istoric_ministere_minister,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Ministerul ", new.minister_denumire, " a fost suspendat."),
                                    2
                                );
                            END IF;
                            IF NEW.minister_is_active = 1 && OLD.minister_is_active = 0 THEN
                                INSERT INTO istoric_ministere(
                                    istoric_ministere_minister,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Ministerul ", new.minister_denumire, " a fost activat."),
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
        Schema::dropIfExists('istoric_ministere');
    }
}
