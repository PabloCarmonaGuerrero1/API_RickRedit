<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        // Obtener un usuario por ID
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'idicon' => 'nullable',
            'num_comments' => 'integer',
            'comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Crear un nuevo usuario
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'num_comments' => 'integer',
            'comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Actualizar un usuario por ID
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        // Eliminar un usuario por ID
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
