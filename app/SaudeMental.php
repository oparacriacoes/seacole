<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaudeMental extends Model
{
    protected $fillable = [
        'paciente_id',
        'quadro_atual',
        'detalhes_medos',
      ];
    
      public function pacientes()
      {
        return $this->belongsTo('App\Paciente');
      }
}
