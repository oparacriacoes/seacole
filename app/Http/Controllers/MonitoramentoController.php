<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoramento;
use DB;
use App\Events\SintomaEvolucao;
use App\EvolucaoSintoma;

class MonitoramentoController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $dados = [
      'paciente_id' => $id,
      'data_monitoramento' => $request->data_monitoramento,
      'horario_monotiramento' => $request->horario_monotiramento,
      'sintomas_atuais' => $request->sintomas_atuais ? serialize($request->sintomas_atuais) : null,
      'sintomas_outro' => $request->sintomas_outro,
      'temperatura_atual' => $request->temperatura_atual,
      'frequencia_cardiaca_atual' => $request->frequencia_cardiaca_atual,
      'algum_sinal' => $request->algum_sinal,
      'saturacao_atual' => $request->saturacao_atual,
      'pressao_arterial_atual' => $request->pressao_arterial_atual,
      'equipe_medica' => $request->equipe_medica,
      'frequencia_respiratoria_atual' => $request->frequencia_respiratoria_atual,
      'medicamento' => $request->medicamento,
      'fazendo_uso_pic' => $request->fazendo_uso_pic,
      'fez_escalapes' => $request->fez_escalapes,
      'melhora_sintoma_escaldapes' => $request->melhora_sintoma_escaldapes,
      'fes_inalacao' => $request->fes_inalacao,
      'melhoria_sintomas_inalacao' => $request->melhoria_sintomas_inalacao,
    ];

        $monitoramento = Monitoramento::where('paciente_id', $id)->first();

        if (!$monitoramento) {
            DB::beginTransaction();
            try {
                $monitoramento = Monitoramento::create($dados);
                DB::commit();

                //REGISTRA NO PRONTUÁRIO
                if ($dados) {
                    event(new SintomaEvolucao(new EvolucaoSintoma($dados)));
                }

                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a operação.');
            }
        } else {
            DB::beginTransaction();
            try {
                $monitoramento->update($dados);
                DB::commit();

                //REGISTRA NO PRONTUÁRIO
                if ($dados) {
                    event(new SintomaEvolucao(new EvolucaoSintoma($dados)));
                }

                return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar a operação.');
            }
        }
    }
}
