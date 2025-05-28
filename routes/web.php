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
use App\Http\Controllers\GraficasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('bienvenida', function () {
    return view('bienvenida');
});

Route::get('cruds', function () {
    return view('cruds');
})->middleware(['auth', 'MDAdmin']);

Route::get('principal', function () {
    return view('principal');
})->name('principal');

// Rutas protegidas por autenticación (accesibles por todos los roles autenticados, con restricciones internas)
Route::group(['middleware' => ['auth']], function () {
    // Recursos accesibles por Administrador y Refugio (id_rol 1 y 2)
    Route::group(['middleware' => ['MDSuper']], function () {
        Route::resource('refugios', RefugiosController::class);
        Route::resource('adopciones', AdopcionesController::class);
        Route::resource('vacunas', VacunasController::class);
        Route::resource('seguimientos', SeguimientosController::class);

        Route::get('genera_pdf', [PdfController::class, 'genera_pdf']);
        Route::get('animales_por_refugio_y_tipo/{tipo}/{id_refugio}/{id_tipo_animal}', [PdfController::class, 'animales_por_refugio_y_tipo']);
        Route::get('certificado_adopcion/{tipo}/{id_animal}', [PdfController::class, 'certificado_adopcion']);

        Route::get('form_enviar_correo', [EmailController::class, 'form_enviar_correo']);
        Route::post('enviar_correo', [EmailController::class, 'enviar_correo']);

        Route::get('ejemplos_ajax', [App\Http\Controllers\AjaxController::class, 'ejemplos_ajax']);
        Route::get('buscar_animales_por_tipo/{id_tipo_animal}/{id_refugio}', [App\Http\Controllers\AjaxController::class, 'buscar_animales_por_tipo']);
        Route::get('cambiar_status_animal/{id_animal}/{id_tipo_animal}/{id_refugio}', [App\Http\Controllers\AjaxController::class, 'cambiar_status_animal']);
    });

    // Rutas AJAX para combos (accesibles por todos los roles autenticados, ya que se usan en formularios)
    Route::get('combo_entidad_muni/{id_pais}', [App\Http\Controllers\AjaxController::class, 'cambia_combo']);
    Route::get('combo_municipio/{id_entidad}', [App\Http\Controllers\AjaxController::class, 'cambia_combo_2']);
});

// Recursos exclusivos del Administrador (id_rol = 1)
Route::group(['middleware' => ['auth', 'MDAdmin']], function () {
    Route::resource('paises', PaisesController::class);
    Route::resource('entidades', EntidadesController::class);
    Route::resource('municipios', MunicipiosController::class);
    Route::resource('tipos-animales', TiposAnimalesController::class);
    Route::resource('roles-usuarios', RolesUsuariosController::class);
    Route::resource('catalogo-vacunas', CatalogoVacunasController::class);
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('datos-empresa', DatosEmpresaController::class);

    Route::get('graficas', [GraficasController::class, 'graficas']);
    Route::get('grafica_barras', [GraficasController::class, 'grafica_barras']);
    Route::get('grafica_pie', [GraficasController::class, 'grafica_pie']);
    Route::get('grafica_3d', [GraficasController::class, 'grafica_3d']);
});

// Rutas para Adoptante (id_rol = 3, con restricciones específicas)
Route::group(['middleware' => ['auth', 'MDClien']], function () {
    Route::resource('animales', AnimalesController::class)->only(['index', 'show']);
    Route::resource('visitas', VisitasController::class);
    Route::resource('solicitudes-adopcion', SolicitudesAdopcionController::class);
    Route::resource('fotos', FotosController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');