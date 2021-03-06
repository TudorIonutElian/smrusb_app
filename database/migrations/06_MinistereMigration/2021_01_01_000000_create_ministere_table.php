<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMinistereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministere', function (Blueprint $table) {
            $table->id();
            $table->string('minister_denumire', 100);
            $table->date('minister_data_creare')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('minister_is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministere');
    }
}
