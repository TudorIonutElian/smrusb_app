<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuprinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_cuprins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sc_institutie')->nullable();
            $table->string('sc_denumire');
            $table->unsignedInteger('sc_ordine');

            $table->foreign('sc_institutie', 'fk_cuprins_institutie')->references('id')->on('institutii');
            $table->unique(['sc_institutie', 'sc_denumire']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuprins');
    }
}
