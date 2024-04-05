<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;

    public function carros(): BelongsToMany
    {
        return $this->belongsToMany(Carro::class, 'CarroConductor', 'idConductor', 'idCarro');
    }
}
