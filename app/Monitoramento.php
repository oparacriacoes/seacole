<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoramento extends Model
{
  protected $table = 'monitoramentos';

  protected $dates = [
    'created_at',
  ];

  protected $fillable = [
    'paciente_id',
    'data_monitoramento',
    'horario_monotiramento',
    'sintomas_atuais',
    'sintomas_outro',
    'temperatura_atual',
    'saturacao_atual',
    'frequencia_respiratoria_atual',
    'frequencia_cardiaca_atual',
    'pressao_arterial_atual',
    'medicamento',
    'algum_sinal',
    'equipe_medica',
    'fazendo_uso_pic',
    'fez_escalapes',
    'melhora_sintoma_escaldapes',
    'fes_inalacao',
    'melhoria_sintomas_inalacao',
  ];
}
