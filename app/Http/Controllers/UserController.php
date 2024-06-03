<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Passport\Token;
use Symfony\Component\Console\Logger\ConsoleLogger;

use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
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
            'name' => 'required|string|min:1|max:200',
            'email' => 'required|email',
            'password' => 'required',
            'clave' => 'required|string'
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
    // Determinar el nombre del rol según la clave proporcionada
    $clave = $request->input('clave');
    $roleName = $clave === 'adminCreate' ? 'admin' : ($clave === 'conduCreate' ? 'conductor' : null);

// Obtener el rol existente correspondiente al nombre
$role = Role::where('name', $roleName)->first();
        // Crear un nuevo usuario si el correo electrónico no está registrado
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->save();
        $user->assignRole($role->name);


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
        $rol = $user->roles->first()->name;
        return response()->json([
            'status' => true,
            'message' => 'User logged successfully',
            'token' => $user->createToken('api-token')->plainTextToken,
            'role' => $rol
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
        // Verifica si el usuario tiene roles asignados
 
        // Verifica si se encontró un usuario y si la contraseña es correcta
        if ($user && Hash::check($password, $user->password)) {
            try {
                // Obtén los roles del usuario
                $rolAsignado = $user->getRoleNames()->first();
                $relatedRole = $user->relatedRole ? $user->relatedRole->name : null;
                return response()->json([
                    'status' => true,
                    'message' => 'User authenticated successfully',
                    'token' => $user->createToken('api-token')->plainTextToken,
                    'email' => $email,
                    'role' => $rolAsignado,
                ], 200);
            } catch (\Exception $e) {
                Log::error('Error retrieving roles: ' . $e->getMessage());
                return response()->json(['message' => 'Error retrieving roles: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Correo electrónico o contraseña incorrectos'], 400);
        }
    }
    public function verificarRol(Request $request)
{
    
    // Obtén el token de la solicitud
    $token = $request->input('token');
    if (empty($token)) {
        return response()->json(['error' => 'Token no proporcionado'], 400);
    }

    // Busca el token en la base de datos
    $accessToken = PersonalAccessToken::where('token', $token)->first();

    // Verifica si se encontró un token
    if (!$accessToken) {
        return response()->json(['error' => 'Token inválido'], 401);
    }

    // Obtén el usuario asociado al token
    $user = $accessToken->tokenable;

    // Verificar si el usuario tiene el rol deseado
    // Verificar si el usuario es administrador
    if ($user->hasRole('admin')) {
        return response()->json(['role' => 'admin', 'user' => $user], 200);
    }

    // Verificar si el usuario es conductor
    if ($user->hasRole('conductor')) {
        return response()->json(['role' => 'conductor', 'user' => $user], 200);
    }

    // Si el usuario no tiene ningún rol, puedes devolver un error o un mensaje indicando que no tiene roles asignados
    return response()->json(['error' => 'El usuario no tiene roles asignados'], 403);

}
// Dentro del modelo User



}