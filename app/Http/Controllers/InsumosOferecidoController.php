<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsumosOferecido;
use DB;

class InsumosOferecidoController extends Controller
{
  public function store(Request $request, $id)
  {
    $insumos = InsumosOferecido::where('paciente_id', $id)->first();

    $dados = [
      'paciente_id' => $id,
      'condicao_ficar_isolada' => $request->condicao_ficar_isolada,
      'tem_comida' => $request->tem_comida,
      'tem_alguem' => $request->tem_alguem,
      'tarefas_autocuidado' => $request->tarefas_autocuidado,
      'precisa_tipo_ajuda' => $request->precisa_tipo_ajuda ? serialize($request->precisa_tipo_ajuda) : NULL,
      'tratamento_prescrito' => $request->tratamento_prescrito,
      'tratamento_financiado' => $request->tratamento_financiado ? serialize($request->tratamento_financiado) : NULL,
    ];

    if( !$insumos ){
      DB::beginTransaction();
      try {
        $insumos = InsumosOferecido::create($dados);
        DB::commit();
        return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
      } catch (\Exception $e) {
        DB::rollback();
        \Log::info($e);
        return redirect()->back()->with('error', 'Não foi  possível realizar a operação.');
      }
    } else {
      DB::beginTransaction();
      try {
        $insumos->update($dados);
        DB::commit();
        return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
      } catch (\Exception $e) {
        DB::rollback();
        \Log::info($e);
        return redirect()->back()->with('error', 'Não foi  possível realizar a operação.');
      }
    }
  }

}
