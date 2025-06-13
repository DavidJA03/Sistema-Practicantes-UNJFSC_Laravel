<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $validated = $request->validate([
            'codigo' => 'string|size:10',
            'nombres' => 'string|max:50',
            'apellidos' => 'string|max:50',
            'dni' => 'string|size:8|unique:personas,dni',
            'celular' => 'string|size:9',
            'correo_inst' => 'email|max:150|unique:personas,correo_inst',
            'sexo' => 'in:M,F',
            'provincia' => 'string|max:50',
            'distrito' => 'string|max:50',
        ]);

        // Si no se proporciona correo, usar el DNI como correo temporal
        if (empty($request->correo_inst)) {
            $request->correo_inst = $request->dni . '@temporal.com';
        }

        // Si no se selecciona sexo, usar 'M' como valor por defecto
        if (empty($request->sexo)) {
            $request->sexo = 'M';
        }

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $request->correo_inst,
                'email' => $request->correo_inst,
                'password' => Hash::make($request->codigo), // Usar DNI como contraseña inicial
            ]);

            // Crear la persona
            $persona = new Persona([
                'codigo' => $request->codigo,   
                'dni' => $request->dni,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'celular' => $request->celular,
                'sexo' => $request->sexo,
                'correo_inst' => $request->correo_inst,
                'departamento' => 'Lima Provincias',
                'provincia' => $request->provincia,
                'distrito' => $request->distrito,
                'usuario_id' => 1,
                'rol_id' => 2, // Asignar rol de usuario regular (2)
                'date_create' => now(),
                'date_update' => now(),
                'estado' => 1,
            ]);

            $persona->save();

            return response()->json([
                'success' => true,
                'message' => 'Persona registrada exitosamente',
                'data' => $persona
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la persona: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if a person exists by DNI
     *
     * @param  string  $dni
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkDni($dni)
    {
        $persona = Persona::where('dni', $dni)->first();
        return response()->json([
            'exists' => !is_null($persona)
        ]);
    }

    /**
     * Check if a person exists by email
     *
     * @param  string  $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmail($email)
    {
        $persona = Persona::where('correo_inst', $email)->first();
        return response()->json([
            'exists' => !is_null($persona)
        ]);
    }
}
