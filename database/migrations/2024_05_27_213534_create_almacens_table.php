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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('street', 150)->nullable();
            $table->string('zip_code', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('municipality', 150)->nullable();
            $table->string('no_exterior', 150)->nullable();
            $table->string('no_interior', 150)->nullable();
            $table->text('details')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacens');
    }
};
