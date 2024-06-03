<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carboy;
use App\Models\CarboyType;
use Illuminate\Support\Str;

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

    public function update(Request $request, $id)
    {
        $driver = Carboy::findOrFail($id);


        $driver->state = $request->input('state');
        $driver->color = $request->input('color');
        $driver->cantidad = $request->input('cantidad');
        $driver->save();

        return response()->json('Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $carboy = Carboy::findOrFail($id);
        $carboy->delete();
        return response()->json(['success' => 'Producto eliminado correctamente']);
    }

    public function createCarboy(Request $request)
    {
        $validatedData = $request->validate([
            'color' => 'required|string',
            'state' => 'required|in:nuevo,seminuevo,buen estado,dañado,roto',
            'cantidad' => 'required|numeric',
            'carboyType_id' => 'required|exists:carboy_types,id',
            'img' => 'nullable|string'

        ]);
        $carboy = new Carboy();
        $carboy->color = $validatedData['color'];
        $carboy->state = $validatedData['state'];
        $carboy->cantidad = (float)$validatedData['cantidad'];
        $carboy->carboyType_id = $validatedData['carboyType_id'];;
        if ($request->has('img')) {
            // Decodificar la imagen base64
            $imgData = $request->input('img');
            $imgData = substr($imgData, strpos($imgData, ',') + 1); // Eliminar el encabezado data:image/png;base64,
            $imgData = base64_decode($imgData);

            // Generar un nombre único para la imagen
            $imageName = Str::random(10) . '.png';

            // Guardar la imagen en la carpeta public
            file_put_contents(public_path('botes/' . $imageName), $imgData);

            // Asignar la ruta completa de la imagen al usuario
            $carboy->img = url('botes/' . $imageName);
        }
       
        $carboy->save();

        return response()->json(['message' => 'Producto creado exitosamente'], 201);
    }


    public function getA()
    {
        $datos = Carboy::with('carboyTypes')->get();

        return response()->json($datos);
    }



    public function obtenerLlaveForanea($driverId)
    {
        // Obtener el modelo Carboy por su ID
        $carboy = Carboy::findOrFail($driverId);

        // Acceder al atributo carboyType_id
        $carboyTypeId = $carboy->carboyType_id;

        return response()->json($carboyTypeId);
    }
}
