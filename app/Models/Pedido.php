<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function clientes(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tiposbotellones(){
        return $this->belongsToMany(TipoBotellon::class);
    }

    public function ruta(){
        return $this->belongsTo(Ruta::class);
    }
}
