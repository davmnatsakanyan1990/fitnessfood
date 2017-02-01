<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->enum('status', [0,1,2])->default(0);   // 0: pending;
                                                           // 1: order confirmed;
                                                           // 2: order canceled;

            $table->integer('trainer_id')->unsigned()->nullable();
            $table->double('trainer_percent')->nullable();
            $table->enum('is_shipping', [0,1]);
            $table->enum('is_seen', [0,1])->default(0);
            $table->timestamps();

            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
