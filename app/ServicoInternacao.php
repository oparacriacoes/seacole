<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicoInternacao extends Model
{
    protected $fillable = [
        'paciente_id',
        'precisou_servico',
        'precisou_servico_outro',
        'quant_ida_servico',
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
        'tempo_internacao',
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


    /**
     * Relations
     */

    public function pacientes()
    {
        return $this->belongsTo('App\Paciente');
    }
}
