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
    $totals = DB::select("SELECT DATE_FORMAT(STR_TO_DATE(data_inicio_monitoramento, '%d/%m/%Y'), '%Y-%m') as date, COUNT(*) as total_casos, COUNT(data_inicio_ac_psicologico) as total_psico FROM pacientes GROUP BY date ORDER BY date");
    $cases  = Lava::DataTable();
    $cases->addStringColumn('Casos');
    $cases->addNumberColumn('Casos');
    $cases->addRoleColumn('string', 'annotation');
    foreach($totals as $total){
      $cases->addRow([ucfirst(Carbon::parse($total->date)->translatedFormat('F Y')), $total->total_casos + $total->total_psico, $total->total_casos + $total->total_psico]);
    }
    Lava::LineChart('Casos Monitorados', $cases,[
      //'forceIFrame' => true,
      'vAxis' => ['title' => 'Total de casos'],
      'hAxis' => ['title' => 'Mês/Ano'],
      'pointSize' => 12,
      'pointShape' => 'square',
    ]);
    //CASOS MONITORADOS FIM

    //MONITORAMENTO X CADASTRADO
    $monitorados = Monitoramento::select('paciente_id')->groupBy('paciente_id')->get();
    $cadastrados = Paciente::all();
    $total_monitorados = count($monitorados);
    $total_cadastrados = count($cadastrados);
    $cases = Lava::DataTable();
    $cases->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Monitorados', $total_monitorados])
            ->addRow(['Cadastrados', $total_cadastrados]);
    Lava::DonutChart('IMDB', $cases, [
        'forceIFrame' => true,
        'pieHole' => 0.5,
        'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORAMENTO X CADASTRADO (2) FIM

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
    Lava::DonutChart('IMDB', $cases, [
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
    Lava::ColumnChart('IMDB', $cases, [
        'forceIFrame' => true,
        //'pieHole' => 0.5,
        //'pieSliceTextStyle' => ['fontSize' => 10],
    ]);
    //MONITORAMENTO X CADASTRADO (3) FIM

    return view('dashboard');
  }
}
