<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Agente;
use App\Medico;

class PacienteController extends Controller
{
  public function index()
  {
    $pacientes = Paciente::get();

    return view('pages.paciente.index')->with(compact('pacientes'));
  }

  public function add()
  {
    $agentes = Agente::get();
    $medicos = Medico::get();

    return view('pages.paciente.create')->with(compact('agentes', 'medicos'));
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

    return view('pages.paciente.edit')->with(compact('paciente', 'sintomas', 'ajudas', 'emocional', 'observacao', 'cronicas', 'items', 'agentes', 'medicos'));
  }
}
