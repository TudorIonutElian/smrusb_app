<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('user_first_name');
            $table->string('user_last_name');
            $table->string('user_email')->unique();
            $table->string('user_username');
            $table->string('user_password');
            $table->rememberToken();
            $table->boolean('user_is_active')->default(false)->nullable();
            $table->unsignedBigInteger('user_type')->nullable();
            $table->unsignedInteger('user_cod_acces')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
