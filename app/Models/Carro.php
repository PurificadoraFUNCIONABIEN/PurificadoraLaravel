<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    public function rutas(){
        return $this->belongsToMany(Ruta::class);
    }

    public function conductores(): BelongsToMany
    {
        return $this->belongsToMany(Conductor::class, 'CarroConductor', 'idConductor', 'idCarro');
    }
}
