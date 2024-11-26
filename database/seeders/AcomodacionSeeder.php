<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acomodacion;

class AcomodacionSeeder extends Seeder
{
    public function run()
    {
        Acomodacion::create(['nombre' => 'Sencilla', 'descripcion' => 'Acomodación sencilla']);
        Acomodacion::create(['nombre' => 'Doble', 'descripcion' => 'Acomodación doble']);
        Acomodacion::create(['nombre' => 'Triple', 'descripcion' => 'Acomodación triple']);
        Acomodacion::create(['nombre' => 'Cuádruple', 'descripcion' => 'Acomodación cuádruple']);
    }
}
