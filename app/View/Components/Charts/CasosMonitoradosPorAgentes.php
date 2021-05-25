<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;


class CasosMonitoradosPorAgentes extends ChartComponent
{

    protected string $componentView = 'components.charts.casos-monitorados-por-agentes';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('nome_agente'),
            'data' => $collection->pluck('quantidade_pacientes'),
        ];
    }

    private $query = "
        SELECT
            us.name AS nome_agente,
            COUNT(pac.id) AS quantidade_pacientes
        FROM
            pacientes pac
            LEFT JOIN agentes ag ON pac.agente_id = ag.id
            LEFT JOIN users us ON ag.user_id = us.id
        WHERE
            us.name IS NOT NULL
        GROUP BY
            us.name;
    ";
}
