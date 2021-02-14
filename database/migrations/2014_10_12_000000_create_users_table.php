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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('isAdmin')->default(false);
            $table->unsignedSmallInteger('regiune')->nullable();
            $table->unsignedSmallInteger('judet')->nullable();
            $table->unsignedSmallInteger('localitate')->nullable();
            $table->unsignedSmallInteger('strada')->nullable();
            $table->integer('numar')->nullable();
            $table->integer('bloc')->nullable();
            $table->string('scara', 3)->nullable();
            $table->integer('etaj')->nullable();
            $table->integer('apartament')->nullable();
            $table->integer('cod_postal')->nullable();
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
