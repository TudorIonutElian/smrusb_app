<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitariAccesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitari_acces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sa_user');
            $table->unsignedBigInteger('sa_institutie');
            $table->date('sa_data_cerere');
            $table->date('sa_data_aprobare')->nullable();
            $table->boolean('sa_stare');

            $table->foreign('sa_user', 'fk_sa_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sa_institutie', 'fk_sa_institutie')->references('id')->on('institutii')->onDelete('cascade');
        });

        // Setare trigger pentru creare acces
        DB::unprepared('
                CREATE TRIGGER after_acces_aprobare
                    AFTER UPDATE ON solicitari_acces FOR EACH ROW
                        BEGIN
                            IF new.sa_stare = 1 THEN
                                INSERT INTO user_access(
                                    ua_user,
                                    ua_level,
                                    ua_denumire,
                                    ua_start_date,
                                    ua_end_date)
                                VALUES (
                                    new.sa_user,
                                    new.sa_institutie,
                                    (select institutie_denumire from institutii where id = new.sa_institutie),
                                    new.sa_data_cerere,
                                    NULL);
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
        Schema::dropIfExists('solicitari_acces');
    }
}
