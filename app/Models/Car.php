<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function routes(){
        return $this->belongsToMany(Route::class);
    }

    public function drivers(){
        return $this->belongsToMany(Driver::class, 'car_drivers', 'driver_id', 'car_id');
    }

}
