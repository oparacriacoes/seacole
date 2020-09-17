<?php

namespace App\Exports;

use App\SaudeMental;
use App\Paciente;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SaudeMentalExport implements FromArray, WithHeadings, WithTitle
{
  public function title(): string
  {
    return 'Saúde Mental';
  }

  public function headings(): array
  {
    return [
      'Paciente',
      'Intensifica sentimentos?',
      'Detalhes medos',
    ];
  }

  public function array(): array
  {
    $saudes = SaudeMental::get();
    $saudes_array = [];

    foreach($saudes as $saude){
      $paciente = Paciente::where('id', $saude->paciente_id)->first();

      array_push($saudes_array, [
        'Paciente' => $paciente->user->name,
        'Intensifica sentimentos?' => $saude->quadro_atual,
        'Detalhes medos' => $saude->detalhes_medos,
      ]);
    }

    return [$saudes_array];
  }

}
