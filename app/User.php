<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Mutators and Casts
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute()
    {
        return $this->role === 'administrador';
    }


    /**
     * Relations
     */
    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function agente()
    {
        return $this->hasOne(Agente::class);
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function psicologo()
    {
        return $this->hasOne(Psicologo::class);
    }
}
