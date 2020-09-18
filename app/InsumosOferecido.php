<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumosOferecido extends Model
{
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

      public function pacientes()
      {
        return $this->belongsTo('App\Paciente');
      }
}
