<?php

namespace App\Models;

use App\Models\PromoCode;
use Illuminate\Database\Eloquent\Model;

class CardOrder extends Model
{
    protected $fillable = [
        'promo_code_id',
        'count',
        'is_seen'
    ];

    public function promo_code(){
        return $this->belongsTo(PromoCode::class);
    }
}
