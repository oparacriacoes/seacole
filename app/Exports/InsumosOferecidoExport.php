<?php

namespace App\Exports;

use App\InsumosOferecido;
use App\Paciente;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class InsumosOferecidoExport implements FromArray, WithHeadings, WithTitle
{
  public function title(): string
  {
    return 'Insumos Oferecidos';
  }

  public function headings(): array
  {
    return [
      'Paciente',
      'Condição ficar isolada?',
      'Comida disponível?',
      'Alguém para ajudar?',
      'Realiza taref. autocuidado?',
      'Precisa ajuda?',
      'Tratam. prescrito',
      'Tratam. financiado',
      'Material entregue',
      'Oxímetro devolvido?',
    ];
  }

  public function array(): array
  {
    $insumos = InsumosOferecido::get();
    $insumos_array = [];

    foreach($insumos as $insumo){
      $paciente = Paciente::where('id', $insumo->paciente_id)->first();
      $precisa_ajuda = @implode(', ', unserialize($insumo->precisa_tipo_ajuda));
      if( $precisa_ajuda === null ){
        $precisa_ajuda = $insumo->precisa_tipo_ajuda;
      }

      array_push($insumos_array, [
        'Paciente' => $paciente->user->name,
        'Condição ficar isolada?' => $insumo->condicao_ficar_isolada,
        'Comida disponível?' => $insumo->tem_comida,
        'Alguém para ajudar?' => $insumo->tem_alguem,
        'Realiza taref. autocuidado?' => $insumo->tarefas_autocuidado,
        'Precisa ajuda?' => $precisa_ajuda,
        'Tratam. prescrito' => $insumo->tratamento_prescrito,
        'Tratam. financiado' => $insumo->tratamento_financiado ? implode(', ', unserialize($insumo->tratamento_financiado)) : '',
        'Material entregue' => $insumo->material_entregue ? implode(', ', unserialize($insumo->material_entregue)) : '',
        'Oxímetro devolvido?' => $insumo->oximetro_devolvido,
      ]);
    }

    return [$insumos_array];
  }

}
