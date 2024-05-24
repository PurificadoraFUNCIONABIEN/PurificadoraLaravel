<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
class RouteController extends Controller
{
    public function index()
    {
        return Route::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_name' => 'required|string|max:255',
            'origin_lat' => 'required|numeric',
            'origin_lng' => 'required|numeric',
            'destination_lat' => 'required|numeric',
            'destination_lng' => 'required|numeric',
        ]);

        return Route::create($validated);
    }


    public function show(Route $route)
    {
        return $route;
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'route_name' => 'string|max:255',
            'origin_lat' => 'numeric',
            'origin_lng' => 'numeric',
            'destination_lat' => 'numeric',
            'destination_lng' => 'numeric',
        ]);

        $route->update($validated);
        return $route;
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return response()->noContent();
    }
}
