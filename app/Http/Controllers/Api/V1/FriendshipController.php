<?php

namespace App\Http\Controllers\Api\V1;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;
use Illuminate\Support\Facades\Validator;

class FriendshipController extends Controller
{
    public function index()
    {
        $friendships = Friendship::all();
        return response()->json($friendships, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'username_friend' => 'required|string',
        ]);
    
        // Añadir un dd para depurar y verificar los valores antes de crear la amistad

    
        $friendship = Friendship::create([
            'username' => $request->input('username'),
            'username_friend' => $request->input('username_friend'),
        ]);    
    }    
    public function show($username = null, $friendUsername = null)
    {
        if ($username === null) {
            // Si no se proporciona un nombre de usuario, puedes devolver un error o manejarlo de alguna manera específica.
            return response()->json(['error' => 'Se requiere un nombre de usuario.'], 400);
        }
    
        if ($friendUsername === null) {
            // Si no se proporciona un nombre de amigo, se devolverán todas las amistades para el usuario dado.
            $friendships = Friendship::where('username', $username)->get();
        } else {
            // Si se proporciona el nombre de un amigo, se busca la amistad específica.
            $friendship = Friendship::where('username', $username)
                ->where('username_friend', $friendUsername)
                ->first();
    
            if (!$friendship) {
                // Puedes devolver un error si la amistad no se encuentra.
                return response()->json(['error' => 'La amistad no fue encontrada.'], 404);
            }
    
            // Devolver solo la amistad específica.
            return response()->json($friendship, 200);
        }
    
        return response()->json($friendships, 200);
    }
    public function destroy($username, $friendUsername)
    {
        $friendship = Friendship::where('username', $username)
            ->where('username_friend', $friendUsername)
            ->first();
    
        if (!$friendship) {
            return response()->json(['error' => 'La amistad no fue encontrada.'], 404);
        }
        $friendship->delete();
        return response()->json(['message' => 'Amistad eliminada exitosamente.'], 200);
    } 
}