<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psicologo;
use App\User;
use DB;

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

    public function destroy($id)
    {
        $psicologo = Psicologo::find($id);
        $user = User::find($psicologo->user_id);

        DB::beginTransaction();
        try {
            $delete_psicologo = Psicologo::destroy($id);
            $delete_user = User::destroy($user->id);
            DB::commit();
            return redirect('admin/psicologo')->with('success', 'Psicólogo excluído com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect('admin/psicologo')->with('error', 'Não foi possível realizar esta operação.');
        }
    }
}
