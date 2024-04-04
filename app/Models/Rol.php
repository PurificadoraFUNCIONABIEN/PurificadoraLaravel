<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permiso::class, 'Permiso_rol');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'Rol_User');
    }
}
