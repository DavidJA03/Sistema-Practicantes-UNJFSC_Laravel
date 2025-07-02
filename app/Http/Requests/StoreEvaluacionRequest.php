<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluacionRequest extends FormRequest
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
            'alumno_id' => 'required|exists:personas,id',
            'anexo_7' => 'nullable|file|mimes:pdf|max:2048',
            'anexo_8' => 'nullable|file|mimes:pdf|max:2048',
            'pregunta_1' => 'required|string',
            'pregunta_2' => 'required|string',
            'pregunta_3' => 'required|string',
            'pregunta_4' => 'required|string',
            'pregunta_5' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'alumno_id.required' => 'El alumno es obligatorio.',
            'alumno_id.exists' => 'El alumno no es válido.',
            'anexo_7.mimes' => 'El Anexo 7 debe ser un archivo PDF.',
            'anexo_8.mimes' => 'El Anexo 8 debe ser un archivo PDF.',
            'anexo_7.max' => 'El Anexo 7 no debe pesar más de 2MB.',
            'anexo_8.max' => 'El Anexo 8 no debe pesar más de 2MB.',
        ];
    }
}
