<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudeteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judete', function (Blueprint $table) {
            $table->id();
            $table->string('denumire', 30);
            $table->unsignedBigInteger('regiune');
            $table->boolean('stare')->default(true);
            $table->date('data_creare')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('regiune')->references('id')->on('regiuni')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('judete', function (Blueprint $table){
            $table->dropForeign('judete_regiune_foreign');
        });
        Schema::dropIfExists('judete');
    }
}
