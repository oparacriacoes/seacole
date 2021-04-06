<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicoInternacao;
use DB;

class ServicoInternacaoController extends Controller
{
    public function store(Request $request, $id)
    {
        //dd($request->all());
        $internacao = ServicoInternacao::where('paciente_id', $id)->first();

        $dados = [
      'paciente_id' => $id,
      'precisou_servico' => $request->precisou_servico ? serialize($request->precisou_servico) : null,
      'precisou_servico_outro' => $request->precisou_servico_outro,
      'quant_ida_servico' => $request->quant_ida_servico,
      'data_ultima_ida_servico_de_saude' => $request->data_ultima_ida_servico_de_saude,
      'recebeu_med_covid' => $request->recebeu_med_covid ? serialize($request->recebeu_med_covid) : null,
      //'recebeu_med_covid_outro' => $request->recebeu_med_covid_outro,
      'nome_medicamento' => $request->nome_medicamento,
      'teve_algum_problema' => $request->teve_algum_problema ? serialize($request->teve_algum_problema) : null,
      'descreva_problema' => $request->descreva_problema,
      'precisou_internacao' => $request->precisou_internacao,
      'precisou_ambulancia' => $request->precisou_ambulancia,
      'local_internacao' => $request->local_internacao ? serialize($request->local_internacao) : null,
      'nome_hospital' => $request->nome_hospital,
      'tempo_internacao' => $request->tempo_internacao,
      'data_entrada_internacao' => $request->data_entrada_internacao,
      'data_alta_hospitalar' => $request->data_alta_hospitalar,
    ];

        if (!$internacao) {
            DB::beginTransaction();
            try {
                $internacao = ServicoInternacao::create($dados);
                DB::commit();
                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a oeração.');
            }
        } else {
            DB::beginTransaction();
            try {
                $internacao->update($dados);
                DB::commit();
                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a oeração.');
            }
        }
    }
}
