<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvolucaoSintoma extends Model
{
  protected $fillable = [
    'paciente_id',
    'data_inicio_sintoma',
    'horario_sintoma',
    'sintoma_manifestado',
    'febre_temperatura_maxima',
    'data_medicao_temperatura',
    'temperatura_atual',
    'cansaco_saturacao',
    'cansaco_frequencia_respiratoria',
    'pressao_arterial',
  ];

  public function paciente()
  {
    return $this->belongsTo('App\Paciente');
  }
}
