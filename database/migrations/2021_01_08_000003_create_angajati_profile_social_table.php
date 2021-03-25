<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngajatiProfileSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angajati_profile_social', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aps_angajat')->nullable()->unique();
            $table->string('aps_facebook')->nullable()->unique();
            $table->string('aps_twitter')->nullable()->unique();
            $table->string('aps_google_plus')->nullable()->unique();
            $table->string('aps_youtube')->nullable()->unique();

            $table->foreign('aps_angajat', 'fk_aps_angajat')->references('id')->on('angajati')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angajati_profile_social');
    }
}
