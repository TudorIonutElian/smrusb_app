<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctiiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functii', function (Blueprint $table) {
            $table->id();
            $table->string('functie_denumire');
            $table->char('functie_nivel_studii');
            $table->unsignedInteger('functie_nivel_vechime')->nullable();
            $table->unsignedInteger('functie_grad_prevazut')->nullable();
            $table->decimal('functie_coeficient', '4', '2');
            $table->unsignedInteger('functie_suma');
            $table->boolean('functie_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functii');
    }
}
