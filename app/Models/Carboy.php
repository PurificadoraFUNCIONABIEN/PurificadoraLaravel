<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Carboy extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    public function carboyTypes(){
        return $this->belongsTo(CarboyType::class,'carboyType_id');
    }
    public function pedidos()
    {
        return $this->belongsToMany(pedidos::class, 'pedido_producto')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
