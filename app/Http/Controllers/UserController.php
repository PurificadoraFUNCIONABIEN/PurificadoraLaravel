<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Validator;

use Laravel\Passport\Token;
use Symfony\Component\Console\Logger\ConsoleLogger;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request, User $user)
    {

        $rules = [
            'name' => 'required|string|min:1|max:20',
            'email' => 'required|email',
            'password' => 'required'
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->input(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        // Verificar si el correo electrónico ya está registrado
        $existingUser = User::where('email', $request->input('email'))->first();
    
        if ($existingUser) {
            return response()->json([
                'status' => false,
                'message' => 'El correo electrónico ya está registrado.'
            ], 400);
        }
    
        // Crear un nuevo usuario si el correo electrónico no está registrado
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Usuario creado exitosamente',
        ], 200);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'User logged successfully',
            'token' => $user->createToken('api-token')->plainTextToken
        ], 200);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully',
        ], 200);
    }

    public function show(User $user)
    {
        return response()->json(['status' => true, 'data' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no actualizado'], 404);
        }


        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));


        $user->save();


        return response()->json(['message' => 'Usuario actualizado'], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado'], 200);
    }

    public function validarcorreo(Request $request, User $user)
    {

        // Valida los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Obtiene el correo electrónico y la contraseña del formulario
        $email = $request->input('email');
        $password = $request->input('password');

        // Busca un usuario con el correo electrónico proporcionado en la base de datos
        $user = User::where('email', $email)->first();

        // Verifica si se encontró un usuario y si la contraseña es correcta
        if ($user && password_verify($password, $user->password)) {
            //return $user;
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken('api-token')->plainTextToken,
                'email'=>$email
            ], 200);
        } else {
            return response()->json(['message' => 'Correo electrónico o contraseña incorrectos'], 400);
        }
    }
}