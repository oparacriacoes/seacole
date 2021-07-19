<?php

use App\Http\Controllers\AgenteController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsumosOferecidoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MonitoramentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacienteExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsicologoController;
use App\Http\Controllers\QuadroAtualController;
use App\Http\Controllers\SaudeMentalController;
use App\Http\Controllers\ServicoInternacaoController;
use App\Http\Controllers\VacinacaoController;
use App\Http\Controllers\VacinaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => app()->environment('local')
]);


Route::prefix('admin')->middleware(['auth', 'professional'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('charts', [ChartController::class, 'index'])->name('charts.index');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::resource('agentes', AgenteController::class)->except(['show'])->middleware(['admin']);
    Route::resource('medicos', MedicoController::class)->except(['show'])->middleware(['admin']);
    Route::resource('psicologos', PsicologoController::class)->except(['show'])->middleware(['admin']);

    Route::post('paciente/quadro-atual/{paciente}', QuadroAtualController::class)->name('paciente.quadro-atual');
    Route::post('paciente/monitoramento/{paciente}', MonitoramentoController::class)->name('paciente.monitoramento');
    Route::post('paciente/saude-mental/{id}', SaudeMentalController::class)->name('paciente.saude-mental');
    Route::post('paciente/internacao/{paciente}', ServicoInternacaoController::class)->name('paciente.internacao');
    Route::post('paciente/insumos/{paciente}', InsumosOferecidoController::class)->name('paciente.insumos');
    Route::post('paciente/vacinacao/{paciente}', VacinacaoController::class)->name('paciente.vacinacao');
    Route::resource('pacientes', PacienteController::class)->except(['show']);

    Route::resource('pacientes-export', PacienteExportController::class)->only(['index', 'store', 'update'])->middleware(['admin']);

    Route::prefix('gerenciamento')->middleware(['admin'])->group(function () {
        Route::resource('vacinas', VacinaController::class);
    });
});
