<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'nutritional_value',
        'proteins',
        'carbs',
        'fats',
        'calories',
        'weight',
        'category_id',
        'price',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumb_image(){
        return $this->morphOne(Image::class, 'imageable')->where('role', 1);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
