<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatePlataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_plata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dp_angajat');
            $table->string('dp_metoda', 10);
            $table->unsignedBigInteger('dp_banca')->nullable();
            $table->string('dp_iban', 24);
            $table->string('dp_moneda', 10);
            $table->string('dp_titular', 100);
            $table->date('dp_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('dp_end_date')->nullable();
            $table->boolean('dp_status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date_plata');
    }
}
