<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'Permiso_rol');
    }
}
