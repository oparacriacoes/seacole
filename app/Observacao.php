<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacao extends Model
{
  protected $fillable = [
    'paciente_id', 'comentarios',
  ];

  public function paciente()
  {
    return $this->belongsTo('App\Paciente');
  }
}
