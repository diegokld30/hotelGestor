<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_habitaciones';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function acomodaciones()
    {
        return $this->belongsToMany(Acomodacion::class, 'tipo_habitacion_acomodacion');
    }

    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class);
    }
}
