<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuadroAtual extends Model
{
  protected $table = 'quadro_atual';

  protected $fillable = [
      'paciente_id',
      'primeira_sintoma',
      'sintomas_manifestados',
      'temperatura_max',
      'saturacao_baixa',
      'frequencia_max',
      'data_temp_max',
      'data_sat_max',
      'data_freq_max',
    ];

    public function paciente()
    {
      return $this->belongsTo('App\Paciente');
    }
}
