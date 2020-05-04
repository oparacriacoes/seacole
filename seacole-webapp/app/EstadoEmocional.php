<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoEmocional extends Model
{
  protected $fillable = [
    'paciente_id', 'situacao', 'medo',
  ];

  public function paciente()
  {
    return $this->belongsTo('App\Paciente');
  }
}
