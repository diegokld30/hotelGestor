<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\TipoHabitacion;
use App\Models\Acomodacion;
use App\Models\HotelTipoAcomodacion;

class HotelTipoAcomodacionSeeder extends Seeder
{
    public function run()
    {
        $hotel = Hotel::first(); // Asumiendo que tienes al menos un hotel

        $estandar = TipoHabitacion::where('nombre', 'ESTÁNDAR')->first();
        $junior = TipoHabitacion::where('nombre', 'JUNIOR')->first();

        $sencilla = Acomodacion::where('nombre', 'SENCILLA')->first();
        $doble = Acomodacion::where('nombre', 'DOBLE')->first();
        $triple = Acomodacion::where('nombre', 'TRIPLE')->first();

        HotelTipoAcomodacion::create([
            'hotel_id' => $hotel->id,
            'tipo_habitacion_id' => $estandar->id,
            'acomodacion_id' => $sencilla->id,
            'cantidad_maxima' => 25,
        ]);

        HotelTipoAcomodacion::create([
            'hotel_id' => $hotel->id,
            'tipo_habitacion_id' => $junior->id,
            'acomodacion_id' => $triple->id,
            'cantidad_maxima' => 12,
        ]);

        HotelTipoAcomodacion::create([
            'hotel_id' => $hotel->id,
            'tipo_habitacion_id' => $estandar->id,
            'acomodacion_id' => $doble->id,
            'cantidad_maxima' => 5,
        ]);
    }
}
