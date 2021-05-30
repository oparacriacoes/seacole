<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvolucaoSintoma extends Model
{
    protected $table = 'evolucao_sintomas';

    protected $fillable = [
        'paciente_id',
        'data_monitoramento',
        'horario_monitoramento',
        'sintomas_atuais',
        'sintomas_outro',
        'temperatura_atual',
        'frequencia_cardiaca_atual',
        'algum_sinal',
        'saturacao_atual',
        'pressao_arterial_atual',
        'equipe_medica',
        'frequencia_respiratoria_atual',
        'medicamento',
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
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
