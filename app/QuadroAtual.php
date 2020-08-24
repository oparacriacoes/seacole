<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuadroAtual extends Model
{
    protected $fillable = [
        'paciente_id',
        'precisou_servico',
        'quant_ida_servico',
        'recebeu_med_covid',
        'nome_medicamento',
        'teve_algum_problema',
        'descreva_problema',
        'precisou_internacao',
        'precisou_ambulancia',
        'local_internacao',
        'nome_hospital',
        'tempo_internacao',
      ];
    
      public function pacientes()
      {
        return $this->belongsTo('App\Paciente');
      }
}
