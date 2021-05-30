<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Log;
use App\Models\Paciente;
use App\Notifications\AlertaAgente;

class NotifyController extends Controller
{
    public function notify()
    {
        function notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify)
        {
            $info = ['paciente_id' => $paciente_avaliado, 'agente_id' => $agente_notificado, 'action' => $acao];
            $agente_notify->notify(new AlertaAgente($info));
        }

        function monitoramento($tipo, $fase_doenca, $paciente_avaliado, $agente_notificado, $agente_notify)
        {
            switch ($fase_doenca) {
          case ($tipo === 1 && $fase_doenca <= 5 ?? $fase_doenca):
              $acao = "Ligar 1 vez ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 1 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
              $acao = "Ligar 2 vezes ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 1 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
              $acao = "Ligar 1 vez ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 2 && $fase_doenca <= 5 ?? $fase_doenca):
              $acao = "Ligar 2 vezes ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 2 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
              $acao = "Ligar 3 vezes ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 2 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
              $acao = "Ligar 1 vez ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 3 && $fase_doenca <= 5 ?? $fase_doenca):
              break;
          case ($tipo === 3 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
              $acao = "Ligar 1 vez a cada 2 dias.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 3 && $fase_doenca > 12 ?? $fase_doenca):
              break;
          case ($tipo === 4 && $fase_doenca <= 5 ?? $fase_doenca):
              $acao = "Ligar 1 vez ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 4 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
              $acao = "Ligar 2 vezes ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
          case ($tipo === 4 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
              $acao = "Ligar 1 vez ao dia.";
              notificaAgente($acao, $paciente_avaliado, $agente_notificado, $agente_notify);
              break;
      }
        }

        function avaliaCondicoes($paciente)
        {
            $sintoma = $paciente->sintomas;

            if (!$sintoma->isEmpty()) {
                $idade = Carbon::parse($paciente->data_nascimento)->age;
                $cronica = json_decode($paciente->doencas_cronicas[0]->tipo);
                $manifestados = json_decode($paciente->sintomas[0]->sintoma_manifestado);
                $data_sintoma = Carbon::parse($sintoma[0]->data_inicio_sintoma);
                $fase_doenca = Carbon::parse(Carbon::now())->diffInDays(Carbon::parse($data_sintoma));
                $tipo = 0;
                $acao = '';
                $paciente_avaliado = $paciente->id;
                $agente_notificado = $paciente->agente->id;

                if ($idade >= 60 || $cronica[0] !== null) {
                    $tipo = 1;
                    if (in_array('febre', $manifestados) || in_array('sonolência', $manifestados)) {
                        $tipo = 2;
                    }
                }

                if ($idade < 60 && $cronica[0] === null) {
                    $tipo = 3;
                    if (in_array('febre', $manifestados) || in_array('sonolência', $manifestados)) {
                        $tipo = 4;
                    }
                }

                monitoramento($tipo, $fase_doenca, $paciente_avaliado, $agente_notificado, $paciente->agente);
            }
        }

        $pacientes = Paciente::all();
        foreach ($pacientes as $paciente) {
            avaliaCondicoes($paciente);
        }
        Log::notice('Noticações enviadas - ' . Carbon::now());
    }

    public function dismiss($notification_id, $paciente_id)
    {
        $notification = \DB::table('notifications')->where('id', $notification_id)->update(['read_at' => Carbon::now()]);

        return redirect('/admin/paciente/edit/'.$paciente_id);
    }
}
