<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecompenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recompense', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('r_angajat_id');
            $table->unsignedBigInteger('r_recompensa_id');
            $table->date('r_data_acordarii');
            $table->date('r_data_expirarii')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recompense');
    }
}
