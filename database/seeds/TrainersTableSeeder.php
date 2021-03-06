<?php

use App\Models\PromoCode;
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
            ['name'=>'trainer 1', 'email'=>'trainer1@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['name'=>'trainer 2', 'email'=>'trainer2@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['name'=>'trainer 3', 'email'=>'trainer3@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')],
            ['name'=>'trainer 4', 'email'=>'trainer4@gmail.com', 'address' => ' Yerevan Adonc 2', 'phone'=>'098765124',  'date_of_birth'=>'1990-12-18',  'password'=>bcrypt('123456')]
        ]);

        $trainers = Trainer::all();
        foreach ($trainers as $trainer){
            $this->generatePromoCode($trainer->id);
        }
    }

    public function generatePromoCode($trainer_id){
        $code = rand(1000, 9999);
        $obj = PromoCode::where('code', $code)->first();

        if($obj){
            $this->generatePromoCode($trainer_id);
        }
        else{
            PromoCode::create([
                'code' => $code,
                'trainer_id' => $trainer_id
            ]);
        }
    }
}
