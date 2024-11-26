<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHabitacionRequest;
use App\Models\Habitacion;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

class HabitacionController extends Controller
{
    public function store(StoreHabitacionRequest $request): JsonResponse
    {
        $habitacion = Habitacion::create($request->validated());

        return response()->json([
            'message' => 'Configuración de habitación registrada correctamente',
            'habitacion' => $habitacion,
        ], 201);
    }

    public function getHabitacionesPorHotel($hotel_id): JsonResponse
    {
        // Verificar si el hotel existe
        $hotel = Hotel::find($hotel_id);

        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel no encontrado.',
            ], 404);
        }

        // Obtener las configuraciones de habitaciones del hotel
        $habitaciones = Habitacion::where('hotel_id', $hotel_id)
            ->with('tipoHabitacion', 'acomodacion')
            ->get();

        if ($habitaciones->isEmpty()) {
            return response()->json([
                'message' => 'No hay configuraciones de habitaciones registradas para este hotel.',
            ], 200);
        }

        return response()->json([
            'hotel' => $hotel->nombre,
            'habitaciones' => $habitaciones,
        ], 200);
    }



}
