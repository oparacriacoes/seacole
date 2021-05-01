<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserSaude;
use App\Actions\UpdateUserSaude;
use App\Enums\RolesEnum;
use App\Http\Requests\UserSaudeStoreRequest;
use App\Http\Requests\UserSaudeUpdateRequest;
use Illuminate\Http\Request;
use App\Medico;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::with('user')->get();

        return view('pages.medico.index')->with(compact('medicos'));
    }

    public function create()
    {
        return view('pages.medico.create');
    }

    public function store(UserSaudeStoreRequest $request)
    {
        $dataForm = $request->validated();

        try {
            $user = CreateUserSaude::create(Medico::class, $dataForm, RolesEnum::MEDICO);

            return redirect(route('medicos.edit', $user->medico))->with('success', 'Cadastro efetuado com sucesso.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('medicos.index'));
    }

    public function edit(Medico $medico)
    {
        return view('pages.medico.edit')->with(compact('medico'));
    }

    public function update(UserSaudeUpdateRequest $request, Medico $medico)
    {
        $dataForm = $request->validated();

        try {
            $medico = UpdateUserSaude::update($medico, $dataForm);
            return redirect(route('medicos.edit', $medico))->with('success', 'Cadastro atualizado.');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('error', 'Não foi possível realizar esta operação.');
        }

        return redirect(route('medicos.edit', $medico));
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
