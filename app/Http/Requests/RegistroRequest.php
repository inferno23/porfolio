<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'persona_id' => 'required|unique:registro',
            'institucion_id' => 'required',
        ];
    }


    public function messages()
{
    return [
        'persona_id.required' => 'Por favor, seleccione un elector para continuar.',
        'persona_id.unique' => 'El elector seleccionado ya es Fiscal. Por favor, regrese al Padrón y seleccione otro elector.',
       
        'institucion_id.required' => 'Por favor, seleccione una Institución para continuar.',
    ];
}
}
