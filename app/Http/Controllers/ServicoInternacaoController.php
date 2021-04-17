<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoInternacaoUpdateRequest;
use App\Paciente;
use App\ServicoInternacao;
use Illuminate\Support\Facades\Log;

class ServicoInternacaoController extends Controller
{
    public function __invoke(ServicoInternacaoUpdateRequest $request, Paciente $paciente)
    {
        $dataForm = $request->validated();

        try {
            $paciente->servico_internacao()->updateOrCreate(
                ['paciente_id' => $paciente->id],
                $dataForm
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()
                ->with('error', 'Não foi possível realizar a operação.')
                ->with('tab', 'servicos_internacao');
        }

        return back()
            ->with('success', 'Dados atualizados com sucesso.')
            ->with('tab', 'servicos_internacao');
    }
}
