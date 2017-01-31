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
        DB::table('trainers')->insert([
            ['first_name'=>'trainer 1', 'last_name' => 'trainer 1', 'email'=>'trainer1@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['first_name'=>'trainer 2', 'last_name' => 'trainer 2', 'email'=>'trainer2@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['first_name'=>'trainer 3', 'last_name' => 'trainer 3', 'email'=>'trainer3@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['first_name'=>'trainer 4', 'last_name' => 'trainer 4', 'email'=>'trainer4@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],

        ]);

    }
}
