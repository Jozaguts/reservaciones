<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCombosRequest extends FormRequest
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
        'idusuario' => 'required',
        'clave' => 'required|unique:actividades',
        'nombre' => 'required',
        'tipoactividades_id' => 'required',
        'maxcortesias' => 'required',
        'maxcupones' => 'required',
        'anticipo_id' => 'required',
        'mismo_dia' => 'nullable',
        'precios' => 'nullable',
        'actividades_combo'=> 'required',
      
        ];
    }
    public function messages()
    {
        return [
        'idusuario.required' => 'Id usuario es obligatorio',
        'horario_id.required' => "Debes De Seleccionar Almenos Una Actividad"
        ];
    }
}
    