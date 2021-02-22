<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalitatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localitati', function (Blueprint $table) {
            $table->id();
            $table->string('denumire', 70);
            $table->unsignedBigInteger('judet');
            $table->boolean('urban')->default(false);
            $table->boolean('resedinta')->default(false);
            $table->boolean('stare')->default(true);

            $table->foreign('judet')->references('id')->on('judete')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('localitati', function (Blueprint $table){
            $table->dropForeign('localitati_judet_foreign');
        });
        Schema::dropIfExists('localitati');
    }
}
