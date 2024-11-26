<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_habitacion_id')->constrained('tipo_habitaciones');
            $table->foreignId('acomodacion_id')->constrained('acomodaciones');
            $table->foreignId('hotel_id')->constrained('hotel');
            $table->integer('cantidad')->default(1);
            $table->timestamps();

            $table->unique(['hotel_id', 'tipo_habitacion_id', 'acomodacion_id'], 'habitaciones_hotel_tipo_acomodacion_unique');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
