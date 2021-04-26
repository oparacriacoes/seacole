<?php

namespace App\Http\Controllers;

use App\AjudaTipo;
use App\Exports\PacientesExport;
use App\Sintoma;
use App\Paciente;
use App\Agente;
use App\Medico;
use App\Psicologo;
use App\User;
use App\Articuladora;
use App\Enums\RolesEnum;
use App\Enums\SituacoesCaso;
use App\Http\Requests\PacienteRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === RolesEnum::AGENTE || $user->role === RolesEnum::PSICOLOGO || $user->role === RolesEnum::MEDICO) {
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
            'prontuarios'
        ]);

        $paciente->saude_mental = $paciente->saude_mental()->firstOrCreate(); // TODO whats happenning

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
        $user = User::find($paciente->user_id);
        $sintoma = Sintoma::where('paciente_id', $id)->first();
        if ($sintoma) {
            $delete_sintoma = Sintoma::destroy($sintoma->id);
        }

        $ajuda_tipo = AjudaTipo::where('paciente_id', $paciente->id)->first();
        if ($ajuda_tipo) {
            $delete_ajuda_tipo = AjudaTipo::destroy($ajuda_tipo->id);
        }

        $delete_paciente = Paciente::destroy($paciente->id);
        $delete_user = User::destroy($user->id);

        return redirect()->back()->with('success', 'Paciente excluído com sucesso.');
    }

    public function ExportarExcelPacientes()
    {
        $date = now();

        return Excel::download(new PacientesExport(), 'pacientes_' . $date->format('d-m-Y-h:m') . '.xlsx');
    }
}
