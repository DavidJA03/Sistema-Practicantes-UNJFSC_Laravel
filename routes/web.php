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

Route::get('/segmento/perfil', function () {
    return view('segmento.perfil');
})->name('perfil');

// Rutas para personas
Route::post('/personas', [PersonaController::class, 'store'])->name('personas.store');
Route::get('/personas/check-dni/{dni}', [PersonaController::class, 'checkDni'])->name('personas.check.dni');
Route::get('/personas/check-email/{email}', [PersonaController::class, 'checkEmail'])->name('personas.check.email');

// Ruta para cargar el modal de registro
Route::get('/segmento/modal-registro', function () {
    return view('segmento.cuadro_registro');
})->name('modal.registro');

Route::get('/segmento/modal-carga-masiva', function () {
    return view('segmento.usuario_masivo');
})->name('modal.carga_masiva');

// Ruta para obtener roles
Route::get('/roles', function () {
    return \App\Models\TypeUser::all();
})->name('roles.index');

// Ruta para la carga masiva de usuarios
Route::post('/usuarios-masivos', [UsuarioMasivoController::class, 'store'])->name('usuarios.masivos');

Route::get('/segmento/registrar', function () {
    //$roles = \App\Models\TypeUser::all();
    return view('segmento.registrar');
})->name('registrar');

// Ruta para carga masiva de usuarios
Route::post('/usuarios-masivos', [UsuarioMasivoController::class, 'store'])->name('usuarios.masivos.store');

Route::get('/cerrarSecion', [cerrarSesionController::class, 'cerrarSecion'])->name('cerrarSecion');

//Bloque Academico
Route::resource('facultad',facultadController::class);

Route::get('/facultad/{facultad}/edit', [FacultadController::class, 'edit'])->name('facultad.edit');

Route::resource('escuela',escuelaController::class);

Route::get('/escuela/{escuela}/edit', [EscuelaController::class, 'edit'])->name('escuela.edit');

//Semestre
Route::resource('semestre',semestreController::class);
Route::get('/semestre/{semestre}/edit', [SemestreController::class, 'edit'])->name('semestre.edit');

