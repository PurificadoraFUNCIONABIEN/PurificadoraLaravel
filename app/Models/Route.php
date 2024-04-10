<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public function cars(){
        return $this->belongsToMany(Car::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
