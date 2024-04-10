<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carboy extends Model
{
    use HasFactory;

    public function carboyTypes(){
        return $this->belongsTo(CarboyType::class);
    }

}
