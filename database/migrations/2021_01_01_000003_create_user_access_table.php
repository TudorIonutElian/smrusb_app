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
            $table->dateTime('ua_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('ua_end_date')->nullable();
            $table->boolean('ua_status')->default(false);

            $table->foreign('ua_user', 'ua_user')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['ua_user', 'ua_level'], 'ua_user_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_access');
    }
}
