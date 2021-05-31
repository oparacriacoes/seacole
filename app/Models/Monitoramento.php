<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoramento extends Model
{
    protected $table = 'monitoramentos';

    protected $fillable = [
        'paciente_id',
        'data_monitoramento',
        'horario_monitoramento',
        'sintomas_atuais',
        'sintomas_outro',
        'temperatura_atual',
        'saturacao_atual',
        'frequencia_respiratoria_atual',
        'frequencia_cardiaca_atual',
        'pressao_arterial_atual',
        'medicamento',
        'algum_sinal',
        'equipe_medica',
        'fazendo_uso_pic',
        'fez_escalapes',
        'melhora_sintoma_escaldapes',
        'fes_inalacao',
        'melhoria_sintomas_inalacao',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_monitoramento',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'sintomas_atuais' => 'array',
        'algum_sinal' => 'boolean',
        'equipe_medica' => 'boolean',
        'fazendo_uso_pic' => 'boolean',
        'fez_escalapes' => 'boolean',
    ];


    /**
     * Relations
     */
    public function pacientes()
    {
        return $this->belongsTo(Paciente::class);
    }
}
