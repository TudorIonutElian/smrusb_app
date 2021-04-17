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
        Schema::create('istoric_contracte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ic_angajat');
            $table->integer('ic_tip_contract');
            $table->integer('ic_data_contract');
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
