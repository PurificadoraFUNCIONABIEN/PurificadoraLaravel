<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carboy;
class CarboyController extends Controller
{
    
    public function index()
    {
        return Carboy::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'carboyType_id' => 'required|exists:carboy_types,id',
            'state' => 'required|string|in:new,pre-owned,in good state,damaged,broken',
            'color' => 'required|string|max:255',
        ]);
        
        return Carboy::create($validated);
    }

    public function show(Carboy $carboy)
    {
        return $carboy;
    }

    public function update(Request $request, Carboy $carboy)
    {
        $validated = $request->validate([
            'carboyType_id' => 'exists:carboy_types,id',
            'state' => 'string|in:new,pre-owned,in good state,damaged,broken',
            'color' => 'string|max:255',
        ]);
        
        $carboy->update($validated);
        return $carboy;
    }

    public function destroy(Carboy $carboy)
    {
        $carboy->delete();
        return response()->noContent();
    }
}
