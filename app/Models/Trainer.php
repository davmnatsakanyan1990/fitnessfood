<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'phone',
        'gym_id',
        'workplace',
        'date_of_birth',
        'username',
        'password',
        'is_approved',
        'is_seen'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'trainers';
    
    public function orders(){
        return $this->hasMany(Order::class)->where('status', 1);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
