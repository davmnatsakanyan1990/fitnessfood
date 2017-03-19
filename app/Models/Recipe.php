<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'text'
    ];

    public function profile_image(){
        return $this->morphOne(Image::class, 'imageable')->where('role', 1);
    }
}
