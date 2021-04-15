<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaudeMentalRequest;
use App\Paciente;
use Illuminate\Http\Request;
use App\SaudeMental;
use DB;
use Illuminate\Support\Facades\Log;

class SaudeMentalController extends Controller
{
    public function __invoke(SaudeMentalRequest $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $dataForm = $request->validated();

        try {
            $paciente->saude_mental()->updateOrCreate(
                ['paciente_id' => $paciente->id],
                $dataForm
            );
            return back()
                ->with('success', 'Dados atualizados com sucesso.')
                ->with('tab', 'saude_mental');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()
                ->with('error', 'Não foi possível realizar a operação.')
                ->with('tab', 'saude_mental');
        }
    }
}
