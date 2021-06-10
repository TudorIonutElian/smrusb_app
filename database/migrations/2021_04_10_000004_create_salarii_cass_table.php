<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariiCassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarii_cass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sc_salariu_id');
            $table->unsignedBigInteger('sc_institutie');
            $table->unsignedBigInteger('sc_angajat');
            $table->integer('sc_suma');
            $table->double('sc_cass', '4', '2');
            $table->boolean('sc_achitat')->default(false);
            $table->date('sc_start_date')->nullable();
            $table->date('sc_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarii_cass');
    }
}
