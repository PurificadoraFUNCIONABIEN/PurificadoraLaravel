<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
class DriverController extends Controller
{
    public function index()
    {
        return Driver::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license' => 'required|string|max:255',
        ]);
        
        return Driver::create($validated);
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'license' => 'string|max:255',
        ]);
        
        $driver->update($validated);
        return $driver;
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->noContent();
    }
}
