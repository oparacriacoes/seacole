<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoencaCronica extends Model
{
  protected $fillable = [
    'paciente_id', 'tipo',
  ];

  public function paciente()
  {
    return $this->belongsTo('App\Paciente');
  }
}
