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
        Schema::create('cuprins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_institutie')->nullable();
            $table->string('c_denumire');

            $table->foreign('c_institutie', 'fk_cuprins_institutie')->references('id')->on('institutii');
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
