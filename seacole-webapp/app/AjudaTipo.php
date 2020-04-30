<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AjudaTipo extends Model
{
  protected $fillable = [
    'paciente_id', 'tipo',
  ];
}
