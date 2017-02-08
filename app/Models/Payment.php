<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'trainer_id',
        'amount', 
        'note',
        'status',
        'is_seen'
    ];

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    public function sender(){
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
