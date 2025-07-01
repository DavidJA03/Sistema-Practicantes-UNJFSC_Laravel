<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultadRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:facultades,name,' . $this->facultad->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la facultad es obligatorio.',
            'name.unique' => 'Ya existe otra facultad con este nombre.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        ];
    }
    
}
