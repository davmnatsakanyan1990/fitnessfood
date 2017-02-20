<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('trainer_id')->unsigned();
            $table->tinyInteger('percent')->default(5);
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
        Schema::drop('promo_codes');
    }
}
