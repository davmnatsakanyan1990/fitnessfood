<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'additional_info',
        'customer_phone',
        'status',
        'trainer_id',
        'trainer_percent',
        'promo_code',
        'promo_percent',
        'is_seen'
    ];
    
    public function products(){
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('count');
    }

    public function counselor(){
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
}
