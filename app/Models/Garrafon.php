<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garrafon extends Model
{
    use HasFactory;

    public function tipobotellon(){
        return $this->belongsTo(TipoBotellon::class);
    }
}
