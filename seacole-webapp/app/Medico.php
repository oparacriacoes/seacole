<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
  protected $fillable = [
    'user_id', 'fone_fixo', 'fone_celular',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
