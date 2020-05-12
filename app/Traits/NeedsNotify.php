<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Agente;
use App\Paciente;
use App\Notifications\AlertaAgente;

trait NeedsNotify
{
  public function avaliaCondicoes($paciente)
  {
    $sintoma = $paciente->sintomas;

    if(!$sintoma->isEmpty()){

      $idade = Carbon::parse($paciente->data_nascimento)->age;
      $cronica = json_decode($paciente->doencas_cronicas[0]->tipo);
      $manifestados = json_decode($paciente->sintomas[0]->sintoma_manifestado);
      $data_sintoma = Carbon::parse($sintoma[0]->data_inicio_sintoma);
      $fase_doenca = Carbon::parse(Carbon::now())->diffInDays(Carbon::parse($data_sintoma));
      $tipo = 0;
      $acao = '';
      define('PACIENTE', $paciente->id);
      define('AGENTE', $paciente->agente->id);

      function monitoramento($tipo, $fase_doenca, $agente_notify) {
        switch ($fase_doenca) {
            case ($tipo === 1 && $fase_doenca <= 5 ?? $fase_doenca):
                //echo "ligar 1 vez ao dia.";
                $acao = "Ligar 1 vez ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 1 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
                //echo "ligar 2 vezes ao dia.";
                $acao = "Ligar 2 vezes ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 1 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
                //echo "ligar 1 vez ao dia.";
                $acao = "Ligar 1 vez ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 2 && $fase_doenca <= 5 ?? $fase_doenca):
                //echo "ligar 2 vezes ao dia.";
                $acao = "Ligar 2 vezes ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 2 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
                //echo "ligar 3 vezes ao dia.";
                $acao = "Ligar 3 vezes ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 2 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
                //echo "ligar 1 vez ao dia.";
                $acao = "Ligar 1 vez ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 3 && $fase_doenca <= 5 ?? $fase_doenca):
                echo "não ligar.";
                break;
            case ($tipo === 3 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
                //echo "ligar 1 vez a cada 2 dias.";
                $acao = "Ligar 1 vez a cada 2 dias.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 3 && $fase_doenca > 12 ?? $fase_doenca):
                echo "não ligar.";
                break;
            case ($tipo === 4 && $fase_doenca <= 5 ?? $fase_doenca):
                //echo "ligar 1 vez ao dia.";
                $acao = "Ligar 1 vez ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 4 && $fase_doenca > 5 && $fase_doenca <= 12 ?? $fase_doenca):
                //echo "ligar 2 vezes ao dia.";
                $acao = "Ligar 2 vezes ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
            case ($tipo === 4 && $fase_doenca > 12 && $fase_doenca <= 15 ?? $fase_doenca):
                //echo "ligar 1 vez ao dia.";
                $acao = "Ligar 1 vez ao dia.";
                notificaAgente($acao, $agente_notify);
                break;
        }
      }

      function notificaAgente($acao, $agente_notify){
        $info = ['paciente_id' => PACIENTE, 'agente_id' => AGENTE, 'action' => $acao];
        $agente_notify->notify(new AlertaAgente($info));
      }

      if( $idade >= 60 || $cronica[0] !== null ){
        //echo 'acima de 60 anos ou com doença cronica<br>';
        $tipo = 1;
        if( in_array('febre', $manifestados) || in_array('sonolência', $manifestados) ) {
          //echo 'apresenta cansaço ou febre.<br>';
          $tipo = 2;
        }
      }

      if( $idade < 60 && $cronica[0] === null ){
        //echo 'abaixo de 60 anos e sem doença cronica<br>';
        $tipo = 3;
        if( in_array('febre', $manifestados) || in_array('sonolência', $manifestados) ) {
          //echo 'apresenta cansaço ou febre.<br>';
          $tipo = 4;
        }
      }

      monitoramento($tipo, $fase_doenca, $paciente->agente);
    }

  }
}
