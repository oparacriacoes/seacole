<?php

namespace App\Models;

use App\Paciente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacinacao extends Model
{
    use HasFactory;

    protected $table = 'vacinacoes';

    protected $fillable = [
        'data_vacinacao',
        'dose',
        'reforco'
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_vacinacao',
    ];

    protected $casts = [
        'reforco' => 'boolean',
    ];


    /**
     * Relations
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function vacina()
    {
        return $this->belongsTo(Vacina::class);
    }
}
