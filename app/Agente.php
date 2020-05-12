<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agente extends Model
{
  use Notifiable;

  protected $fillable = [
    'user_id', 'fone_celular_1', 'fone_celular_2',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
