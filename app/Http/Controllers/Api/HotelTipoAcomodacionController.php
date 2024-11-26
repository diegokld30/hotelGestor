<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelTipoAcomodacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelTipoAcomodacionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotel,id',
            'tipo_habitacion_id' => 'required|exists:tipo_habitaciones,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'cantidad_maxima' => 'required|integer|min:1',
        ]);

        $hotelTipoAcomodacion = HotelTipoAcomodacion::create($request->all());

        return response()->json(['message' => 'Combinación de tipo de habitación y acomodación registrada correctamente', 'hotel_tipo_acomodacion' => $hotelTipoAcomodacion], 201);
    }
}
