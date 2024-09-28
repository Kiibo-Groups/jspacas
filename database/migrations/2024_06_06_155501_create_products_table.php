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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('almacen_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('unit',150);
            $table->string('weight',150);
            $table->string('minimum_amount', 150);
            $table->string('image',150);

            $table->string('barcode',150)->nullable();
            $table->string('labels',150)->nullable();
            $table->text('meta')->nullable();
            $table->text('description');
            $table->integer('featured')->default(0);
            $table->integer('offer')->default(0);
            $table->string('flash',150);
            $table->string('discount',150);
            $table->double('discount_rate', 15,2);
            $table->double('taxes', 15,2);
            $table->double('price', 15,2);

            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('almacen_id')->references('id')->on('almacens');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
