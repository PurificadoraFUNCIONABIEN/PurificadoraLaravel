<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'number_liters' => 'required|numeric',
            'state' => 'required|string|in:stateless,on hold,attending to the order,on the way,order delivered',
        ]);
        
        return Order::create($validated);
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'route_id' => 'exists:routes,id',
            'customer_id' => 'exists:customers,id',
            'order_date' => 'date',
            'number_liters' => 'numeric',
            'state' => 'string|in:stateless,on hold,attending to the order,on the way,order delivered',
        ]);
        
        $order->update($validated);
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
