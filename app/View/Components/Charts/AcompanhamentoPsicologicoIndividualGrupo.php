<?php

namespace App\View\Components\Charts;

use App\Models\Paciente;


class AcompanhamentoPsicologicoIndividualGrupo extends ChartComponent
{

    protected string $componentView = 'components.charts.acompanhamento-psicologico-individual-grupo';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('acompanhamento_psicologico, COUNT(id) AS pacientes')
            ->groupBy('acompanhamento_psicologico')
            ->orderBy('acompanhamento_psicologico')
            ->get();

        $collection->transform(function ($row) {
            if (is_null($row->acompanhamento_psicologico)) {
                $row->acompanhamento_psicologico = 'Sem acompanhamento psicológico';
            } else if (in_array_all(['individual', 'em grupo'], $row->acompanhamento_psicologico)) {
                $row->acompanhamento_psicologico = 'Acompanhamento individual e em grupo';
            } else if (in_array('individual', $row->acompanhamento_psicologico)) {
                $row->acompanhamento_psicologico = 'Acompanhamento em grupo';
            } else if (in_array('em grupo', $row->acompanhamento_psicologico)) {
                $row->acompanhamento_psicologico = 'Acompanhamento em grupo';
            } else {
                $row->acompanhamento_psicologico = 'Sem acompanhamento psicológico';
            }

            return $row;
        });

        return [
            'labels' => $collection->pluck('acompanhamento_psicologico'),
            'data' => $collection->pluck('pacientes'),
        ];
    }
}
