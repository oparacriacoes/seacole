<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fone_celular_1', 'fone_celular_2',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pacientes()
    {
        return $this->hasMany('App\Paciente');
    }
}
