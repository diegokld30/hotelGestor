<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|unique:hotel,nombre',
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required|unique:hotel,nit',
            'num_habitaciones' => 'required|integer',
        ];
    }

    /**
     * Obtiene los mensajes de error personalizados para las reglas de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del hotel es obligatorio.',
            'nombre.unique' => 'El nombre del hotel ya existe en el sistema.',
            'nit.required' => 'El NIT del hotel es obligatorio.',
            'nit.unique' => 'El NIT del hotel ya existe en el sistema.',
            'direccion.required' => 'La dirección es obligatoria.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'num_habitaciones.required' => 'El número de habitaciones es obligatorio.',
            'num_habitaciones.integer' => 'El número de habitaciones debe ser un número entero.',
        ];
    }
}
