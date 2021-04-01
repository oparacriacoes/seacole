<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articuladora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
      ];

      public function pacientes()
      {
        return $this->hasMany('App\Paciente');
      }
}
