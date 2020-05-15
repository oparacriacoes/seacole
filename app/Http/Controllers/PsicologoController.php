<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psicologo;

class PsicologoController extends Controller
{
  public function index()
  {
    $psicologos = Psicologo::get();

    return view('pages.psicologo.index')->with(compact('psicologos'));
  }

  public function add()
  {
    return view('pages.psicologo.create');
  }

  public function edit($id)
  {
    $psicologo = Psicologo::find($id);

    return view('pages.psicologo.edit')->with(compact('psicologo'));
  }
}
