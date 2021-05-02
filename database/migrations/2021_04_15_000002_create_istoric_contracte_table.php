<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIstoricContracteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_angajat')->unique();
            $table->integer('c_tip_contract');
            $table->date('c_data_incepere_contract');
            $table->date('c_data_incetare_contract')->nullable();
            $table->boolean('c_stare_contract');
            $table->integer('c_zile_contract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('istoric_contracte');
    }
}
