<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
       'trainer_id',
       'amount',
        'note'
    ];

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
}
