<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuadroAtual;
use DB;

class QuadroAtualController extends Controller
{
  public function index()
  {
    return 'QuadroAtualController @ index';
  }

  public function store(Request $request)
  {
    $quadro = QuadroAtual::where('paciente_id', $request->paciente_id)->first();

    $dados = [
      'paciente_id' => $request->paciente_id,
      'primeira_sintoma' => $request->primeira_sintoma,
      'sintomas_manifestados' => serialize($request->sintomas_manifestados),
      'temperatura_max' => $request->temperatura_max,
      'saturacao_baixa' => $request->saturacao_baixa,
      'frequencia_max' => $request->frequencia_max,
      'data_temp_max' => $request->data_temp_max,
      'data_sat_max' => $request->data_sat_max,
      'data_freq_max' => $request->data_freq_max,
    ];

    if( !$quadro ){
      DB::beginTransaction();
      try {
        $quadro = QuadroAtual::create($dados);
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
        $quadro = $quadro->update($dados);
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
