<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AgenteController extends Controller
{
  public function index()
  {
    $agentes = User::where('role', 'agente')->get();

    return view('pages.agente.index')->with(compact('agentes'));
  }

  public function add()
  {
    return view('pages.agente.create');
  }

  public function edit($id)
  {
    $agente = User::find($id);
    $dados = $agente->agente;

    return view('pages.agente.edit')->with(compact('agente','dados'));
  }
}
