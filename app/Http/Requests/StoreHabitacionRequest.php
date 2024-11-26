<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TipoHabitacion;
use App\Models\Hotel;
use App\Models\Habitacion;
use App\Models\HotelTipoAcomodacion;


class StoreHabitacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_habitacion_id' => 'required|exists:tipo_habitaciones,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'hotel_id' => 'required|exists:hotel,id',
            'cantidad' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hotelId = $this->input('hotel_id');
            $tipoHabitacionId = $this->input('tipo_habitacion_id');
            $acomodacionId = $this->input('acomodacion_id');
            $cantidadNueva = $this->input('cantidad');

            // Verificar que la combinación no exista ya para el hotel
            $existe = Habitacion::where('hotel_id', $hotelId)
                ->where('tipo_habitacion_id', $tipoHabitacionId)
                ->where('acomodacion_id', $acomodacionId)
                ->exists();

            if ($existe) {
                $validator->errors()->add('tipo_habitacion_id', 'Esta combinación de tipo de habitación y acomodación ya existe para este hotel.');
                return;
            }

            // Obtener la configuración máxima permitida
            $configuracion = HotelTipoAcomodacion::where('hotel_id', $hotelId)
                ->where('tipo_habitacion_id', $tipoHabitacionId)
                ->where('acomodacion_id', $acomodacionId)
                ->first();

            if (!$configuracion) {
                $validator->errors()->add('tipo_habitacion_id', 'La combinación de tipo de habitación y acomodación no es válida para este hotel.');
                return;
            }

            if ($cantidadNueva > $configuracion->cantidad_maxima) {
                $validator->errors()->add('cantidad', 'La cantidad supera el máximo permitido para esta combinación.');
                return;
            }

            // Validar que la cantidad total de habitaciones no supere el máximo por hotel
            $hotel = Hotel::find($hotelId);
            $cantidadActual = Habitacion::where('hotel_id', $hotelId)->sum('cantidad');

            if (($cantidadActual + $cantidadNueva) > $hotel->num_habitaciones) {
                $validator->errors()->add('cantidad', 'La cantidad total de habitaciones supera el máximo permitido para este hotel.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'numero_habitacion.required' => 'El número de habitación es obligatorio.',
            'numero_habitacion.unique' => 'El número de habitación ya existe para este hotel.',
            'tipo_habitacion_id.required' => 'El tipo de habitación es obligatorio.',
            'tipo_habitacion_id.exists' => 'El tipo de habitación seleccionado no es válido.',
            'acomodacion_id.required' => 'La acomodación es obligatoria.',
            'acomodacion_id.exists' => 'La acomodación seleccionada no es válida.',
            'hotel_id.required' => 'El hotel es obligatorio.',
            'hotel_id.exists' => 'El hotel seleccionado no es válido.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
