<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PacienteController extends Controller
{
  public function index()
  {
    $pacientes = User::where('role', 'paciente')->get();

    return view('pages.paciente.index')->with(compact('pacientes'));
  }

  public function add()
  {
    return view('pages.paciente.create');
  }

  public function edit($id)
  {
    $paciente = User::find($id);
    $dados = $paciente->paciente;
    $sintomas = $dados->sintomas;
    $ajudas = $dados->tipos_ajuda;
    $emocional = $dados->estado_emocional;
    $observacao = $dados->observacao;
    $cronicas = $dados->doencas_cronicas;
    $items = $dados->items;

    return view('pages.paciente.edit')->with(compact('paciente','dados', 'sintomas', 'ajudas', 'emocional', 'observacao', 'cronicas', 'items'));
  }
}
