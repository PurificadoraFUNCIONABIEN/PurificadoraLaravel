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
        $validatedData = $request->validate([
            'name',
            'license',
        ]);

        Driver::create($validatedData);
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);


        $driver->name = $request->input('name');
        $driver->license = $request->input('license');
        $driver->save();

        return response()->json('Conductor actualizado correctamente');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->noContent();
    }

    public function createDriver(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'name' => 'required|string',
            'license' => 'required|string',
        ]);

        // Crear un nuevo conductor
        $driver = new Driver();
        $driver->name = $validatedData['name'];
        $driver->license = $validatedData['license'];
        $driver->save();

        return response()->json(['message' => 'Conductor creado exitosamente'], 201);
    }
}
