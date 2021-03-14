<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ua_user');
            $table->integer('ua_level');
            $table->string('ua_denumire')->nullable();
            $table->date('ua_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('ua_end_date')->nullable();

            $table->foreign('ua_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('user_access', function (Blueprint $table){
//            $table->dropForeign('judete_regiune_foreign');
//        });
        Schema::dropIfExists('user_access');
    }
}
