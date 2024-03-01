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
        $users = User::all();
        return response()->json($users);
    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $friendsList = json_decode($user->friends_list);

        return response()->json([
            'username' => $user->username,
            'password' => $user->password,
            'idicon' => $user->idicon,
            'num_coments' => $user->num_coments,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'idicon' => 'nullable',
            'num_comments' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $username)
    {

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'idicon' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        if ($request->has('idicon')) {
            $user->idicon = $request->input('idicon');
            $user->save();
        }

        return response()->json($user, 200);
    }
}
