<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(): JsonResponse
    {
        $hotels = Hotel::all();

        if ($hotels->isEmpty()) {
            return response()->json(['message' => 'No se han encontrado hoteles'], 200);
        }

        return response()->json(['hotels' => $hotels], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|unique:hotels',
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required|unique:hotels',
            'num_habitaciones' => 'required|integer',
        ]);

        $hotel = Hotel::create($request->all());

        return response()->json(['message' => 'Hotel registrado exitosamente', 'hotel' => $hotel], 201);
    }

    public function show($id): JsonResponse
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        return response()->json(['hotel' => $hotel], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        $hotel->update($request->all());

        return response()->json(['message' => 'Hotel actualizado correctamente'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        $hotel->delete();

        return response()->json(['message' => 'Hotel eliminado correctamente'], 200);
    }
}
