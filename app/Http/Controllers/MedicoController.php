<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;
use App\User;
use DB;

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

  public function destroy($id)
  {
    $medico = Medico::find($id);
    $user = User::find($medico->user_id);

    DB::beginTransaction();
    try {
      $delete_medico = Medico::destroy($id);
      $delete_user = User::destroy($user->id);
      DB::commit();
      return redirect('admin/medico')->with('success', 'Médico excluído com sucesso.');
    } catch (\Exception $e) {
      DB::rollback();
      \Log::info($e);
      return redirect('admin/medico')->with('error', 'Não foi possível realizar esta operação.');
    }

    return redirect()->back()->with('success', 'Médico excluído com sucesso.');
  }

}
