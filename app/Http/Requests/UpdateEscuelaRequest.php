<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEscuelaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:escuelas,name,' . $this->route('escuela'),
            'facultad_id' => 'required|exists:facultades,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la escuela es obligatorio.',
            'name.unique' => 'Este nombre de escuela ya existe.',
            'facultad_id.required' => 'Debe seleccionarse una facultad.',
            'facultad_id.exists' => 'La facultad seleccionada no es válida.',
        ];
    }
}
