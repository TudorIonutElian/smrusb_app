<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatiCassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plati_cass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pc_salariu');
            $table->double('pc_taxa', '4', '2');
            $table->double('pc_valoare', '5', '2');
            $table->date('pc_data_generarii')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('pc_data_platii')->nullable();
            $table->integer('pc_numar_zile')->nullable();
            $table->boolean('pc_platit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plati_cass');
    }
}
