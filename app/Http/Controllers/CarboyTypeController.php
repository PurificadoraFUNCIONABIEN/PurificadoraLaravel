<?php

namespace App\Http\Controllers;

use App\Models\CarboyType;
use Illuminate\Http\Request;

class CarboyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return CarboyType::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CarboyType $carboyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $driver = CarboyType::findOrFail($id);


        $driver->capacity = $request->input('capacity');
        $driver->price = $request->input('price');
        $driver->save();

        return response()->json('Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carboy = CarboyType::findOrFail($id);
        $carboy->delete();
        return response()->json(['success' => 'Producto eliminado correctamente']);
    }

    public function createCarboyType(Request $request)
    {
        $validatedData = $request->validate([

            'capacity' => 'required|numeric',
            'price' => 'required|numeric',

        ]);

        $carboy = new CarboyType();
        $carboy->capacity = (float)$validatedData['capacity'];
        $carboy->price = (float)$validatedData['price'];
        $carboy->save();

        return response()->json(['id' => $carboy->id,'message' => 'Producto creado exitosamente'], 201);
    }
}
