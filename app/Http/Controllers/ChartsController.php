<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;
use DB;
use Carbon\Carbon;
use App\Monitoramento;
use App\Paciente;

class ChartsController extends Controller
{
  public function index()
  {
    //CASOS MONITORADOS
    Carbon::setlocale(config('app.locale'));
    $psicologia_ativo = DB::select("SELECT DATE_FORMAT(STR_TO_DATE(data_inicio_monitoramento, '%d/%m/%Y'), '%Y-%m') as date, COUNT(*) as total_casos FROM pacientes WHERE situacao = 5 AND data_inicio_ac_psicologico IS NOT NULL GROUP BY date ORDER BY date");
    $psicologia_finalizado = DB::select("SELECT DATE_FORMAT(STR_TO_DATE(data_inicio_monitoramento, '%d/%m/%Y'), '%Y-%m') as date, COUNT(*) as total_casos FROM pacientes WHERE situacao = 14 AND data_inicio_ac_psicologico IS NOT NULL GROUP BY date ORDER BY date");
    $outras = DB::select("SELECT DATE_FORMAT(STR_TO_DATE(data_inicio_monitoramento, '%d/%m/%Y'), '%Y-%m') as date, COUNT(*) as total_casos FROM pacientes WHERE data_inicio_ac_psicologico IS NULL GROUP BY date ORDER BY date");
    $total_geral = array_merge($psicologia_ativo,$psicologia_finalizado,$outras);
    //$totals = DB::select("SELECT DATE_FORMAT(STR_TO_DATE(data_inicio_monitoramento, '%d/%m/%Y'), '%Y-%m') as date, COUNT(*) as total_casos, COUNT(data_inicio_ac_psicologico) as total_psico FROM pacientes GROUP BY date ORDER BY date");
    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos');
    $cases->addNumberColumn('Casos');
    $cases->addRoleColumn('string', 'annotation');
    $totals = array();
    //foreach($totals as $total){
    foreach($total_geral as $key => $value){
      //$cases->addRow([ucfirst(Carbon::parse($total->date)->translatedFormat('F Y')), $total->total_casos + $total->total_psico, $total->total_casos + $total->total_psico]);
      //$cases->addRow([ucfirst(Carbon::parse($value->date)->translatedFormat('F Y')), $value->total_casos]);
      array_push($totals, [$value->date => $value->total_casos]);
    };

    $final = array();

    array_walk_recursive($totals, function($item, $key) use (&$final){
        $final[$key] = isset($final[$key]) ?  $item + $final[$key] : $item;
    });

    ksort($final);

    foreach($final as $key => $value){
      $cases->addRow([ucfirst(Carbon::parse($key)->translatedFormat('F Y')), $value]);
    }

    Lava::LineChart('Casos Monitorados', $cases,[
      //'forceIFrame' => true,
      'vAxis' => ['title' => 'Total de casos'],
      'hAxis' => ['title' => 'Mês/Ano'],
      'pointSize' => 12,
      'pointShape' => 'square',
    ]);
    //CASOS MONITORADOS FIM

    //MONITORADOS X EXCLUSIVO PSICOLOGIA
    $psicologia = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 5 OR situacao = 14"));
    $monitorados = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao IS NOT NULL"));
    $nao_monitorados = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao IS NULL"));

    $cases = Lava::DataTable();
    $cases->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Monitorados(exclusivo psicologia)', $psicologia])
            ->addRow(['Monitorados(sem psicologia)', $monitorados])
            ->addRow(['Sem necessidade de monitoramento', $nao_monitorados]);
    Lava::DonutChart('MonitoradosExclusivoPsicologia', $cases, [
        'pieHole' => 0.5,
        'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORADOS X EXCLUSIVO PSICOLOGIA FIM

    //SITUAÇÃO TOTAL DE CASOS MONITORADOS
    $ativo_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 1"));
    $ativo_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 2"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 3"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 3"));
    $outras_situacoes = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 4"));
    $exclusivo_psicologia_ativo = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 5"));
    $monitoramento_encerrado_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 6"));
    $monitoramento_encerrado_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 7"));
    $monitoramento_encerrado_contato = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 8"));
    $monitoramento_encerrado_outros = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 9"));
    $caso_finalizado_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 10"));
    $caso_finalizado_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 11"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 12"));
    $sem_relacao_covid = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 13"));
    $exclusivo_psicologia_finalizado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 14"));

    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Casos')
            ->addRow(['Caso ativo grave', $ativo_grave])
            ->addRow(['Caso ativo leve', $ativo_leve])
            ->addRow(['Contato caso confirmado - ativo', $contato_caso_confirmado])
            ->addRow(['Outras situações (sem relação COVID-19) - ativos', $outras_situacoes])
            ->addRow(['Exclusivo psicologia - ativo', $exclusivo_psicologia_ativo])
            ->addRow(['Monitoramento encerrado grave', $monitoramento_encerrado_grave])
            ->addRow(['Monitoramento encerrado leve', $monitoramento_encerrado_leve])
            ->addRow(['Monitoramento encerrado contato', $monitoramento_encerrado_contato])
            ->addRow(['Monitoramento encerrado outros', $monitoramento_encerrado_outros])
            ->addRow(['Caso finalizado grave', $caso_finalizado_grave])
            ->addRow(['Caso finalizado leve', $caso_finalizado_leve])
            ->addRow(['Contato caso confirmado', $contato_caso_confirmado])
            ->addRow(['Outras situações (sem relação COVID-19) - finalizados', $sem_relacao_covid])
            ->addRow(['Exclusivo psicologia - finalizado', $exclusivo_psicologia_finalizado]);
    Lava::DonutChart('SituacaoTotalCasosMonitorados', $cases, [
        //'forceIFrame' => true,
        //'pieHole' => 0.5,
        'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //SITUAÇÃO TOTAL DE CASOS MONITORADOS FIM

    //SITUAÇÃO TOTAL DE CASOS MONITORADOS 1
    $ativo_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 1"));
    $ativo_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 2"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 3"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 3"));
    $outras_situacoes = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 4"));
    $exclusivo_psicologia_ativo = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 5"));
    $monitoramento_encerrado_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 6"));
    $monitoramento_encerrado_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 7"));
    $monitoramento_encerrado_contato = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 8"));
    $monitoramento_encerrado_outros = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 9"));
    $caso_finalizado_grave = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 10"));
    $caso_finalizado_leve = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 11"));
    $contato_caso_confirmado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 12"));
    $sem_relacao_covid = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 13"));
    $exclusivo_psicologia_finalizado = count(DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 14"));

    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Casos')
            ->addRow(['Caso ativo grave', $ativo_grave])
            ->addRow(['Caso ativo leve', $ativo_leve])
            ->addRow(['Contato caso confirmado - ativo', $contato_caso_confirmado])
            ->addRow(['Outras situações (sem relação COVID-19) - ativos', $outras_situacoes])
            ->addRow(['Exclusivo psicologia - ativo', $exclusivo_psicologia_ativo])
            ->addRow(['Monitoramento encerrado grave', $monitoramento_encerrado_grave])
            ->addRow(['Monitoramento encerrado leve', $monitoramento_encerrado_leve])
            ->addRow(['Monitoramento encerrado contato', $monitoramento_encerrado_contato])
            ->addRow(['Monitoramento encerrado outros', $monitoramento_encerrado_outros])
            ->addRow(['Caso finalizado grave', $caso_finalizado_grave])
            ->addRow(['Caso finalizado leve', $caso_finalizado_leve])
            ->addRow(['Contato caso confirmado', $contato_caso_confirmado])
            ->addRow(['Outras situações (sem relação COVID-19) - finalizados', $sem_relacao_covid])
            ->addRow(['Exclusivo psicologia - finalizado', $exclusivo_psicologia_finalizado]);
    Lava::ColumnChart('SituacaoTotalCasosMonitorados1', $cases, [
        'forceIFrame' => true,
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //SITUAÇÃO TOTAL DE CASOS MONITORADOS 1 FIM

    //CASOS MONITORADOS POR CIDADE - INÍCIO
    $totals = DB::select("SELECT COUNT(*) as total, endereco_cidade as cidade FROM `pacientes` GROUP BY endereco_cidade ORDER BY endereco_cidade ASC");
    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos');
    $cases->addNumberColumn('Casos');

    foreach($totals as $total){
      $cases->addRow([$total->cidade, $total->total]);
    }

    Lava::DonutChart('Municipios', $cases, [
        'forceIFrame' => true,
    ]);
    //CASOS MONITORADOS POR CIDADE - FIM

    //RAÇA COR GERAL - INÍCIO
    $preta = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta'"));
    $parda = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda'"));
    $branca = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca'"));
    $amarela = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela'"));
    $indigena = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena'"));
    $nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca IS NULL"));
    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos');
    $cases->addNumberColumn('Casos')
          ->addRow(['Preta', $preta])
          ->addRow(['Parda', $parda])
          ->addRow(['Branca', $branca])
          ->addRow(['Amarela', $amarela])
          ->addRow(['Indígena', $indigena])
          ->addRow(['Não informado', $nao_informado]);

    Lava::PieChart('RacaCorGeral', $cases, [
        'forceIFrame' => true,
        'is3D' => true,
        'colors' => ['#000', '#996633', '#e6e6e6', '#ffff00', '#ff3300', '#66ccff'],
    ]);
    //RAÇA COR GERAL - FIM


    return view('graphs')->with([
      'preta' => $preta,
      'parda' => $parda,
    ]);
  }
}
