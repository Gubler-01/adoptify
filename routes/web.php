<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\EntidadesController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\TiposAnimalesController;
use App\Http\Controllers\RolesUsuariosController;
use App\Http\Controllers\CatalogoVacunasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RefugiosController;
use App\Http\Controllers\AnimalesController;
use App\Http\Controllers\SolicitudesAdopcionController;
use App\Http\Controllers\AdopcionesController;
use App\Http\Controllers\VisitasController;
use App\Http\Controllers\VacunasController;
use App\Http\Controllers\SeguimientosController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\DatosEmpresaController;
use App\Http\Controllers\EmailController;

use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('menu', function () {
    return view('menu');
})->name('menu');

Route::get('bienvenida', function () {
    return view('bienvenida');
});

Route::get('cruds', function () {
    return view('cruds');
});

Route::resource('paises', PaisesController::class);
Route::resource('entidades', EntidadesController::class);
Route::resource('municipios', MunicipiosController::class);
Route::resource('tipos-animales', TiposAnimalesController::class);
Route::resource('roles-usuarios', RolesUsuariosController::class);
Route::resource('catalogo-vacunas', CatalogoVacunasController::class);
Route::resource('usuarios', UsuariosController::class);
Route::resource('refugios', RefugiosController::class);
Route::resource('animales', AnimalesController::class);
Route::resource('solicitudes-adopcion', SolicitudesAdopcionController::class);
Route::resource('adopciones', AdopcionesController::class);
Route::resource('visitas', VisitasController::class);
Route::resource('vacunas', VacunasController::class);
Route::resource('seguimientos', SeguimientosController::class);
Route::resource('fotos', FotosController::class);
Route::resource('datos-empresa', DatosEmpresaController::class);


// Ajax part 1
Route::get('combo_entidad_muni/{id_pais}', [App\Http\Controllers\AjaxController::class, 'cambia_combo']);
Route::get('combo_municipio/{id_entidad}', [App\Http\Controllers\AjaxController::class, 'cambia_combo_2']);

// Rutas para los reportes PDF
Route::get('genera_pdf', [PdfController::class, 'genera_pdf']);
Route::get('animales_por_refugio_y_tipo/{tipo}/{id_refugio}/{id_tipo_animal}', [PdfController::class, 'animales_por_refugio_y_tipo']);
Route::get('certificado_adopcion/{tipo}/{id_animal}', [PdfController::class, 'certificado_adopcion']);

// Ajax part 2
Route::get('ejemplos_ajax', [App\Http\Controllers\AjaxController::class, 'ejemplos_ajax']);
Route::get('buscar_animales_por_tipo/{id_tipo_animal}/{id_refugio}', [App\Http\Controllers\AjaxController::class, 'buscar_animales_por_tipo']);
Route::get('cambiar_status_animal/{id_animal}/{id_tipo_animal}/{id_refugio}', [App\Http\Controllers\AjaxController::class, 'cambiar_status_animal']);
Auth::routes();

// EMAIL
Route::get('form_enviar_correo', [EmailController::class,'form_enviar_correo']);
Route::post('enviar_correo', [EmailController::class,'enviar_correo']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
