<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acomodacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcomodacionController extends Controller
{
    public function index(): JsonResponse
    {
        $acomodaciones = Acomodacion::all();

        return response()->json(['acomodaciones' => $acomodaciones], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|unique:acomodaciones',
            'descripcion' => 'nullable',
        ]);

        $acomodacion = Acomodacion::create($request->all());

        return response()->json(['message' => 'Acomodación creada', 'acomodacion' => $acomodacion], 201);
    }

    public function show($id): JsonResponse
    {
        $acomodacion = Acomodacion::find($id);

        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodación no encontrada'], 404);
        }

        return response()->json(['acomodacion' => $acomodacion], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $acomodacion = Acomodacion::find($id);

        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodación no encontrada'], 404);
        }

        $acomodacion->update($request->all());

        return response()->json(['message' => 'Acomodación actualizada'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $acomodacion = Acomodacion::find($id);

        if (!$acomodacion) {
            return response()->json(['message' => 'Acomodación no encontrada'], 404);
        }

        $acomodacion->delete();

        return response()->json(['message' => 'Acomodación eliminada'], 200);
    }
}
