<?php

namespace App\Http\Controllers;

use App\Helpers\SerializerFields;
use App\Http\Requests\InsumosOferecidoUpdateRequest;
use App\Paciente;
use Illuminate\Support\Facades\Log;

class InsumosOferecidoController extends Controller
{
    use SerializerFields;

    public function store(InsumosOferecidoUpdateRequest $request, $id)
    {
        $pacient = Paciente::find($id);
        $request_data = $this->serializerFields(['precisa_tipo_ajuda', 'tratamento_financiado', 'material_entregue'], $request->validated());

        try {
            $pacient->insumos_oferecidos()->updateOrCreate(['paciente_id' => $pacient->id], $request_data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Não foi  possível realizar a operação.');
        }

        return back()->with('success', 'Dados atualizados com sucesso.');
    }
}
