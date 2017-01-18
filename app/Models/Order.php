<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'status',
        'trainer_id',
        'is_seen'
    ];
    
    public function products(){
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function counselor(){
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
}
