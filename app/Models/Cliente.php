<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class);
    }
}
