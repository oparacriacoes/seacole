<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\User;
use DB;

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

    public function destroy($id)
    {
        $agente = Agente::find($id);
        $user = User::find($agente->user_id);

        DB::beginTransaction();
        try {
            $delete_agente = Agente::destroy($id);
            $delete_user = User::destroy($user->id);
            DB::commit();
            return redirect('admin/agente')->with('success', 'Agente excluído com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect('admin/agente')->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect()->back()->with('success', 'Agente removido com sucesso.');
    }
}
