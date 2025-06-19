<?php

use App\Http\Controllers\cerrarSesionController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioMasivoController;
use App\Http\Controllers\facultadController;
use App\Http\Controllers\escuelaController;
use App\Http\Controllers\semestreController;
use App\Http\Requests\StoreFacultadRequest;
use App\Http\Requests\StoreEscuelaRequest;
use App\Http\Requests\StoreSemestreRequest;
use Illuminate\Support\Facades\Route;

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

Route::get('/facultad/{facultad}/edit', [FacultadController::class, 'edit'])->name('facultad.edit');

Route::resource('escuela',escuelaController::class);

Route::get('/escuela/{escuela}/edit', [EscuelaController::class, 'edit'])->name('escuela.edit');

//Semestre
Route::resource('semestre',semestreController::class);
Route::get('/semestre/{semestre}/edit', [SemestreController::class, 'edit'])->name('semestre.edit');