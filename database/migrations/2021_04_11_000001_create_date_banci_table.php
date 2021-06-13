<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateBanciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_banci', function (Blueprint $table) {
            $table->id();
            $table->string('db_denumire', 100);
            $table->dateTime('db_daca_creare')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('db_status');
            $table->date('db_daca_radiere')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date_banci');
    }
}
