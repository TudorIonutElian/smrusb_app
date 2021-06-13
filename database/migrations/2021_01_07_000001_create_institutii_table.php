<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInstitutiiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutii', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institutie_minister_id');
            $table->string('institutie_denumire', 100);
            $table->boolean('institutie_este_ordonator')->default(false);
            $table->unsignedBigInteger('institutie_ordonator_id')->nullable();
            $table->dateTime('institutie_data_creare')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('institutie_cod_acces');
            $table->boolean('institutie_este_activa')->default(true);

            $table->foreign('institutie_minister_id')->references('id')->on('ministere')->onDelete('cascade');
            $table->foreign('institutie_ordonator_id')->references('id')->on('institutii')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('institutii', function (Blueprint $table){
             $table->dropForeign('institutii_institutie_minister_id_foreign');
             $table->dropForeign('institutii_institutie_ordonator_id_foreign');
         });
        Schema::dropIfExists('institutii');
    }
}
