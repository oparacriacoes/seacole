<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicoInternacao extends Model
{
    protected $fillable = [
        'paciente_id',
        'precisou_servico',
        'precisou_servico_outro',
        'quant_ida_servico', //unsignedInterger
        'data_ultima_ida_servico_de_saude',
        'recebeu_med_covid',
        'recebeu_med_covid_outro',
        'nome_medicamento',
        'teve_algum_problema',
        'descreva_problema',
        'precisou_internacao',
        'precisou_ambulancia',
        'local_internacao',
        'nome_hospital',
        'tempo_internacao', //unsignedInterger
        'data_entrada_internacao',
        'data_alta_hospitalar',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_ultima_ida_servico_de_saude',
        'data_entrada_internacao',
        'data_alta_hospitalar',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'precisou_servico' => 'array',
        'recebeu_med_covid' => 'array',
        'teve_algum_problema' => 'array',
        'local_internacao' => 'array',
        'precisou_internacao' => 'boolean',
        'precisou_ambulancia' => 'boolean',
    ];

    /**
     * Relations
     */
    public function pacientes()
    {
        return $this->belongsTo('App\Paciente');
    }
}
