<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaudeMental extends Model
{
    protected $fillable = [
        'paciente_id',
        'quadro_atual',
        'detalhes_medos',
    ];

    /**
     * Mutators and Casts
     */
    protected $casts = [
        'quadro_atual' => 'boolean'
    ];

    /**
     * Relations
     */
    public function pacientes()
    {
        return $this->belongsTo('App\Paciente');
    }
}
