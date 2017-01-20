<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'trainer_id',
        'amount',
        'is_seen'
    ];

    public function sender(){
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
