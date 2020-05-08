<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;

class MedicoController extends Controller
{
  public function index()
  {
    $medicos = Medico::get();

    return view('pages.medico.index')->with(compact('medicos'));
  }

  public function add()
  {
    return view('pages.medico.create');
  }

  public function edit($id)
  {
    $medico = Medico::find($id);

    return view('pages.medico.edit')->with(compact('medico'));
  }
}
