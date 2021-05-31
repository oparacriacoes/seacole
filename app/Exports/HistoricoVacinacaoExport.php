<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoricoVacinacaoExport implements FromQuery, WithHeadings
{
    use Exportable;
    public function __construct(?int $pacienteId = null)
    {
        $this->pacienteId = $pacienteId;
    }

    public function headings(): array
    {
        return [
            'nome',
            'idade',
            'cor_raca',
            'nome_vacina',
            'doses_vacina',
            'data_vacinacao',
            'dose',
            'reforco',
            'registrado_em'
        ];
    }

    public function query()
    {
        $query = DB::table('vacinacoes')
            ->join('pacientes', 'vacinacoes.paciente_id', '=', 'pacientes.id')
            ->join('vacinas', 'vacinacoes.vacina_id', '=', 'vacinas.id')
            ->select([
                DB::raw('pacientes.name as nome'),
                DB::raw("TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) AS idade"),
                'pacientes.cor_raca',
                DB::raw('vacinas.name as nome_vacina'),
                DB::raw('vacinas.doses as doses_vacina'),
                'vacinacoes.data_vacinacao',
                'vacinacoes.dose',
                DB::raw("IF(vacinacoes.reforco=true, 'sim', 'não') as reforco"),
                DB::raw('vacinacoes.created_at as registrado_em')
            ])
            ->when($this->pacienteId, function ($query, $pacienteId) {
                return $query->where('vacinacoes.paciente_id', $pacienteId);
            })
            ->orderBy('pacientes.name');

        return $query;
    }
}
