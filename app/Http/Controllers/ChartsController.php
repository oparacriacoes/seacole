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
    $psicologia = DB::select("SELECT situacao FROM `pacientes` WHERE situacao = 5 OR situacao = 14");
    $total_psicologia = count($psicologia);
    $monitorados = DB::select("SELECT situacao FROM `pacientes` WHERE situacao IS NOT NULL");
    $total_monitorados = count($monitorados) - $total_psicologia;
    $nao_monitorados = DB::select("SELECT situacao FROM `pacientes` WHERE situacao IS NULL");
    $total_nao_monitorados = count($nao_monitorados);

    $cases = Lava::DataTable();
    $cases->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Monitorados(exclusivo psicologia)', $total_psicologia])
            ->addRow(['Monitorados(sem psicologia)', $total_monitorados])
            ->addRow(['Sem necessidade de monitoramento', $total_nao_monitorados]);
    Lava::DonutChart('MonitoradosExclusivoPsicologia', $cases, [
        'pieHole' => 0.5,
        'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORADOS X EXCLUSIVO PSICOLOGIA FIM

    //MONITORAMENTO X CADASTRADO
    $monitorados = Monitoramento::select('paciente_id')->groupBy('paciente_id')->get();
    $cadastrados = Paciente::all();
    $total_monitorados = count($monitorados);
    $total_cadastrados = count($cadastrados);
    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Casos')
            ->addRow(['Monitorados', $total_monitorados])
            ->addRow(['Cadastrados', $total_cadastrados]);
    Lava::DonutChart('MonitoradosCadastrados2', $cases, [
        'forceIFrame' => true,
        'pieHole' => 0.5,
        'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORAMENTO X CADASTRADO (2) FIM

    //MONITORAMENTO X CADASTRADO (3)
    $monitorados = Monitoramento::select('paciente_id')->groupBy('paciente_id')->get();
    $cadastrados = Paciente::all();
    $total_monitorados = count($monitorados);
    $total_cadastrados = count($cadastrados);
    $cases = Lava::DataTable();
    $cases->addStringColumn('Casos')
            ->addNumberColumn('Casos')
            ->addRow(['Monitorados', $total_monitorados])
            ->addRow(['Cadastrados', $total_cadastrados]);
    Lava::ColumnChart('MonitoradosCadastrados3', $cases, [
        'forceIFrame' => true,
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORAMENTO X CADASTRADO (3) FIM

    //MUNICÍPIOS - INÍCIO
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
    //MUNICÍPIOS - FIM

    //SELECT COUNT(*) as total, endereco_cidade as cidade FROM `pacientes` GROUP BY endereco_cidade ORDER BY endereco_cidade ASC

    return view('graphs');
  }
}
