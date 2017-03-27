<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(TrainersTableSeeder::class);
//         $this->call(ProductsTableSeeder::class);
         $this->call(AdminsTableSeeder::class);
//         $this->call(OrdersTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
        // $this->call(GymTableSeeder::class);
         $this->call(PagesTableSeeder::class);
         $this->call(SubPagesSeeder::class);
    }
}
