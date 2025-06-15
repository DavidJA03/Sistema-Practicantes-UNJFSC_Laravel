<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use App\Models\type_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
        /**
     * Show the user profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lista_docentes(){
        $personas = Persona::where('rol_id', 2)->get();
        return view('list_users.docente', compact('personas'));
    }
        /**
     * Show the user profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lista_supervisores(){
        $personas = Persona::where('rol_id', 3)->get();
        return view('list_users.supervisor', compact('personas'));
    }
    /**
     * Show the user profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lista_estudiantes(){
        $personas = Persona::where('rol_id', 4)->get();
        return view('list_users.estudiante', compact('personas'));
    }
    /**
     * Obtener los datos de una persona
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $persona = Persona::findOrFail($id);
        return response()->json($persona);
    }

    /**
     * Show the user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function users(){
        // Obtener el usuario logeado
        $user = auth()->user();
        
        // Obtener la persona asociada al usuario
        $persona = $user->persona;
        
        return view('segmento.perfil', compact('persona'));
    }
    /**
     * Show the registration modal
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(){
        $roles = type_users::where('estado', 1)
            ->where('name', '!=', 'admin')
            ->get();
        
        return view('segmento.cuadro_registro', compact('roles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();
        
        return redirect()->back()->with('success', 'Persona eliminada correctamente.');
    }

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
            'rol' => 'exists:type_users,id',
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
                'usuario_id' => $user->id,
                'rol_id' => $request->rol,
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
    public function checkDni($dni){
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
    public function checkEmail($email){
        $persona = Persona::where('correo_inst', $email)->first();
        return response()->json([
            'exists' => !is_null($persona)
        ]);
    }
}
