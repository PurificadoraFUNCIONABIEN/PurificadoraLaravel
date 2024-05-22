<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable; // Importa el trait Notifiable
class Driver extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    public function cars(){
        return $this->belongsToMany(Car::class, 'car_drivers', 'driver_id', 'car_id');
    }
    protected $fillable = [
        
        'license'
    ];
}
