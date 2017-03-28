<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::first();

        if($admin){

            Admin::where('id', $admin->id)->update(['username' => env('ADMIN_USERNAME'), 'password' => bcrypt(env('ADMIN_PASSWORD'))]);
        }
        else{

            Admin::create(['name' => 'Admin', 'username' => env('ADMIN_USERNAME'), 'password' => bcrypt(env('ADMIN_PASSWORD'))]);
        }
    }
}
