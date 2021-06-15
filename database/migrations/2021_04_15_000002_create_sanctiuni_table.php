<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanctiuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanctiuni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_angajat_id');
            $table->unsignedBigInteger('s_sanctiune_id');
            $table->date('s_data_acordarii');
            $table->date('s_data_expirarii')->nullable();
            $table->boolean('s_status')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanctiuni');
    }
}
