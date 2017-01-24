<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            ['customer_name' => 'Jon', 'trainer_id' => 1, 'created_at' => date("Y-m-d H:i:s")],
            ['customer_name' => 'Mark', 'trainer_id' => 1,  'created_at' => date("Y-m-d H:i:s")],
            ['customer_name' => 'Anton', 'trainer_id' => 1,  'created_at' => date("Y-m-d H:i:s")]
        ]);

        DB::table('order_products')->insert([
            ['order_id' => 1, 'product_id' => 1, 'count' => 2],
            ['order_id' => 1, 'product_id' => 2, 'count' => 2],
            ['order_id' => 1, 'product_id' => 3, 'count' => 2],
            ['order_id' => 2, 'product_id' => 3, 'count' => 2],
            ['order_id' => 2, 'product_id' => 5, 'count' => 2],
            ['order_id' => 2, 'product_id' => 4, 'count' => 2],
            ['order_id' => 3, 'product_id' => 1, 'count' => 2],
            ['order_id' => 3, 'product_id' => 2, 'count' => 2],
        ]);

    }
}
