<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Image extends Model
{
    protected $fillable = [
        'name',
        'imageable_type',
        'imageable_id',
        'role'
    ];

    public function imageable(){
        return $this->morphTo();
    }
}
