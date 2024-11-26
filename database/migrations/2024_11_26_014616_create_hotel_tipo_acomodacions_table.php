<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTipoAcomodacionsTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_tipo_acomodacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel');
            $table->foreignId('tipo_habitacion_id')->constrained('tipo_habitaciones');
            $table->foreignId('acomodacion_id')->constrained('acomodaciones');
            $table->integer('cantidad_maxima');
            $table->timestamps();

            // Definir la restricción única solo una vez
            $table->unique(['hotel_id', 'tipo_habitacion_id', 'acomodacion_id'], 'hotel_tipo_acomodacion_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_tipo_acomodacion');
    }
}
