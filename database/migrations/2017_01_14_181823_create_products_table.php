<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title');
            $table->longText('description');
            $table->double('price', 11, 2);
            $table->double('nutritional_value', 11, 2)->nullable();
            $table->double('proteins', 11, 2)->nullable();
            $table->double('carbs', 11, 2)->nullable();
            $table->double('fats', 11, 2)->nullable();
            $table->double('calories', 11, 2)->nullable();
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
        Schema::drop('products');
    }
}
