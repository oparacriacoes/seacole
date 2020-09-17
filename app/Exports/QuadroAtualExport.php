<?php

namespace App\Exports;

use App\QuadroAtual;
use App\Paciente;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class QuadroAtualExport implements FromArray, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function title(): string
    {
      return 'Quadro Atual';
    }

    public function headings(): array
    {
      return [
        'Paciente',
        'Primeiro sintoma',
        'Sintomas manifestados',
        'Temperatura max',
        'Data temp max',
        'Saturação',
        'Data saturação',
        'Frequência card. max',
        'Data freq max',
      ];
    }

    public function array(): array
    {
      $quadros = QuadroAtual::get();
      $quadros_array = [];

      foreach($quadros as $quadro){
        array_push($quadros_array, [
          'Paciente' => $quadro->paciente->user->name,
          'Primeiro sintoma' => $quadro->primeira_sintoma,
          'Sintomas manifestados' => $quadro->sintomas_manifestados ? implode(', ', unserialize($quadro->sintomas_manifestados)) : NULL,
          'Temperatura max' => $quadro->temperatura_max,
          'Data temp max' => $quadro->data_temp_max,
          'Saturação' => $quadro->saturacao_baixa,
          'Data saturação' => $quadro->data_sat_max,
          'Frequência card. max' => $quadro->frequencia_max,
          'Data freq max' => $quadro->data_freq_max,
        ]);
      }

      return [$quadros_array];
    }
}
