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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
  // Route::get('/admin', function() {
  //   return view('sample');
  // })->name('admin');

  Route::get('/admin', function() {
    return view('dashboard');
  })->name('admin');

  Route::get('/admin/agente', 'AgenteController@index')->name('agente');
  Route::get('/admin/agente/add', 'AgenteController@add')->name('agente/add');
  Route::get('/admin/agente/edit/{id}', 'AgenteController@edit')->name('agente/edit');
  Route::delete('/admin/agente/remove/{id}', 'AgenteController@destroy')->name('agente.destroy');

  Route::get('/admin/medico', 'MedicoController@index')->name('medico');
  Route::get('/admin/medico/add', 'MedicoController@add')->name('medico/add');
  Route::get('/admin/medico/edit/{id}', 'MedicoController@edit')->name('medico/edit');
  Route::delete('/admin/medico/remove/{id}', 'MedicoController@destroy')->name('medico.destroy');

  Route::get('/admin/psicologo', 'PsicologoController@index')->name('psicologo');
  Route::get('/admin/psicologo/add', 'PsicologoController@add')->name('psicologo/add');
  Route::get('/admin/psicologo/edit/{id}', 'PsicologoController@edit')->name('psicologo/edit');
  Route::delete('/admin/psicologo/remove/{id}', 'PsicologoController@destroy')->name('psicologo.destroy');

  Route::get('/admin/paciente', 'PacienteController@index')->name('paciente');
  Route::post('/admin/paciente', 'PacienteController@storeGeral')->name('admin.paciente.store');
  Route::get('/admin/paciente/add', 'PacienteController@add')->name('paciente/add');
  Route::get('/admin/paciente/edit/{id}', 'PacienteController@edit')->name('paciente/edit');
  Route::post('/admin/paciente/update/{id}', 'PacienteController@update')->name('paciente.update');
  Route::get('/admin/paciente/notify/dismiss/{notification_id}/{paciente_id}', 'NotifyController@dismiss')->name('paciente/notify/dismiss');
  Route::post('/admin/paciente/quadro-atual', 'QuadroAtualController@store')->name('paciente.quadro-atual');
  Route::post('/admin/paciente/monitoramento/{id}', 'MonitoramentoController@store')->name('paciente.monitoramento');
  Route::post('/admin/paciente/saude-mental/{id}', 'SaudeMentalController@store')->name('paciente.saude-mental');
  Route::post('/admin/paciente/internacao/{id}', 'ServicoInternacaoController@store')->name('paciente.internacao');
  Route::post('/admin/paciente/insumos/{id}', 'InsumosOferecidoController@store')->name('paciente.insumos');

  Route::get('/admin/paciente/exportar', 'PacienteController@ExportarExcelPacientes')->name('paciente/exportar');

  Route::get('/admin/charts', 'ChartsController@index')->name('admin/charts');
  Route::get('chart/novos_casos_monitorados', 'ChartsController@novos_casos_monitorados')->name('chart.novos-casos');
  Route::get('chart/monitorados_exclusivo_psicologia', 'ChartsController@monitorados_exclusivo_psicologia')->name('chart.monitorados-exclusivo-psicologia');
  Route::get('chart/situacao_total_casos_monitorados', 'ChartsController@situacao_total_casos_monitorados')->name('chart.situacao-total-casos-monitorados');
  Route::get('chart/situacao_total_casos_monitorados_1', 'ChartsController@situacao_total_casos_monitorados_1')->name('chart.situacao-total-casos-monitorados-1');
  Route::get('chart/casos_monitorados_por_cidade', 'ChartsController@casos_monitorados_por_cidade')->name('chart.casos-monitorados-por-cidade');
  Route::get('chart/raca_cor_geral', 'ChartsController@raca_cor_geral')->name('chart.raca-cor-geral');
  Route::get('chart/genero_por_raca_cor', 'ChartsController@genero_por_raca_cor')->name('chart.genero-por-raca-cor');
  Route::get('chart/faixa_etaria_genero', 'ChartsController@faixa_etaria_genero')->name('chart.faixa-etaria-genero');
  Route::get('chart/faixa_etaria_genero_2', 'ChartsController@faixa_etaria_genero_2')->name('chart.faixa-etaria-genero-2');
  Route::get('chart/faixa_etaria_raca_cor', 'ChartsController@faixa_etaria_raca_cor')->name('chart.faixa-etaria-raca-cor');
  Route::get('chart/numero_pessoas_residencia_raca_cor', 'ChartsController@numero_pessoas_residencia_raca_cor')->name('chart.numero-pessoas-residencia-raca-cor');
  Route::get('chart/classe_social_renda_bruta_familiar', 'ChartsController@classe_social_renda_bruta_familiar')->name('chart.classe-social-renda-bruta-familiar');
  Route::get('chart/classe_social_renda_per_capta_raca_cor', 'ChartsController@classe_social_renda_per_capta_raca_cor')->name('chart.classe-social-renda-per-capta-raca-cor');
  Route::get('chart/raca_cor_por_auxilio_emergencial', 'ChartsController@raca_cor_por_auxilio_emergencial')->name('chart.raca-cor-por-auxilio-emergencial');
  Route::get('chart/insumos_oferecidos_pelo_projeto', 'ChartsController@insumos_oferecidos_pelo_projeto')->name('chart.insumos-oferecidos-pelo-projeto');
  Route::get('chart/tratamento_prescrito_por_medico_projeto', 'ChartsController@tratamento_prescrito_por_medico_projeto')->name('chart.tratamento-prescrito-por-medico-projeto');
  Route::get('chart/tratamento_financiado', 'ChartsController@tratamento_financiado')->name('chart.tratamento-financiado');
  Route::get('chart/dias_sintoma_por_raca_cor', 'ChartsController@dias_sintoma_por_raca_cor')->name('chart.dias-sintoma-por-raca-cor');
  Route::get('chart/dias_sintoma_mais_menos_dez_dias', 'ChartsController@dias_sintoma_mais_menos_dez_dias')->name('chart.dias-sintoma-mais-menos-dez-dias');
  Route::get('chart/total_dias_monitoramento_relacao_covid', 'ChartsController@total_dias_monitoramento_relacao_covid')->name('chart.total-dias-monitoramento-relacao-covid');
  Route::get('chart/casos_monitorados_por_agente', 'ChartsController@casos_monitorados_por_agente')->name('chart.casos-monitorados-por-agente');
  Route::get('chart/casos_avaliados_equipe_medica', 'ChartsController@casos_avaliados_equipe_medica')->name('chart.casos-avaliados-equipe-medica');
  Route::get('chart/acompanhamento_psicologico', 'ChartsController@acompanhamento_psicologico')->name('chart.acompanhamento-psicologico');
});
