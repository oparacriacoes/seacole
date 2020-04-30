<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
  protected $fillable = [
    'paciente_id',
    'data_inicio_sintoma',
    'sintoma_manifestado',
    'febre_temperatura_maxima',
    'data_medicao_temperatura',
    'temperatura_atual',
    'cansaco_saturacao',
    'cansaco_frequencia_respiratoria',
  ];
}
