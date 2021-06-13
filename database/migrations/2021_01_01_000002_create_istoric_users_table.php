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
            $table->id('id');
            $table->unsignedBigInteger('iu_user');
            $table->dateTime('iu_data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('iu_detalii', 100);
            $table->integer('iu_tip');

            $table->foreign('iu_user')->references('id')->on('users')->onDelete('cascade');
        });

        // Setare trigger pentru creare utilizatori
        DB::unprepared('
                CREATE TRIGGER after_users_creare
                    AFTER INSERT ON users FOR EACH ROW
                        BEGIN
                            INSERT INTO istoric_users(
                                iu_user,
                                iu_detalii,
                                iu_tip
                                )
                            VALUES (
                                new.id,
                                CONCAT("Utilizatorul ", new.user_first_name,  " ", new.user_last_name, " a fost creat."),
                                0
                                );
                        END
                ');

        // Setare trigger pentru update regiuni
        DB::unprepared('
                CREATE TRIGGER after_users_update
                    AFTER UPDATE ON users FOR EACH ROW
                        BEGIN
                            IF NEW.user_is_active = 0 && OLD.user_is_active = 1 THEN
                                INSERT INTO istoric_users(
                                    iu_user,
                                    iu_detalii,
                                    iu_tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Utilizatorul ",  new.user_first_name,  " ", new.user_last_name, " a fost suspendat."),
                                    2
                                );
                            END IF;
                            IF NEW.user_is_active = 1 && OLD.user_is_active = 0 THEN
                                INSERT INTO istoric_users(
                                    iu_user,
                                    iu_detalii,
                                    iu_tip
                                    )
                                VALUES (
                                    new.id,
                                    CONCAT("Utilizatorul ",  new.user_first_name,  " ", new.user_last_name, " a fost activat."),
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
