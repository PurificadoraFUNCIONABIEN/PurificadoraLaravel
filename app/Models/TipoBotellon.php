<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBotellon extends Model
{
    use HasFactory;

    public function garrafones(){
        return $this->hasMany(Garrafon::class);
    }

    public function pedidos(){
        return $this->belongsToMany(Pedido::class);
    }
}
