<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function rutas(): BelongsTo
    {
        return $this->belongsTo(Ruta::class);
    }

    public function clientes(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
