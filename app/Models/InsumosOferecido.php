<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsumosOferecido extends Model
{
    protected $table = 'insumos_oferecidos';

    protected $fillable = [
        'paciente_id',
        'condicao_ficar_isolada',
        'tem_comida',
        'tem_alguem',
        'tarefas_autocuidado',
        'precisa_tipo_ajuda',
        'tratamento_prescrito',
        'tratamento_financiado',
        'material_entregue',
        'oximetro_devolvido',
    ];

    /**
     * Mutators and Casts
     */
    protected $casts = [
        'condicao_ficar_isolada' => 'boolean',
        'tem_comida' => 'boolean',
        'tem_alguem' => 'boolean',
        'tarefas_autocuidado' => 'boolean',
        'tratamento_prescrito' => 'boolean',
        'oximetro_devolvido' => 'boolean',
        'tratamento_financiado' => 'array',
        'precisa_tipo_ajuda' => 'array',
        'material_entregue' => 'array',
    ];

    /**
     * Relations
     */
    public function pacientes()
    {
        return $this->belongsTo(Paciente::class);
    }
}
