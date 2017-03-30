<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_trainer_id_foreign');

            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });

        Schema::table('card_orders', function (Blueprint $table) {
            $table->dropForeign('card_orders_promo_code_id_foreign');

            $table->foreign('promo_code_id')->references('id')->on('promo_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
