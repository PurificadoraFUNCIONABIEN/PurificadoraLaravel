<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'direccion_envio',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carboys()
    {
        return $this->belongsToMany(Carboy::class, 'pedido_producto', 'pedido_id', 'carboy_id')->withPivot('cantidad');
    }
    
}
