<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;


class AcompanhamentoPsicologico extends ChartComponent
{

    protected string $componentView = 'components.charts.acompanhamento-psicologico';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('psicologo'),
            'data' => $collection->pluck('quantidade_pacientes'),
        ];
    }

    private $query = "
        SELECT
            COALESCE(us.name, 'Sem acompanhamento psicológico') AS psicologo,
            COUNT(pac.id) AS quantidade_pacientes
        FROM
            pacientes pac
            LEFT JOIN psicologos ps ON pac.psicologo_id = ps.id
            LEFT JOIN users us ON ps.user_id = us.id
        GROUP BY
            us.name;
    ";
}
