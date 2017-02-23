<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gyms')->insert([
            ['name' => 'Gold Gym'],
            ['name' => 'Orange Gym'],
            ['name' => 'Grant Gym'],

        ]);
    }
}
