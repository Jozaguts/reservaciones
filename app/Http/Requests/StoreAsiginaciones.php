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
}
