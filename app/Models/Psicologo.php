<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psicologo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fone_celular_1', 'fone_celular_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
