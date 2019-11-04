<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsiginaciones extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.actividad_id' => 'required|integer',
            '*.actividad_horario_id' => 'required|integer',
            '*.unidad_id' => 'required|integer',
            '*.salida' => 'required|boolean',
            '*.salida_llegada_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
        '*.actividad_id.required' => 'Id usuario es obligatorio',
        '*.actividad_horario_id.required' => "Debes De Seleccionar Almenos Un Horario",
        '*.unidad_id.required' => "Debes De Seleccionar Almenos Una Unidad",
        '*.salida.required' => "Debes De Espesifica Si es Salida o Llegada",
        '*.salida_llegada_id.required' => "Debes De Seleccionar Almenos Un Punto De Salida o Llegada",

        '*.actividad_id.integer' => 'Actividad No Tiene el Formato Valido',
        '*.actividad_horario_id.integer' => "Actividad Horario No Tiene Un Tipo De Dato Valido",
        '*.unidad_id.integer' => "Unidad ID No TIene Un Tipo De Dato valido",
        '*.salida.boolean' => "No Espesifica si Es Salida O Llegada ",
        '*.salida_llegada_id.integer' => "No Secciono Un Punto De Salida O Llegada"
        
        ];
    }
}
