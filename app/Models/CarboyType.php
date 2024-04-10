<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarboyType extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsToMany(Order::class, 'carboy_orders', 'order_id', 'carboyType_id');
    }

    public function carboys(){
        return $this->hasMany(Carboy::class);
    }

}
