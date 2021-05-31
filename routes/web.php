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
    Route::get('/', function () {
        return view('graphs');
    })->name('admin');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('charts', [ChartController::class, 'index'])->name('charts.index');

    Route::resource('agentes', AgenteController::class)->except(['show'])->middleware(['admin']);
    Route::resource('medicos', MedicoController::class)->except(['show'])->middleware(['admin']);
    Route::resource('psicologos', PsicologoController::class)->except(['show'])->middleware(['admin']);

    Route::post('paciente/quadro-atual/{paciente}', QuadroAtualController::class)->name('paciente.quadro-atual');
    Route::post('paciente/monitoramento/{paciente}', MonitoramentoController::class)->name('paciente.monitoramento');
    Route::post('paciente/saude-mental/{id}', SaudeMentalController::class)->name('paciente.saude-mental');
    Route::post('paciente/internacao/{paciente}', ServicoInternacaoController::class)->name('paciente.internacao');
    Route::post('paciente/insumos/{paciente}', InsumosOferecidoController::class)->name('paciente.insumos');
    Route::post('paciente/vacinacao/{paciente}', VacinacaoController::class)->name('paciente.vacinacao');

    Route::resource('pacientes-export', PacienteExportController::class)->only(['index', 'store', 'update'])->middleware(['admin']);

    Route::resource('pacientes', PacienteController::class)->except(['show']);

    Route::prefix('gerenciamento')->middleware(['admin'])->group(function () {
        Route::resource('vacinas', VacinaController::class);
    });


    // Route::get('/admin/paciente/notify/dismiss/{notification_id}/{paciente_id}', 'NotifyController@dismiss')->name('paciente/notify/dismiss');

    Route::get('charts/{chart_id}', [ChartsController::class, 'index'])->name('charts.secondary');

    Route::get('chart/monitorados_exclusivo_psicologia', [ChartsController::class, 'monitorados_exclusivo_psicologia'])->name('chart.monitorados-exclusivo-psicologia');
    Route::get('chart/situacao_total_casos_monitorados', [ChartsController::class, 'situacao_total_casos_monitorados'])->name('chart.situacao-total-casos-monitorados');
    Route::get('chart/situacao_total_casos_monitorados_1', [ChartsController::class, 'situacao_total_casos_monitorados_1'])->name('chart.situacao-total-casos-monitorados-1');
    Route::get('chart/casos_monitorados_por_cidade', [ChartsController::class, 'casos_monitorados_por_cidade'])->name('chart.casos-monitorados-por-cidade');
    Route::get('chart/raca_cor_geral', [ChartsController::class, 'raca_cor_geral'])->name('chart.raca-cor-geral');
    Route::get('chart/genero_por_raca_cor', [ChartsController::class, 'genero_por_raca_cor'])->name('chart.genero-por-raca-cor');
    Route::get('chart/faixa_etaria_genero', [ChartsController::class, 'faixa_etaria_genero'])->name('chart.faixa-etaria-genero');
    Route::get('chart/faixa_etaria_genero_2', [ChartsController::class, 'faixa_etaria_genero_2'])->name('chart.faixa-etaria-genero-2');
    Route::get('chart/faixa_etaria_raca_cor', [ChartsController::class, 'faixa_etaria_raca_cor'])->name('chart.faixa-etaria-raca-cor');
    Route::get('chart/numero_pessoas_residencia_raca_cor', [ChartsController::class, 'numero_pessoas_residencia_raca_cor'])->name('chart.numero-pessoas-residencia-raca-cor');
    Route::get('chart/classe_social_renda_bruta_familiar', [ChartsController::class, 'classe_social_renda_bruta_familiar'])->name('chart.classe-social-renda-bruta-familiar');
    Route::get('chart/classe_social_renda_per_capta_raca_cor', [ChartsController::class, 'classe_social_renda_per_capta_raca_cor'])->name('chart.classe-social-renda-per-capta-raca-cor');
    Route::get('chart/raca_cor_por_auxilio_emergencial', [ChartsController::class, 'raca_cor_por_auxilio_emergencial'])->name('chart.raca-cor-por-auxilio-emergencial');
    Route::get('chart/insumos_oferecidos_pelo_projeto_raca_cor_1', [ChartsController::class, 'insumos_oferecidos_pelo_projeto_raca_cor_1'])->name('chart.insumos-oferecidos-pelo-projeto-raca-cor-1');
    Route::get('chart/insumos_oferecidos_pelo_projeto_raca_cor_2', [ChartsController::class, 'insumos_oferecidos_pelo_projeto_raca_cor_2'])->name('chart.insumos-oferecidos-pelo-projeto-raca-cor-2');
    Route::get('chart/insumos_oferecidos_pelo_projeto_raca_cor_3', [ChartsController::class, 'insumos_oferecidos_pelo_projeto_raca_cor_3'])->name('chart.insumos-oferecidos-pelo-projeto-raca-cor-3');
    Route::get('chart/tratamento_prescrito_por_medico_projeto', [ChartsController::class, 'tratamento_prescrito_por_medico_projeto'])->name('chart.tratamento-prescrito-por-medico-projeto');
    Route::get('chart/tratamento_financiado', [ChartsController::class, 'tratamento_financiado'])->name('chart.tratamento-financiado');
    Route::get('chart/dias_sintoma_por_raca_cor', [ChartsController::class, 'dias_sintoma_por_raca_cor'])->name('chart.dias-sintoma-por-raca-cor');
    Route::get('chart/dias_sintoma_mais_menos_dez_dias', [ChartsController::class, 'dias_sintoma_mais_menos_dez_dias'])->name('chart.dias-sintoma-mais-menos-dez-dias');
    Route::get('chart/total_dias_monitoramento_relacao_covid', [ChartsController::class, 'total_dias_monitoramento_relacao_covid'])->name('chart.total-dias-monitoramento-relacao-covid');
    Route::get('chart/casos_monitorados_por_agente', [ChartsController::class, 'casos_monitorados_por_agente'])->name('chart.casos-monitorados-por-agente');
    Route::get('chart/casos_avaliados_equipe_medica', [ChartsController::class, 'casos_avaliados_equipe_medica'])->name('chart.casos-avaliados-equipe-medica');
    Route::get('chart/acompanhamento_psicologico', [ChartsController::class, 'acompanhamento_psicologico'])->name('chart.acompanhamento-psicologico');
    Route::get('chart/acompanhamento_psicologico_individual_emgrupo', [ChartsController::class, 'acompanhamento_psicologico_individual_emgrupo'])->name('chart.acompanhamento-psicologico-individual-emgrupo');
    Route::get('chart/avaliacao_medica_por_raca_cor', [ChartsController::class, 'avaliacao_medica_por_raca_cor'])->name('chart.avaliacao-medica-por-raca-cor');
    Route::get('chart/avaliacao_psicologos_por_raca_cor', [ChartsController::class, 'avaliacao_psicologos_por_raca_cor'])->name('chart.avaliacao-psicologos-por-raca-cor');
    Route::get('chart/gestacao_alto_risco', [ChartsController::class, 'gestacao_alto_risco'])->name('chart.gestacao-alto-risco');
    Route::get('chart/acompanhamento_sistema_saude', [ChartsController::class, 'acompanhamento_sistema_saude'])->name('chart.acompanhamento-sistema-saude');
    Route::get('chart/saude_mental', [ChartsController::class, 'saude_mental'])->name('chart.saude-mental');
    Route::get('chart/servicos_referencia_internacao', [ChartsController::class, 'servicos_referencia_internacao'])->name('chart.servicos-referencia-internacao');
    Route::get('chart/idas_sistema_saude_x_prescricao_medicamentos_brancas', [ChartsController::class, 'idas_sistema_saude_x_prescricao_medicamentos_brancas'])->name('chart.idas-sistema-saude-x-prescricao-medicamentos-brancas');
    Route::get('chart/idas_sistema_saude_x_prescricao_medicamentos_pretas', [ChartsController::class, 'idas_sistema_saude_x_prescricao_medicamentos_pretas'])->name('chart.idas-sistema-saude-x-prescricao-medicamentos-pretas');
    Route::get('chart/idas_sistema_saude_x_prescricao_medicamentos_pardas', [ChartsController::class, 'idas_sistema_saude_x_prescricao_medicamentos_pardas'])->name('chart.idas-sistema-saude-x-prescricao-medicamentos-pardas');
    Route::get('chart/uso_cronico_alcool_drogas_raca_cor', [ChartsController::class, 'uso_cronico_alcool_drogas_raca_cor'])->name('chart.uso-cronico-alcool-drogas-raca-cor');
    Route::get('chart/gestante_posparto_amamenta', [ChartsController::class, 'gestante_posparto_amamenta'])->name('chart.gestante-posparto-amamenta');
    Route::get('chart/como_acessa_sistema_saude', [ChartsController::class, 'como_acessa_sistema_saude'])->name('chart.como-acessa-sistema-saude');
    Route::get('chart/diagnostico_covid_19', [ChartsController::class, 'diagnostico_covid_19'])->name('chart.diagnostico-covid-19');
    Route::get('chart/testes_realizados', [ChartsController::class, 'testes_realizados'])->name('chart.testes-realizados');
    Route::get('chart/desfecho', [ChartsController::class, 'desfecho'])->name('chart.desfecho');
    Route::get('chart/sequelas', [ChartsController::class, 'sequelas'])->name('chart.sequelas');
    Route::get('chart/precisou_ir_servico_saude', [ChartsController::class, 'precisou_ir_servico_saude'])->name('chart.precisou-ir-servico-saude');
    Route::get('chart/recebeu_medicacoes_covid_19', [ChartsController::class, 'recebeu_medicacoes_covid_19'])->name('chart.recebeu-medicacoes-covid-19');
    Route::get('chart/recebeu_medicacoes_covid_19_2', [ChartsController::class, 'recebeu_medicacoes_covid_19_2'])->name('chart.recebeu-medicacoes-covid-19-2');
    Route::get('chart/problemas_servicos_referencia', [ChartsController::class, 'problemas_servicos_referencia'])->name('chart.problemas-servicos-referencia');
    Route::get('chart/internacao_pelo_quadro', [ChartsController::class, 'internacao_pelo_quadro'])->name('chart.internacao-pelo-quadro');
    Route::get('chart/tempo_de_internacao', [ChartsController::class, 'tempo_de_internacao'])->name('chart.tempo-de-internacao');
    Route::get('chart/condicoes_saude', [ChartsController::class, 'condicoes_saude'])->name('chart.condicoes-saude');
    Route::get('chart/condicoes_saude_2', [ChartsController::class, 'condicoes_saude_2'])->name('chart.condicoes-saude-2');
    Route::get('chart/condicoes_saude_3', [ChartsController::class, 'condicoes_saude_3'])->name('chart.condicoes-saude-3');
    Route::get('chart/avaliacao_medica_raca_cor', [ChartsController::class, 'avaliacao_medica_raca_cor'])->name('chart.avaliacao-medica-raca-cor');
    Route::get('chart/condicoes_saude_saude_mental', [ChartsController::class, 'condicoes_saude_saude_mental'])->name('chart.condicoes-saude-saude-mental');
    Route::get('chart/trimestre_gestacao_inicio_monitoramento', [ChartsController::class, 'trimestre_gestacao_inicio_monitoramento'])->name('chart.trimestre-gestacao-inicio-monitoramento');
    Route::get('chart/acumulo_sintomas', [ChartsController::class, 'acumulo_sintomas'])->name('chart.acumulo-sintomas');
    Route::get('chart/local_internacao', [ChartsController::class, 'local_internacao'])->name('chart.local-internacao');
    Route::get('chart/internacao_diagnostico', [ChartsController::class, 'internacao_diagnostico'])->name('chart.internacao-diagnostico');
    Route::get('chart/sintomas_manifestados_situacao_raca_cor_1', [ChartsController::class, 'sintomas_manifestados_situacao_raca_cor_1'])->name('chart.sintomas_manifestados_situacao_raca_cor_1');
    Route::get('chart/sintomas_manifestados_situacao_raca_cor_2', [ChartsController::class, 'sintomas_manifestados_situacao_raca_cor_2'])->name('chart.sintomas_manifestados_situacao_raca_cor_2');
    Route::get('chart/sintomas_manifestados_situacao_raca_cor_3', [ChartsController::class, 'sintomas_manifestados_situacao_raca_cor_3'])->name('chart.sintomas_manifestados_situacao_raca_cor_3');
    Route::get('chart/sintomas_manifestados_situacao_raca_cor_4', [ChartsController::class, 'sintomas_manifestados_situacao_raca_cor_4'])->name('chart.sintomas_manifestados_situacao_raca_cor_4');
});
