<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'trainer_percent',
        'min_amount_free_shipping',
        'shipping_price',
        'min_payment_amount',
        'wrk_hr_from',
        'wrk_hr_to'
    ];
}
