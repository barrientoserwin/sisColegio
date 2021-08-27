<?php

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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\GestionCursoController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParaleloController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PagoMensualController;
use App\Http\Controllers\MensualidadInscripcionController;
use App\Http\Controllers\CursoMateriaController;
use App\Http\Controllers\CursoParaleloController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\AlumnoMateriaController;
use App\Http\Controllers\AsistenciaController;

// Route::get('/', function () {
//     return view('contenido/contenido');
// });

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['guest']],function(){
    Route::get('/',[LoginController::class, 'showLoginForm']);
    Route::post('/usuario',[LoginController::class, 'usuario'])->name('usuario');
});
Auth::routes();
Route::group(['middleware'=>['auth']],function(){    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    //Rutas Alumnos
    Route::get('/alumno', [AlumnoController::class, 'index']);
    Route::get('/alumno/listarSinPaginate', [AlumnoController::class, 'listarSinPaginate']);
    Route::post('/alumno/guardar', [AlumnoController::class, 'guardar']);
    Route::post('/alumno/inscripcion/guardar', [AlumnoController::class, 'guardarInscripcion']);
    Route::put('/alumno/modificar', [AlumnoController::class, 'modificar']);
    Route::put('/alumno/desactivar', [AlumnoController::class, 'desactivar']);
    Route::put('/alumno/activar', [AlumnoController::class, 'activar']);

    //Rutas Curso
    Route::get('/curso', [CursoController::class, 'index']);

    //Rutas Gestion Curso
    Route::get('/gestion/curso/detalle', [GestionCursoController::class, 'detalleCursoGestion']);
    Route::get('/gestion/curso/selectCursoGestion', [GestionCursoController::class, 'selectCursoGestion']);
    Route::get('/gestion/curso/listado', [GestionCursoController::class, 'listarGestionCurso']);
    Route::get('/gestion/curso/listarGestionCursoInscritos', [GestionCursoController::class, 'listarGestionCursoInscritos']);

    //Rutas Materia
    Route::get('/materia', [MateriaController::class, 'index']);

    //Rutas Gestion
    Route::get('/gestion', [GestionController::class, 'index']);
    Route::post('/gestion/guardar', [GestionController::class, 'guardar']);
    Route::put('/gestion/activar', [GestionController::class, 'activar']);
    Route::put('/gestion/desactivar', [GestionController::class, 'desactivar']);
    Route::get('/gestion/selectGestion', [GestionController::class, 'selectGestion']);

    //Rutas Apoderado
    Route::get('/apoderado', [ApoderadoController::class, 'index']);
    Route::post('/apoderado/guardar', [ApoderadoController::class, 'guardar']);
    Route::put('/apoderado/desactivar', [ApoderadoController::class, 'desactivar']);
    Route::put('/apoderado/activar', [ApoderadoController::class, 'activar']);
    Route::get('/apoderado/alumno', [ApoderadoController::class, 'listarAlumnoApoderado']);

    //Rutas Secretaria
    Route::get('/secretaria', [SecretariaController::class, 'index']);
    Route::post('/secretaria/guardar', [SecretariaController::class, 'guardar']);
    Route::put('/secretaria/modificar', [SecretariaController::class, 'modificar']);    

    //Rutas Profesor
    Route::get('/profesor', [ProfesorController::class, 'index']);
    Route::get('/profesor/listarSinPaginate', [ProfesorController::class, 'listarSinPaginate']);
    Route::post('/profesor/guardar', [ProfesorController::class, 'guardar']);
    Route::put('/profesor/modificar', [ProfesorController::class, 'modificar']);   

    //Rutas User
    Route::put('/users/desactivar', [UserController::class, 'desactivar']);
    Route::put('/users/activar', [UserController::class, 'activar']);
    Route::get('/users/roles', [UserController::class, 'rolUsuarios']);
    Route::get('/users/personal', [UserController::class, 'personal']);

    //Paralelo 
    Route::get('/paralelo/selectParalelo', [ParaleloController::class, 'selectParalelo']);

    //Rutas Inscripcion
    Route::get('/inscripcion', [InscripcionController::class, 'index']);
    Route::post('/inscripcion/guardar', [InscripcionController::class, 'guardar']);
    Route::put('/inscripcion/desactivar',[InscripcionController::class, 'desactivar']);
    Route::put('/inscripcion/activar',[InscripcionController::class, 'activar']);
    Route::get('/inscripcion/alumnoInscripcion', [InscripcionController::class, 'alumnoInscripcion']);

    //Rutas Pago Mensual
    Route::post('/pago/mensual/programar', [PagoMensualController::class, 'programarPago']);

    //Rutas Mensualidad Inscripcion
    Route::get('/mensualidad/detalle', [MensualidadInscripcionController::class, 'detalleMensualidad']);
    Route::get('/mensualidad/detalleCliente', [MensualidadInscripcionController::class, 'detalleCliente']);
    Route::put('/mensualidad/pagoMes', [MensualidadInscripcionController::class, 'pagoMes']);

    //Rutas Curso Materia
    Route::post('/curso/materia/guardar', [CursoMateriaController::class, 'guardar']);
    Route::get('/curso/materia/listarMateriaGestion', [CursoMateriaController::class, 'listarMateriaGestion']);
    Route::get('/curso/materia/listarCursoMateria', [CursoMateriaController::class, 'listarCursoMateria']);
    Route::put('/curso/materia/asignarProfesor', [CursoMateriaController::class, 'asignarProfesor']);
    Route::get('/curso/materia/selectCursoMateria', [CursoMateriaController::class, 'selectCursoMateria']);

    //Rutas Curso Paralelo
    Route::post('/curso/paralelo/guardar', [CursoParaleloController::class, 'guardar']);
    Route::get('/curso/paralelo/selectCursoParalelo', [CursoParaleloController::class, 'selectCursoParalelo']);

    //Rutas Periodo
    Route::get('/periodo/selectPeriodo', [PeriodoController::class, 'selectPeriodo']);

    //Rutas Alumno Materia
    Route::post('/alumno/materia/guardar', [AlumnoMateriaController::class, 'guardar']);
    Route::get('/alumno/materia/listarAlumnos', [AlumnoMateriaController::class, 'listarAlumnos']);
    Route::get('/alumno/materia/boletin', [AlumnoMateriaController::class, 'boletin']);

    //Rutas Asistencia
    Route::post('/asistencia/guardar', [AsistenciaController::class, 'guardar']);
    Route::get('/asistencia/controlAsistencia', [AsistenciaController::class, 'controlAsistencia']);

});