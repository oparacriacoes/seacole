<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agente extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'user_id', 'fone_celular_1', 'fone_celular_2',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'created_at',
        'updated_at'
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
