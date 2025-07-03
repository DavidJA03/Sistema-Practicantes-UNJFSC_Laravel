<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\asginacionController;
use App\Http\Controllers\cerrarSesionController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioMasivoController;
use App\Http\Controllers\facultadController;
use App\Http\Controllers\escuelaController;
use App\Http\Controllers\grupoEstudianteController;
use App\Http\Controllers\matriculaController;
use App\Http\Controllers\semestreController;
use App\Http\Controllers\evaluacionController;
use App\Http\Requests\StoreFacultadRequest;
use App\Http\Requests\StoreEscuelaRequest;
use App\Http\Requests\StoreSemestreRequest;

use App\Models\grupo_estudiante;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\JefeInmediatoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/  

Route::get('/', [loginController::class, 'index']);
Route::get('/panel', [homeController::class, 'index'])->middleware('auth')->name('panel');
Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'login']);
Route::get('/cerrarSecion', [cerrarSesionController::class, 'cerrarSecion'])->name('cerrarSecion');


// ... otras rutas ...

Route::get('/segmento/perfil', [PersonaController::class, 'users'])->middleware('auth')->name('perfil');

// Rutas para personas
Route::post('/personas', [PersonaController::class, 'store'])->name('personas.store');
Route::get('/personas/check-dni/{dni}', [PersonaController::class, 'checkDni'])->middleware('auth')->name('personas.check.dni');
Route::get('/personas/check-email/{email}', [PersonaController::class, 'checkEmail'])->middleware('auth')->name('personas.check.email');

// Ruta para cargar el modal de registro
Route::get('/segmento/modal-registro', [PersonaController::class, 'registro'])->middleware('auth')->name('modal.registro');

Route::get('/segmento/modal-carga-masiva', [UsuarioMasivoController::class, 'index'])->middleware('auth')->name('modal.carga_masiva');

// Ruta para la carga masiva de usuarios
Route::post('/usuarios-masivos', [UsuarioMasivoController::class, 'store'])->name('usuarios.masivos.store');

Route::get('/segmento/registrar', function () {
    return view('segmento.registrar');
})->middleware('auth')->name('registrar');

Route::get('/list_users/modal-editar', function () {
    return view('list_users.edit_persona');
})->middleware('auth')->name('modal.editar');

Route::post('/list_users/modal-editar/{id}', [PersonaController::class, 'update'])->middleware('auth')->name('modal.editar');

Route::post('/segmento/actualizar_perfil/{id}', [PersonaController::class, 'update'])->middleware('auth')->name('actualizar_perfil');

Route::get('/list_users/docente', [PersonaController::class, 'lista_docentes'])->middleware('auth')->name('docente');

Route::get('/list_users/estudiante', [PersonaController::class, 'lista_estudiantes'])->middleware('auth')->name('estudiante');

Route::get('/list_users/supervisor', [PersonaController::class, 'lista_supervisores'])->middleware('auth')->name('supervisor');

Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->middleware('auth')->name('personas.destroy');

// Ruta para obtener los datos de un docente
Route::get('/personas/{id}', [PersonaController::class, 'edit'])->middleware('auth')->name('personas.edit');

// Ruta para actualizar una persona
Route::put('/personas/{id}', [PersonaController::class, 'update'])->middleware('auth')->name('personas.update');

//Bloque Academico
Route::resource('facultad',facultadController::class);


Route::resource('escuela',escuelaController::class);


//Semestre
Route::resource('semestre',semestreController::class);




Route::get('/semestre/{semestre}/edit', [SemestreController::class, 'edit'])->name('semestre.edit');


//Matricula 
Route::get("/matricula", [matriculaController::class, "index" ])->middleware('auth')->name("matricula_index");
Route::post('/subir/ficha', [ArchivoController::class, 'subirFicha'])->middleware('auth')->name('subir.ficha');
Route::post('/subir/record', [ArchivoController::class, 'subirRecord'])->middleware('auth')->name('subir.record');

Route::get('/practicas/desarrollo', [PracticaController::class, 'desarrollo'])->middleware('auth')->name('desarrollo');
Route::post('/practicas/desarrollo', [PracticaController::class, 'storeDesarrollo'])->middleware('auth')->name('desarrollo');

Route::get('/practicas/convalidacion', [PracticaController::class, 'convalidacion'])->middleware('auth')->name('convalidacion');

// Rutas para empresas
Route::post('/empresas/{practicas_id}', [EmpresaController::class, 'store'])->name('empresas.store');

Route::post('/jefe_inmediato/{practicas_id}', [JefeInmediatoController::class, 'store'])->name('jefe_inmediato.store');

Route::post('/practicas/fut', [PracticaController::class, 'storeFut'])->middleware('auth')->name('store.fut');

Route::post('/practicas/cartapresentacion', [PracticaController::class, 'storeCartaPresentacion'])->middleware('auth')->name('store.cartapresentacion');

Route::post('/practicas/cartaaceptacion', [PracticaController::class, 'storeCartaAceptacion'])->middleware('auth')->name('store.cartaaceptacion');

Route::post('/practicas/planactividades', [PracticaController::class, 'storePlanActividadesPPP'])->middleware('auth')->name('store.planactividadesppp');

Route::post('/practicas/constanciacumplimiento', [PracticaController::class, 'storeConstanciaCumplimiento'])->middleware('auth')->name('store.constanciacumplimiento');

Route::post('/practicas/informefinalppp', [PracticaController::class, 'storeInformeFinalPPP'])->middleware('auth')->name('store.informefinalppp');

Route::get('/practica', function () {
    return view('practicas.practica');
})->middleware('auth')->name('practica');

Route::get('/supervision', [PracticaController::class, 'lst_supervision'])->middleware('auth')->name('supervision');

Route::get('/empresa', [EmpresaController::class, 'index'])->middleware('auth')->name('empresa');
Route::get('/jefe_inmediato', [JefeInmediatoController::class, 'index'])->middleware('auth')->name('jefes');

Route::post('/practicas/registroactividades', [PracticaController::class, 'storeRegistroActividades'])->middleware('auth')->name('store.registroactividades');
Route::post('/practicas/controlmensualactividades', [PracticaController::class, 'storeControlMensualActividades'])->middleware('auth')->name('store.controlmensualactividades');

Route::get("/asignacion", [asginacionController::class, "index" ])->name("asignacion_index");
Route::post('/grupos-practica', [asginacionController::class, 'store'])->name('grupos.store');

Route::POST('/grupos/{id}', [asginacionController::class, 'update'])->name('grupos.update');
Route::POST('/grupos_delete/{id}', [asginacionController::class, 'eliminar'])->name('grupos.destroy');

Route::get("/grupoEstudiante", [grupoEstudianteController::class, "index" ])->name("estudiante_index");

Route::post('/asignarAlumnos', [grupoEstudianteController::class, 'asignarAlumnos'])->name('grupos.asignarAlumnos');

Route::GET('/grupos/eliminar-asignado/{id}', [GrupoEstudianteController::class, 'destroy'])->name('grupos.eliminarAsignado');

Route::post('/practicas/proceso', [PracticaController::class, 'proceso'])->middleware('auth')->name('proceso');
