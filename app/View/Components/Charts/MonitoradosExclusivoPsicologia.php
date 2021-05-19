<?php

namespace App\View\Components\Charts;

use App\Paciente;

class MonitoradosExclusivoPsicologia extends ChartComponent
{
    protected string $componentView = 'components.charts.monitorados-exclusivo-psicologia';

    public function chartData(): array
    {
        // CHART::2 O REAL SIGNIFICADO DA SEGUNDA INFORMACAO
        $pacientes = Paciente::select(['id', 'agente_id', 'psicologo_id'])->get();

        $labels = [
            'Casos totais monitorados exclusivamente por equipe de psicologia',
            'Casos totais monitorados por agentes populares de saúde por equipe de psicologia',
        ];

        $data = [
            $pacientes->whereNull('agente_id')->whereNotNull('psicologo_id')->count(),
            $pacientes->count() - $pacientes->whereNull('agente_id')->whereNotNull('psicologo_id')->count(),
        ];

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
