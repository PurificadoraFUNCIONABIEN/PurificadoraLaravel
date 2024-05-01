<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Carboy extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    public function carboyTypes(){
        return $this->belongsTo(CarboyType::class);
    }

}
