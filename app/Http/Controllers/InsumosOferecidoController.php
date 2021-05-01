<?php

namespace App\Http\Controllers;

use App\Helpers\SerializerFields;
use App\Http\Requests\InsumosOferecidoUpdateRequest;
use App\Paciente;
use Illuminate\Support\Facades\Log;

class InsumosOferecidoController extends Controller
{
    use SerializerFields;

    public function __invoke(InsumosOferecidoUpdateRequest $request, Paciente $paciente)
    {
        $formData = $request->validated();

        try {
            $paciente->insumos_oferecidos()->updateOrCreate(['paciente_id' => $paciente->id], $formData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Não foi  possível realizar a operação.');
        }

        return back()
            ->with('success', 'Dados atualizados com sucesso.')
            ->with('tab', 'insumos_oferecidos');
    }
}
