<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use App\Models\TypeUser;
use Illuminate\Support\Facades\Hash;

class UsuarioMasivoController extends Controller
{
    /**
     * Store multiple users from CSV file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $request->validate([
            'archivo' => 'file|mimes:csv,txt|max:2048',
            'rol' => 'exists:type_users,id'
        ]);

        try {
            $archivo = $request->file('archivo');
            $contenido = file($archivo->path());
            
            // Saltar las primeras 3 líneas (headers y datos no necesarios)
            array_shift($contenido); // Línea 1
            array_shift($contenido); // Línea 2
            array_shift($contenido); // Línea 3
            
            // Obtener los headers de la línea 4
            $headers = str_getcsv(array_shift($contenido));
            
            // Mapear los campos del CSV a los campos de la base de datos
            $campoMap = [
                'CodigoUniversitario' => 'codigo',
                'Alumno' => 'nombres',
                'Textbox4' => 'correo_inst'
            ];
            
            $usuariosCreados = 0;
            $errores = [];

            foreach ($contenido as $linea) {
                $datos = str_getcsv($linea);
                
                if (count($datos) !== count($headers)) {
                    $errores[] = "Formato incorrecto en la línea " . ($usuariosCreados + 1);
                    continue;
                }

                // Crear un array con los datos mapeados
                $usuarioData = [];
                foreach ($headers as $index => $header) {
                    if (isset($campoMap[$header])) {
                        if ($header === 'Alumno') {
                            // Separar apellidos y nombres
                            $nombresCompletos = $datos[$index];
                            $partes = explode(' ', $nombresCompletos);
                            
                            // Tomar las dos primeras palabras como apellidos
                            $apellidos = implode(' ', array_slice($partes, 0, 2));
                            // Tomar el resto como nombres
                            $nombres = implode(' ', array_slice($partes, 2));
                            
                            $usuarioData['apellidos'] = $apellidos;
                            $usuarioData['nombres'] = $nombres;
                        } else {
                            $usuarioData[$campoMap[$header]] = $datos[$index];
                        }
                    }
                }

                try {
                    // Crear usuario
                    $user = User::create([
                        'name' => $usuarioData['codigo'],
                        'email' => $usuarioData['correo_inst'],
                        'password' => Hash::make($usuarioData['codigo']),
                    ]);

                    // Crear persona
                    $persona = new Persona([
                        'codigo' => $usuarioData['codigo'],
                        'nombres' => $usuarioData['nombres'],
                        'apellidos' => $usuarioData['apellidos'],
                        'correo_inst' => $usuarioData['correo_inst'],
                        'departamento' => 'Lima Provincias',
                        'usuario_id' => 1,
                        'rol_id' => 1,
                        'date_create' => now(),
                        'date_update' => now(),
                        'estado' => 1,
                    ]);

                    $persona->save();
                    $usuariosCreados++;
                } catch (\Exception $e) {
                    $errores[] = "Error al crear usuario en la línea " . ($usuariosCreados + 1) . ": " . $e->getMessage();
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Proceso de carga completado. Usuarios creados: {$usuariosCreados}",
                'errores' => $errores
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el archivo: ' . $e->getMessage()
            ], 500);
        }
    }
}
