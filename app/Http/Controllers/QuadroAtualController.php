<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Http\Requests\QuadroAtualUpdateRequest;
use Illuminate\Support\Facades\Log;

class QuadroAtualController extends Controller
{
    public function __invoke(QuadroAtualUpdateRequest $request, Paciente $paciente)
    {
        $dataForm = $request->validated();

        try {
            $paciente->quadro_atual()->updateOrCreate(
                ['paciente_id' => $paciente->id],
                $dataForm
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()
                ->with('error', 'Não foi possível realizar a operação.')
                ->with('tab', 'quadro_atual');
        }

        return back()
            ->with('success', 'Dados atualizados com sucesso.')
            ->with('tab', 'quadro_atual');
    }
}
