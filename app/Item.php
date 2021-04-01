<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'paciente_id', 'nome_item',
  ];

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }
}
