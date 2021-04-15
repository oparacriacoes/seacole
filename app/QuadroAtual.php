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
      'temperatura_max', // decimal
      'saturacao_baixa', // integer
      'frequencia_max', //  integer
      'data_temp_max',
      'data_sat_max',
      'data_freq_max',
      'desfecho',
      'sequelas',
      'outra_sequela_qual',
      'algo_mais_sobre_caso',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_temp_max',
        'data_sat_max',
        'data_freq_max',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'sequelas' => 'array',
        'sintomas_manifestados' => 'array',
    ];


    /**
     * Relations
     */
    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }
}
