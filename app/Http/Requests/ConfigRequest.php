<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'correo'        => 'nullable|min:3|max:100',
            'direccion'     => 'nullable|min:3|max:100',
            'telefono'      => 'nullable|min:3|max:100',
            'msj_inicio'    => 'nullable|min:3|max:100',
        ];
    }
}
