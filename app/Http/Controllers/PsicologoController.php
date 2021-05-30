<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserSaude;
use App\Actions\UpdateUserSaude;
use App\Enums\RolesEnum;
use App\Http\Requests\UserSaudeStoreRequest;
use App\Http\Requests\UserSaudeUpdateRequest;
use App\Models\Psicologo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PsicologoController extends Controller
{
    public function index()
    {
        $psicologos = Psicologo::with('user')->get();
        return view('pages.psicologo.index')->with(compact('psicologos'));
    }

    public function create()
    {
        return view('pages.psicologo.create');
    }

    public function store(UserSaudeStoreRequest $request)
    {
        $dataForm = $request->validated();

        try {
            $user = CreateUserSaude::create(Psicologo::class, $dataForm, RolesEnum::PSICOLOGO);

            return redirect(route('psicologos.edit', $user->psicologo))->with('success', 'Cadastro efetuado com sucesso.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('psicologos.index'));
    }

    public function edit(Psicologo $psicologo)
    {
        return view('pages.psicologo.edit')->with(compact('psicologo'));
    }

    public function update(UserSaudeUpdateRequest $request, Psicologo $psicologo)
    {
        $dataForm = $request->validated();

        try {
            $medico = UpdateUserSaude::update($psicologo, $dataForm);
            return redirect(route('psicologos.edit', $psicologo))->with('success', 'Cadastro atualizado.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('psicologos.edit', $medico));
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
            Log::info($e);
            return redirect('admin/psicologo')->with('error', 'Não foi possível realizar esta operação.');
        }
    }
}
