<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateIstoricUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istoric_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->date('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('detalii', 100);
            $table->integer('tip');

            $table->foreign('user')->references('id')->on('users');
        });

        // Setare trigger pentru creare utilizatori
        DB::unprepared('
                CREATE TRIGGER after_users_creare
                    AFTER INSERT ON users FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_users(
                                user,
                                detalii,
                                tip
                                )
                            VALUES (
                                new.id,
                                CONCAT("Utilizatorul ", new.name, " a fost creat."),
                                0
                                );
                        END
                ');

        // Setare trigger pentru update regiuni
        DB::unprepared('
                CREATE TRIGGER after_users_update
                    AFTER UPDATE ON users FOR EACH ROW
                        BEGIN
                            IF NEW.ISACTIVE = 0 && OLD.ISACTIVE = 1 THEN
                                INSERT INTO istoric_users(
                                    user,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Utilizatorul ", new.name, " a fost suspendat."),
                                    2
                                );
                            END IF;
                            IF NEW.ISACTIVE = 1 && OLD.ISACTIVE = 0 THEN
                                INSERT INTO istoric_users(
                                    user,
                                    detalii,
                                    tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Utilizatorul ", new.name, " a fost activat."),
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
        Schema::dropIfExists('istoric_users');
    }
}
