<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IconsController extends Controller
{
    public function index()
    {
        $icons = Icon::all();
        return response()->json(['icons' => $icons]);
    }

    public function show($id)
    {
        $icon = Icon::find($id);

        if (!$icon) {
            return response()->json(['error' => 'Icono no encontrado'], 404);
        }

        return response()->json(['icon' => $icon]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $icon = Icon::create($request->all());
        return response()->json(['icon' => $icon], 201);
    }
}