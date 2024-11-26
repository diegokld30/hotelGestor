<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoHabitacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoHabitacionController extends Controller
{
    public function index(): JsonResponse
    {
        $tiposHabitacion = TipoHabitacion::all();

        return response()->json(['tipos_habitacion' => $tiposHabitacion], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|unique:tipo_habitaciones',
            'descripcion' => 'nullable',
        ]);

        $tipoHabitacion = TipoHabitacion::create($request->all());

        return response()->json(['message' => 'Tipo de habitación creado', 'tipo_habitacion' => $tipoHabitacion], 201);
    }

    public function show($id): JsonResponse
    {
        $tipoHabitacion = TipoHabitacion::find($id);

        if (!$tipoHabitacion) {
            return response()->json(['message' => 'Tipo de habitación no encontrado'], 404);
        }

        return response()->json(['tipo_habitacion' => $tipoHabitacion], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $tipoHabitacion = TipoHabitacion::find($id);

        if (!$tipoHabitacion) {
            return response()->json(['message' => 'Tipo de habitación no encontrado'], 404);
        }

        $tipoHabitacion->update($request->all());

        return response()->json(['message' => 'Tipo de habitación actualizado'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $tipoHabitacion = TipoHabitacion::find($id);

        if (!$tipoHabitacion) {
            return response()->json(['message' => 'Tipo de habitación no encontrado'], 404);
        }

        $tipoHabitacion->delete();

        return response()->json(['message' => 'Tipo de habitación eliminado'], 200);
    }
}


