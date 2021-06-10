<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariiImpoziteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarii_impozite', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('si_institutie');
            $table->unsignedBigInteger('si_angajat');
            $table->integer('si_suma');
            $table->integer('si_impozit');
            $table->boolean('si_achitat');
            $table->date('si_data_achitarii');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarii_impozite');
    }
}
