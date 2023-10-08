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
        Schema::create('developers', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->id();
//            $table->string('id', 36)->primary();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('price_per_hour')->nullable();
            $table->string('technology')->nullable();
            $table->string('description')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('native_language')->nullable();
            $table->string('linkedin_profile_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');
    }
};
