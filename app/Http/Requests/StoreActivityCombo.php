<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityCombo extends FormRequest
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
            'clave' => 'required',
            'nombre' => 'required',
            'tipoactividades_id' => 'required',
            'maxcortesias' => 'required',
            'maxcupones' => 'required',
            'anticipo_id' => 'required',
            'mismodia' => 'required',
            'active' => 'required',
            'remove' => 'required',
            'combo' => 'required',
            'select_actividad_id_5' => 'required'
        ];
    }
}
