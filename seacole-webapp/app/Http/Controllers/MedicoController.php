<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MedicoController extends Controller
{
  public function index()
  {
    $medicos = User::where('role', 'medico')->get();

    return view('pages.medico.index')->with(compact('medicos'));
  }

  public function add()
  {
    return view('pages.medico.create');
  }

  public function edit($id)
  {
    $medico = User::find($id);
    $dados = $medico->medico;

    return view('pages.medico.edit')->with(compact('medico','dados'));
  }
}
