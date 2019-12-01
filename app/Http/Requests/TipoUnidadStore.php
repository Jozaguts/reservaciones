<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoUnidadStore extends FormRequest
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
            'clave' => 'required|string|max:5|unique:tipoactividades',
            'nombre' => 'required|string|max:255',
            'color'=> 'required|string',
            // 'usuarios_id'=> ['required', 'integer'],
            // 'removed' => ['nullable','boolean'],
            // 'active' => ['nullable','boolean'],
            'tipounidad_id'=>'required'
        ];
    }
    public function messages ()
    {
        return [
            'clave'=>'error',
            'nombre'=>' error 2',
            'color'=>'error3',
            'tipo_unidad_id'=>'error 4'
        ];
    }
}
