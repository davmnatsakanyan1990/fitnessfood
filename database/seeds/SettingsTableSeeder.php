<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'trainer_percent' => 7,
            'shipping_price' => 600,
            'min_payment_amount' => 5000,
            'min_amount_free_shipping' => 2000
        ]);
    }
}
