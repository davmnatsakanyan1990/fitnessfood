<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'trainer_percent',
        'min_amount_free_shipping',
        'shipping_price'
    ];
}
