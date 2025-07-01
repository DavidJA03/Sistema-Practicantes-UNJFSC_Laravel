<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Facultade;
use Illuminate\Support\Facades\DB;
use Exception;


class StoreFacultadRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:facultades,name'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la facultad es obligatorio.',
            'name.unique' => 'Esta facultad ya está registrada.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        ];
    }

}
