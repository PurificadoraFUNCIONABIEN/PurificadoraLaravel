<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pedidos;
use App\Models\Carboy;
use Illuminate\Support\Facades\Auth;
use App\Models\CarboyType;

class pedidosController extends Controller
{
    public function index()
    {
        $pedidos = pedidos::with('carboys')->get();
        return response()->json($pedidos);
    }

    public function show($id)
    {
        $pedido = pedidos::with('carboys')->findOrFail($id);
        return response()->json($pedido);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'direccion_envio' => 'required|string',
            'productos' => 'required|array',
            'productos.*.carboy_id' => 'required|exists:carboys,id',
            'productos.*.cantidad' => 'required|integer',
        ]);
    
        $pedido = pedidos::create([
            'user_id' => $user->id,
            'direccion_envio' => $validated['direccion_envio'],
            'estado' =>"pendiente",
        ]);
    
        foreach ($validated['productos'] as $producto) {
            // Encontrar el carboy usando el carboy_id
            $carboy = Carboy::find($producto['carboy_id']);
            if ($carboy) {
                // Obtener el carboyType_id relacionado
                    // Restar la cantidad de capacity
                    if ($carboy->cantidad - $producto['cantidad'] >= 0) {

                    $carboy->cantidad -= $producto['cantidad'];
                    $carboy->save();
                    }
                    else{
                        return response()->json(['error' => 'Cantidad insuficiente en el inventario'], 400);
                    }
                
            }
    
            // Adjuntar el carboy al pedido con la cantidad especificada
            $pedido->carboys()->attach($producto['carboy_id'], ['cantidad' => $producto['cantidad']]);
        }
    
        return response()->json($pedido->load('carboys'), 201);
    }

    public function update(Request $request, $id)
    { 
        
    $validated = $request->validate([
        'direccion_envio' => 'string',
        'estado' => 'string',
        'productos' => 'array',
        'productos.*.carboy_id' => 'exists:carboys,id',
        'productos.*.cantidad' => 'integer',
    ]);

    $pedido = pedidos::findOrFail($id);
    $pedido->update([
        'direccion_envio' => $validated['direccion_envio'] ?? $pedido->direccion_envio,
        'estado' => $validated['estado'] ?? $pedido->estado,
    ]);

    if (isset($validated['productos'])) {
        foreach ($validated['productos'] as $producto) {
            $carboyId = $producto['carboy_id'];
            $cantidadAnterior = $pedido->carboys()->where('carboy_id', $carboyId)->first()->pivot->cantidad ?? 0;
            $diferencia = $producto['cantidad'] - $cantidadAnterior;
            
            if ($diferencia != 0) {
                $carboy = Carboy::findOrFail($carboyId);
                // Si la cantidad nueva es mayor que la anterior, restamos la diferencia al carboy
                if ($producto['cantidad'] > $cantidadAnterior) {
                    $carboy->decrement('cantidad', abs($diferencia));
                } 
                // Si la cantidad nueva es menor que la anterior, sumamos la diferencia al carboy
                elseif ($producto['cantidad'] < $cantidadAnterior) {
                    $carboy->increment('cantidad', abs($diferencia));
                }
            }

            // Actualizar la cantidad en el pedido
            $pedido->carboys()->updateExistingPivot($carboyId, ['cantidad' => $producto['cantidad']]);
        }
    }

    return response()->json($pedido->load('carboys'));
    }

    public function destroy($id)
    {
        $pedido = pedidos::findOrFail($id);
        $pedido->carboys()->detach();
        $pedido->delete();
        return response()->json(null, 204);
    }
}
