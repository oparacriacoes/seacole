<?php

namespace App\Http\Controllers;

use App\Events\SintomaEvolucao;
use App\Models\EvolucaoSintoma;
use App\Http\Requests\MonitoramentoUpdateRequest;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;

class MonitoramentoController extends Controller
{
    public function __invoke(MonitoramentoUpdateRequest $request, Paciente $paciente)
    {
        $dataForm = $request->validated();

        try {
            $paciente->monitoramento()->updateOrCreate(
                ['paciente_id' => $paciente->id],
                $dataForm
            );

            $evolucao_sintoma = $paciente->prontuarios()->create($dataForm);
            event(new SintomaEvolucao($evolucao_sintoma));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()
                ->with('error', 'Não foi possível realizar a operação.')
                ->with('tab', 'monitoramento');
        }

        return back()
            ->with('success', 'Dados atualizados com sucesso.')
            ->with('tab', 'monitoramento');
    }
}
