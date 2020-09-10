<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvolucaoSintoma extends Model
{
  protected $fillable = [
    'paciente_id',
    'horario_monotiramento',
    'sintomas_atuais',
    'sintomas_outro',
    'temperatura_atual',
    'frequencia_cardiaca_atual',
    'algum_sinal',
    'saturacao_atual',
    'pressao_arterial_atual',
    'equipe_medica',
    'frequencia_respiratoria_atual',
    'medicamento',
    'fazendo_uso_pic',
    'fez_escalapes',
    'melhora_sintoma_escaldapes',
    'fes_inalacao',
    'melhoria_sintomas_inalacao',
  ];

  public function paciente()
  {
    return $this->belongsTo('App\Paciente');
  }
}
