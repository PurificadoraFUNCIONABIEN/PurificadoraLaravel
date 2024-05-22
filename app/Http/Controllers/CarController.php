<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //obtener todos los carros
    public function index()
    {
        //
        $cars = Car::all();
        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     */
//crear un carro
    public function store(Request $request)
    {
        //
        
        $car = new Car();
        $car->model = $request->input('model');
        $car->capacity = $request->input('capacity');
        $car->save();
        return response()->json('Carro creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //actualizar carro
    public function update(Request $request, $id)
    {

        $car = Car::findOrFail($id);


        $car->model = $request->input('model');
        $car->capacity = $request->input('capacity');
        $car->save();

        return response()->json('Carro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    //eliminar un carro
    public function destroy($id)
    {

        $car = Car::findOrFail($id);
        $car->delete();
        return response()->json(['success' => 'Carro eliminado exitosamente']);
    }
}
