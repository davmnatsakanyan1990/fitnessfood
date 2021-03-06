<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'trainer_id',
        'percent',
    ];
    
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
}
