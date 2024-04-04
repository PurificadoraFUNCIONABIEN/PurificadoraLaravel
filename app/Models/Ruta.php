<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    public function carros(){
        return $this->belongsToMany(Carro::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
