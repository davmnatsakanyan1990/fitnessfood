<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'status'
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumb_image(){
        return $this->morphOne(Image::class, 'imageable')->where('role', 1);
    }
}
