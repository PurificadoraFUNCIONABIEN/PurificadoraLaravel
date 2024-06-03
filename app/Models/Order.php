<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Order extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function carboyTypes(){
        return $this->belongsToMany(CarboyType::class, 'carboy_orders', 'order_id', 'carboyType_id');
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

}
