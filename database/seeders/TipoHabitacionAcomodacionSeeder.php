<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoHabitacion;
use App\Models\Acomodacion;

class TipoHabitacionAcomodacionSeeder extends Seeder
{
    public function run()
    {
        $estandar = TipoHabitacion::where('nombre', 'Estándar')->first();
        $junior = TipoHabitacion::where('nombre', 'Junior')->first();
        $suite = TipoHabitacion::where('nombre', 'Suite')->first();

        $sencilla = Acomodacion::where('nombre', 'Sencilla')->first();
        $doble = Acomodacion::where('nombre', 'Doble')->first();
        $triple = Acomodacion::where('nombre', 'Triple')->first();
        $cuadruple = Acomodacion::where('nombre', 'Cuádruple')->first();

        // Estándar: Sencilla o Doble
        $estandar->acomodaciones()->attach([$sencilla->id, $doble->id]);

        // Junior: Triple o Cuádruple
        $junior->acomodaciones()->attach([$triple->id, $cuadruple->id]);

        // Suite: Sencilla, Doble o Triple
        $suite->acomodaciones()->attach([$sencilla->id, $doble->id, $triple->id]);
    }
}
