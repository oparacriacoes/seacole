<?php

namespace App\Exports;

use App\ServicoInternacao;
use App\Paciente;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ServicoInternacaoExport implements FromArray, WithHeadings, WithTitle
{
    public function title(): string
    {
        return 'Serviços Ref. e Int.';
    }

    public function headings(): array
    {
        return [
      'Paciente',
      'Precisou serviço?',
      'Outros serviços',
      'Qtd ida serviço',
      'Data última ida',
      'Recebeu med covid',
      'Outra med covid',
      'Teve algum problema?',
      'Descrição problema',
      'Precisou internação?',
      'Precisou ambulância?',
      'Local internação',
      'Nome hospital',
      'Tempo internação',
      'Data entrada internação',
      'Data alta hospitalar',
    ];
    }

    public function array(): array
    {
        $servicos = ServicoInternacao::get();
        $servicos_array = [];

        foreach ($servicos as $servico) {
            $paciente = Paciente::where('id', $servico->paciente_id)->first();

            array_push($servicos_array, [
        'Paciente' => $paciente->user->name,
        'Precisou serviço?' => $servico->precisou_servico ? implode(', ', unserialize($servico->precisou_servico)) : '',
        'Outros serviços' => $servico->precisou_servico_outro,
        'Qtd ida serviço' => $servico->quant_ida_servico,
        'Data última ida' => $servico->data_ultima_ida_servico_de_saude,
        'Recebeu med covid' => $servico->recebeu_med_covid ? implode(', ', unserialize($servico->recebeu_med_covid)) : '',
        'Outra med covid' => $servico->nome_medicamento,
        'Teve algum problema?' => $servico->teve_algum_problema ? implode(', ', unserialize($servico->teve_algum_problema)) : '',
        'Descrição problema' => $servico->descreva_problema,
        'Precisou internação?' => $servico->precisou_internacao,
        'Precisou ambulância?' => $servico->precisou_ambulancia,
        'Local internação' => $servico->local_internacao ? implode(', ', unserialize($servico->local_internacao)) : '',
        'Nome hospital' => $servico->nome_hospital,
        'Tempo internação' => $servico->tempo_internacao,
        'Data entrada internação' => $servico->data_entrada_internacao,
        'Data alta hospitalar' => $servico->data_alta_hospitalar,
      ]);
        }

        return [$servicos_array];
    }
}
