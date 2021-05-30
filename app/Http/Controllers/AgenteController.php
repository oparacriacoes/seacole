<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserSaude;
use App\Actions\UpdateUserSaude;
use Illuminate\Http\Request;
use App\Models\Agente;
use App\Enums\RolesEnum;
use App\Http\Requests\UserSaudeStoreRequest;
use App\Http\Requests\UserSaudeUpdateRequest;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AgenteController extends Controller
{
    public function index()
    {
        $agentes = Agente::with('user')->get();
        return view('pages.agente.index')->with(compact('agentes'));
    }

    public function create()
    {
        return view('pages.agente.create');
    }

    public function store(UserSaudeStoreRequest $request)
    {
        $dataForm = $request->validated();

        try {
            $user = CreateUserSaude::create(Agente::class, $dataForm, RolesEnum::AGENTE);

            return redirect(route('agentes.edit', $user->agente))->with('success', 'Cadastro efetuado com sucesso.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('agentes.index'));
    }

    public function edit(Agente $agente)
    {
        return view('pages.agente.edit')->with(compact('agente'));
    }

    public function update(UserSaudeUpdateRequest $request, Agente $agente)
    {
        $dataForm = $request->validated();

        try {
            $agente = UpdateUserSaude::update($agente, $dataForm);
            return redirect(route('agentes.edit', $agente))->with('success', 'Cadastro atualizado.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('agentes.edit', $agente));
    }

    public function destroy(Agente $agente)
    {
        $user = User::find($agente->user_id);

        DB::beginTransaction();
        try {
            $delete_agente = Agente::destroy($agente->id);
            $delete_user = User::destroy($user->id);
            DB::commit();
            return redirect('admin/agente')->with('success', 'Agente excluído com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);
            return redirect('admin/agente')->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect()->back()->with('success', 'Agente removido com sucesso.');
    }
}
