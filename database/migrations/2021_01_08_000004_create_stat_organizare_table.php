<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatOrganizareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_organizare', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('so_institutie_id');
            $table->integer('so_numar_posturi_aprobate');
            $table->bolean('so_status');

            $table->foreign('so_institutie_id', 'fk_stat_institutie')->references('id')->on('institutii')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stat_organizare');
    }
}
