<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacao extends Model
{
  protected $fillable = [
    'paciente_id', 'comentarios',
  ];
}
