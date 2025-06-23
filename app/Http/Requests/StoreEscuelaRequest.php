<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Escuela;
use Illuminate\Support\Facades\DB;
use Exception;

class StoreEscuelaRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:escuelas,name',
            'facultad_id' => 'required|exists:facultades,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la escuela es obligatorio.',
            'name.unique' => 'Ya existe una escuela con ese nombre.',
            'facultad_id.required' => 'Debes seleccionar una facultad.',
            'facultad_id.exists' => 'La facultad seleccionada no es válida.',
        ];
    }
}
