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
        //'forceIFrame' => true,
        'is3D' => true,
        'colors' => ['#000', '#996633', '#e6e6e6', '#ffff00', '#ff3300', '#66ccff'],
    ]);
    //RAÇA COR GERAL - FIM

    //GENERO POR RAÇA-COR
    $preta_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'homem cis'"));
    $parda_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'homem cis'"));
    $branca_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'homem cis'"));
    $amarela_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'homem cis'"));
    $indigena_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'homem cis'"));

    $preta_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'mulher cis'"));
    $parda_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'mulher cis'"));
    $branca_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'mulher cis'"));
    $amarela_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'mulher cis'"));
    $indigena_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'mulher cis'"));

    $preta_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'homem trans'"));
    $parda_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'homem trans'"));
    $branca_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'homem trans'"));
    $amarela_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'homem trans'"));
    $indigena_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'homem trans'"));

    $preta_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'mulher trans'"));
    $parda_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'mulher trans'"));
    $branca_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'mulher trans'"));
    $amarela_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'mulher trans'"));
    $indigena_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'mulher trans'"));

    $preta_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'não binário'"));
    $parda_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'não binário'"));
    $branca_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'não binário'"));
    $amarela_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'não binário'"));
    $indigena_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'não binário'"));

    $preta_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero IS NULL"));
    $parda_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero IS NULL"));
    $branca_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero IS NULL"));
    $amarela_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero IS NULL"));
    $indigena_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero IS NULL"));

    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Preta')
            ->addNumberColumn('Parda')
            ->addNumberColumn('Branca')
            ->addNumberColumn('Amarela')
            ->addNumberColumn('Indígena')
            ->addRow(['homem cis', $preta_homem_cis, $parda_homem_cis, $branca_homem_cis, $amarela_homem_cis, $indigena_homem_cis])
            ->addRow(['homem trans', $preta_homem_trans, $parda_homem_trans, $branca_homem_trans, $amarela_homem_trans, $indigena_homem_trans])
            ->addRow(['mulher cis', $preta_mulher_cis, $parda_mulher_cis, $branca_mulher_cis, $amarela_mulher_cis, $indigena_mulher_cis])
            ->addRow(['mulher trans', $preta_mulher_trans, $parda_mulher_trans, $branca_mulher_trans, $amarela_mulher_trans, $indigena_mulher_trans])
            ->addRow(['não binário', $preta_nao_binario, $parda_nao_binario, $branca_nao_binario, $amarela_nao_binario, $indigena_nao_binario])
            ->addRow(['não informado', $preta_nao_informado, $parda_nao_informado, $branca_nao_informado, $amarela_nao_informado, $indigena_nao_informado]);
    Lava::ColumnChart('GeneroRacaCor', $cases, [
        'forceIFrame' => true,
        'isStacked' => true,
        'colors' => ['#000', '#996633', '#e6e6e6', '#ffff00', '#ff3300', '#66ccff'],
        'legend' => ['position' => 'top'],
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //GENERO POR RAÇA-COR FIM

    //GENERO POR RAÇA-COR
    $preta_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'homem cis'"));
    $parda_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'homem cis'"));
    $branca_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'homem cis'"));
    $amarela_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'homem cis'"));
    $indigena_homem_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'homem cis'"));

    $preta_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'mulher cis'"));
    $parda_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'mulher cis'"));
    $branca_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'mulher cis'"));
    $amarela_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'mulher cis'"));
    $indigena_mulher_cis = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'mulher cis'"));

    $preta_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'homem trans'"));
    $parda_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'homem trans'"));
    $branca_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'homem trans'"));
    $amarela_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'homem trans'"));
    $indigena_homem_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'homem trans'"));

    $preta_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'mulher trans'"));
    $parda_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'mulher trans'"));
    $branca_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'mulher trans'"));
    $amarela_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'mulher trans'"));
    $indigena_mulher_trans = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'mulher trans'"));

    $preta_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero = 'não binário'"));
    $parda_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero = 'não binário'"));
    $branca_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero = 'não binário'"));
    $amarela_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero = 'não binário'"));
    $indigena_nao_binario = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero = 'não binário'"));

    $preta_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Preta' AND identidade_genero IS NULL"));
    $parda_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Parda' AND identidade_genero IS NULL"));
    $branca_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Branca' AND identidade_genero IS NULL"));
    $amarela_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Amarela' AND identidade_genero IS NULL"));
    $indigena_nao_informado = count(DB::select("SELECT cor_raca FROM `pacientes` WHERE cor_raca = 'Indígena' AND identidade_genero IS NULL"));

    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Preta')
            ->addNumberColumn('Parda')
            ->addNumberColumn('Branca')
            ->addNumberColumn('Amarela')
            ->addNumberColumn('Indígena')
            ->addRow(['homem cis', $preta_homem_cis, $parda_homem_cis, $branca_homem_cis, $amarela_homem_cis, $indigena_homem_cis])
            ->addRow(['homem trans', $preta_homem_trans, $parda_homem_trans, $branca_homem_trans, $amarela_homem_trans, $indigena_homem_trans])
            ->addRow(['mulher cis', $preta_mulher_cis, $parda_mulher_cis, $branca_mulher_cis, $amarela_mulher_cis, $indigena_mulher_cis])
            ->addRow(['mulher trans', $preta_mulher_trans, $parda_mulher_trans, $branca_mulher_trans, $amarela_mulher_trans, $indigena_mulher_trans])
            ->addRow(['não binário', $preta_nao_binario, $parda_nao_binario, $branca_nao_binario, $amarela_nao_binario, $indigena_nao_binario])
            ->addRow(['não informado', $preta_nao_informado, $parda_nao_informado, $branca_nao_informado, $amarela_nao_informado, $indigena_nao_informado]);
    Lava::ColumnChart('GeneroRacaCor', $cases, [
        'forceIFrame' => true,
        'isStacked' => true,
        'colors' => ['#000', '#996633', '#e6e6e6', '#ffff00', '#ff3300', '#66ccff'],
        'legend' => ['position' => 'top'],
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //GENERO POR RAÇA-COR FIM

    //FAIXA ETÁRIA POR GÊNERO
    $result = DB::select(
      "SELECT * FROM (SELECT identidade_genero as genero,
     CASE WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 4 THEN '0-4'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 9 THEN '5-9'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 14 THEN '10-14'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 19 THEN '15-19'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 24 THEN '20-24'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 29 THEN '25-29'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 34 THEN '30-34'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 39 THEN '35-39'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 44 THEN '40-44'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 49 THEN '45-49'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 54 THEN '50-54'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 59 THEN '55-59'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 64 THEN '60-64'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 69 THEN '65-69'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 74 THEN '70-74'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 79 THEN '75-79'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 84 THEN '80-84'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 89 THEN '85-89'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 94 THEN '90-94'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 99 THEN '95-99'
     WHEN (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m') - (DATE_FORMAT(NOW(), '%Y-%m-%d') < DATE_FORMAT(STR_TO_DATE(data_nascimento, '%d/%m/%Y'), '%Y-%m'))) <= 104 THEN '100-104' END AS age,
      COUNT(*) as total_casos
      FROM pacientes
      GROUP BY age, identidade_genero ) as casos");

      //['Age', 'Male', {role: 'annotation'}, 'Female', {role: 'annotation'}],
      //['0-4 years', 11, 11, -6, 6],['5-11 years', 12, 12, -13, 13],['12-17 years', 15, 15, -4, 4],['18-59 years', 11, 11, -20, 20],['60+ years', 6, 6, -3, 3]            ];


    $this->identidades = Lava::DataTable();
    $this->identidades->addStringColumn('Idade')
          //->addNumberColumn('Idade')
          ->addNumberColumn('Mulher')
          //->addRoleColumn('string', 'annotation')
          ->addNumberColumn('Homem')
          //->addRoleColumn('string', 'annotation')
          ->addNumberColumn('Não-binário')
          //->addRoleColumn('string', 'annotation')
          ->addNumberColumn('Outros')
          //->addRoleColumn('string', 'annotation')
          /*->addRoleColumn('string', 'annotation')*/;
          //->addRoleColumn('string', 'annotation');
          /*$cases->addRow(['0-4 years', -6, 6])
                ->addRow(['5-11 years', -13, 13])
                ->addRow(['12-17 years', -4, 4]);*/

          /*,
          ['18-59 years', 11, 11, -20, 20],
          ['60+ years', 6, 6, -3, 3]*/
            foreach($result as $key => $value){
              /*if( strpos($value->genero, 'mulher') !== false ){
                $this->identidades->addRow([$value->genero . '(' . $value->age . ')', '-'.$value->total_casos]);
              }
              if( strpos($value->genero, 'homem') !== false ){
                $this->identidades->addRow([$value->genero . '(' . $value->age . ')', $value->total_casos]);
              }*/

              //$cases->addRow([$value->genero . '(' . $value->age . ')', strpos($value->genero, 'mulher') !== false ? '-'.$value->total_casos : NULL, strpos($value->genero, 'homem') !== false ? $value->total_casos : NULL]);
              $this->identidades->addRow([
                $value->genero ? $value->age . '(' . $value->genero . ')' : NULL,
                strpos($value->genero, 'mulher') !== false ? '-'.$value->total_casos : NULL,
                //$value->genero,
                strpos($value->genero, 'homem') !== false ? $value->total_casos : NULL,
                //$value->genero,
                strpos($value->genero, 'não-binário') !== false ? $value->total_casos : NULL,
                //$value->genero,
                strpos($value->genero, 'outros') !== false ? $value->total_casos : NULL,
                //$value->genero,
              ]);
            }

    Lava::BarChart('FaixaEtariaGenero', $this->identidades, [
        'forceIFrame' => true,
        'isStacked' => true,
        'colors' => ['#ff66ff', '#3399ff', '#cc66ff', '#00cc66'],
        'legend' => ['position' => 'top', 'alignment' => 'center'],
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //FAIXA ETÁRIA POR GÊNERO - FIM

    return view('graphs')->with([
      'negra' => $preta + $parda,
      'raca_total' => $preta + $parda + $branca + $amarela + $indigena + $nao_informado,
      'cis_negras' => $preta_mulher_cis + $parda_mulher_cis,
      'cis_negros' => $preta_homem_cis + $parda_homem_cis,
      'trans_negras' => $preta_mulher_trans + $parda_mulher_trans,
      'trans_negros' => $preta_homem_trans + $parda_homem_trans,
      'nao_binarios' => $preta_nao_binario + $parda_nao_binario,
      'nao_informados' => $preta_nao_informado + $parda_nao_informado,
    ]);
  }
}
