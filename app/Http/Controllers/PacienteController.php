<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Agente;
use App\Models\Medico;
use App\Models\Psicologo;
use App\Models\Articuladora;
use App\Enums\RolesEnum;
use App\Enums\SituacoesCaso;
use App\Http\Requests\PacienteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === RolesEnum::AGENTE || $user->role === RolesEnum::PSICOLOGO) {
            $pacienteQuery = $user->professional->pacientes->toQuery();
        } else {
            $pacienteQuery = Paciente::query();
        }

        $callbackUser = function ($query) {
            $query->select(['id', 'user_id'])->with('user:id,name');
        };

        $pacientes = $pacienteQuery
            ->select(['id', 'situacao', 'name', 'agente_id', 'medico_id', 'psicologo_id'])
            ->with([
                'agente' => $callbackUser,
                'medico' => $callbackUser,
                'psicologo' => $callbackUser,
            ])
            ->get();

        return view('pages.paciente.index', compact('pacientes'));
    }

    public function create()
    {
        $paciente = new Paciente();

        $situacoes = SituacoesCaso::readables();
        $agentes =  Agente::with('user:id,name')->select(['id', 'user_id'])->get();
        $medicos = Medico::with('user:id,name')->select(['id', 'user_id'])->get();
        $psicologos = Psicologo::with('user:id,name')->select(['id', 'user_id'])->get();
        $articuladoras = Articuladora::all();

        return view('pages.paciente.create')->with(compact(
            'situacoes',
            'paciente',
            'agentes',
            'medicos',
            'psicologos',
            'articuladoras',
        ));
    }

    public function store(PacienteRequest $request)
    {
        $dataForm = $request->validated();

        try {
            $paciente = Paciente::create($dataForm);
            return redirect()->route('pacientes.edit', $paciente)->with('success', 'Dados salvos com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Não foi possível realizar esta operação.');
        }
    }

    public function edit(Paciente $paciente)
    {
        $this->authorize('view', $paciente);

        $situacoes = SituacoesCaso::readables();

        $agentes =  Agente::with('user:id,name')->select(['id', 'user_id'])->get();
        $medicos = Medico::with('user:id,name')->select(['id', 'user_id'])->get();
        $psicologos = Psicologo::with('user:id,name')->select(['id', 'user_id'])->get();
        $articuladoras = Articuladora::all();

        $paciente->load([
            'insumos_oferecidos',
            'servico_internacao',
            'quadro_atual',
            'monitoramento',
            'prontuarios',
        ]);

        $paciente->saude_mental = $paciente->saude_mental()->firstOrCreate(); // TODO whats happenning
        $paciente->vacinacao = $paciente->vacinacao()
            ->with(['vacina' => function ($query) {
                $query->withTrashed();
            }])->orderBy('data_vacinacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.paciente.edit', compact(
            'paciente',
            'agentes',
            'medicos',
            'psicologos',
            'articuladoras',
            'situacoes',
        ));
    }

    public function update(PacienteRequest $request, Paciente $paciente)
    {
        $this->authorize('update', $paciente);

        $dataForm = $request->validated();

        try {
            $paciente->update($dataForm);
            return redirect()->route('pacientes.edit', $paciente)->with('success', 'Dados salvos com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Não foi possível realizar esta operação.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        Paciente::destroy($paciente->id);

        return redirect()->back()->with('success', 'Paciente excluído com sucesso.');
    }
}
