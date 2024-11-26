<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    //nombre de la tabla que vamos a usar
    protected $table = 'hotel';
    //Campos que voy a permitir  de la tabla de forma masiva.
    protected $fillable=[
        'nombre',
        'direccion',
        'ciudad',
        'nit',
        'num_habitaciones'
    ];
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class);
    }

}
