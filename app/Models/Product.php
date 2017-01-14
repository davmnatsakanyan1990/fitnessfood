<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
