<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcCalificativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dc_calificative', function (Blueprint $table) {
            $table->id();
            $table->string('dc_denumire', 30);
            $table->boolean('dc_status');
            $table->date('dc_creare')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('dc_radiere')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dc_calificative');
    }
}
