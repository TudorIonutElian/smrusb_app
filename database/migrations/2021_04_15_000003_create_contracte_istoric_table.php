<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContracteIstoricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracte_istoric', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ci_contract');
            $table->date('ci_data_incepere');
            $table->date('ci_data_incetare');
            $table->unsignedBigInteger('ci_motiv_incetare');
            $table->text('ci_sumar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracte_istoric');
    }
}
