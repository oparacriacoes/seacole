<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;

class AgenteController extends Controller
{
  public function index()
  {
    $agentes = Agente::get();

    return view('pages.agente.index')->with(compact('agentes'));
  }

  public function add()
  {
    return view('pages.agente.create');
  }

  public function edit($id)
  {
    $agente = Agente::find($id);

    return view('pages.agente.edit')->with(compact('agente'));
  }
}
