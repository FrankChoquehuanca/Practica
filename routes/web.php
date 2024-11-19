<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\RegisterController;
use App\Livewire\CrudArea;
use App\Livewire\CrudAsignacion;
use App\Livewire\CrudCargoadicional;
use App\Livewire\CrudDepartamento;
use App\Livewire\CrudDirectorio;
use App\Livewire\CrudGerencia;
use App\Livewire\CrudMonitoreo;
use App\Livewire\CrudPapeleta;
use App\Livewire\CrudPersona as LivewireCrudPersona;
use App\Livewire\CrudRelacion;
use App\Livewire\CrudSubgerencia;
use App\Livewire\CrudTurno;
use App\Livewire\CrudUnidad;
use App\Livewire\MonitoreoImages;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
    // return view('welcome);
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/personas',LivewireCrudPersona::class)->name('personas');
    Route::get('/gerencias',CrudGerencia::class)->name('gerencias');
    Route::get('/subgerencias',CrudSubgerencia::class)->name('subgerencias');
    Route::get('/departamentos',CrudDepartamento::class)->name('departamentos');
    Route::get('/unidades',CrudUnidad::class)->name('unidades');
    Route::get('/areas',CrudArea::class)->name('areas');
    Route::get('/cargoadicionales',CrudCargoadicional::class)->name('cargoadicionales');
    Route::get('/directorios',CrudDirectorio::class)->name('directorios');
    Route::get('/relaciones',CrudRelacion::class)->name('relaciones');
    Route::get('/asignaciones',CrudAsignacion::class)->name('asignaciones');
    Route::get('/turnos',CrudTurno::class)->name('turnos');
    Route::get('/monitoreos',CrudMonitoreo::class)->name('monitoreos');
    Route::get('/papeletas',CrudPapeleta::class)->name('papeletas');
    // Route::post('/import', [CsvController::class, 'import'])->name('import');
    Route::get('/export', [CsvController::class, 'export'])->name('export');
    Route::get('/monitoreos/images/{monitoreo}', MonitoreoImages::class)->name('monitoreos.images.show');

    // // Route::get('/monitoreos/images/{monitoreo}', [MonitoreoImages::class, 'show'])->name('monitoreos.images.show');


});
