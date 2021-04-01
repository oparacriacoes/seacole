<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaudeMental;
use DB;

class SaudeMentalController extends Controller
{
    public function store(Request $request, $id)
    {
        $saude = SaudeMental::where('paciente_id', $id)->first();

        $dados = [
      'paciente_id' => $id,
      'quadro_atual' => $request->quadro_atual,
      'detalhes_medos' => $request->detalhes_medos,
    ];

        if (!$saude) {
            DB::beginTransaction();
            try {
                $saude = SaudeMental::create($dados);
                DB::commit();
                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a operação.');
            }
        } else {
            DB::beginTransaction();
            try {
                $saude->update($dados);
                DB::commit();
                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a operação.');
            }
        }
    }
}
