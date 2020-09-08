<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articuladora extends Model
{
    protected $fillable = [
        'nome'
      ];
    
      public function pacientes()
      {
        return $this->hasMany('App\Paciente');
      }
}
