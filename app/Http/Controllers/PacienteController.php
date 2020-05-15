<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Paciente;
use App\Agente;
use App\Medico;
use App\Psicologo;
use App\EvolucaoSintoma;

class PacienteController extends Controller
{
  public function index()
  {
    if( Auth::user()->role === 'agente' ){
      $pacientes = Auth::user()->agente->pacientes;
    } elseif ( Auth::user()->role === 'medico' ) {
      $pacientes = Auth::user()->medico->pacientes;
    } else {
      $pacientes = Paciente::get();
    }

    return view('pages.paciente.index')->with(compact('pacientes'));
  }

  public function add()
  {
    $agentes = Agente::get();
    $medicos = Medico::get();
    $psicologos = Psicologo::all();

    return view('pages.paciente.create')->with(compact('agentes', 'medicos', 'psicologos'));
  }

  public function edit($id)
  {
    $paciente = Paciente::find($id);
    $sintomas = $paciente->sintomas;
    $ajudas = $paciente->tipos_ajuda;
    $emocional = $paciente->estado_emocional;
    $observacao = $paciente->observacao;
    $cronicas = $paciente->doencas_cronicas;
    $items = $paciente->items;
    $agentes = Agente::get();
    $medicos = Medico::get();
    $psicologos = Psicologo::all();
    $dados = $paciente->dados;

    return view('pages.paciente.edit')->with(compact('paciente', 'sintomas', 'ajudas', 'emocional', 'observacao', 'cronicas', 'items', 'agentes', 'medicos', 'psicologos', 'dados'));
  }
}
