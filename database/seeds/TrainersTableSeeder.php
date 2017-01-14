<?php

use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainers')->insert(
            ['name'=>'trainer 1', 'username' => 'trainer1', 'password'=>bcrypt('123456')],
            ['name'=>'trainer 2', 'username' => 'trainer2', 'password'=>bcrypt('123456')],
            ['name'=>'trainer 3', 'username' => 'trainer3', 'password'=>bcrypt('123456')],
            ['name'=>'trainer 4', 'username' => 'trainer4', 'password'=>bcrypt('123456')]
        );

    }
}
