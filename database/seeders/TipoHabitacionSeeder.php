<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoHabitacion;

class TipoHabitacionSeeder extends Seeder
{
    public function run()
    {
        TipoHabitacion::create(['nombre' => 'Estándar', 'descripcion' => 'Habitación estándar']);
        TipoHabitacion::create(['nombre' => 'Junior', 'descripcion' => 'Habitación junior']);
        TipoHabitacion::create(['nombre' => 'Suite', 'descripcion' => 'Habitación suite']);
    }
}
