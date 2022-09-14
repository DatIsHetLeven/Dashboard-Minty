<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('userId');
            $table->varchar('email');
            $table->varchar('naam');
            $table->varchar('password');
            $table->int('telefoonnummer');
            $table->varchar('bedrijfsnaam');
            $table->varchar('btwNummer');
            $table->varchar('adres');
            $table->varchar('postcode');
            $table->varchar('plaats');
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
};
