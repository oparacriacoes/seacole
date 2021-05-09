<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinacaoRequest;
use App\Models\Vacina;
use App\Models\Vacinacao;
use App\Paciente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacinacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VacinacaoRequest $request, Paciente $paciente)
    {
        $dataForm = $request->validated();

        try {
            $vacina = Vacina::findOrFail($dataForm['vacina_id']);

            if (!$this->canUseVacina($paciente, $vacina)) {
                throw new Exception("Vacina diferente da vacina esperada");
            }

            $paciente->vacinacao()->create($dataForm);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $request->validated());
            return back()
                ->with('error', 'Não foi possível adiciona nova vacinacao')
                ->with('tab', 'vacinacao');
        }

        return back()
            ->with('success', 'Vacinação inserida com sucesso!')
            ->with('tab', 'vacinacao');
    }

    private function canUseVacina(Paciente $paciente, Vacina $vacina): bool
    {
        $ultima_vacinacao = $paciente->vacinacao()->latest()->first();

        if (!$ultima_vacinacao) {
            return true;
        }

        if ($ultima_vacinacao->vacina->doses >= 1 && $ultima_vacinacao->dose == $ultima_vacinacao->vacina->doses) {
            return true;
        }

        return $vacina->id === $ultima_vacinacao->vacina->id;
    }
}
