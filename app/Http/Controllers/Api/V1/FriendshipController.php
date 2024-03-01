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
    
    
        $friendship = Friendship::create([
            'username' => $request->input('username'),
            'username_friend' => $request->input('username_friend'),
        ]);    
    }    
    public function show($username = null, $friendUsername = null)
    {
        if ($username === null) {
            
            return response()->json(['error' => 'Se requiere un nombre de usuario.'], 400);
        }
    
        if ($friendUsername === null) {
            
            $friendships = Friendship::where('username', $username)->get();
        } else {

            $friendship = Friendship::where('username', $username)
                ->where('username_friend', $friendUsername)
                ->first();
    
            if (!$friendship) {
                return response()->json(['error' => 'La amistad no fue encontrada.'], 404);
            }
    

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