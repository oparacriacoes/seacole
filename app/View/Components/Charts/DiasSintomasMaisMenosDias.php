<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiasSintomasMaisMenosDias extends ChartComponent
{
    protected string $componentView = 'components.charts.dias-sintomas-mais-menos-dias';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('label'),
            'data' => $collection->pluck('pacientes'),
        ];
    }

    private $query = "
        SELECT
            quantidade_dias as label,
            SUM(count_pacientes) AS pacientes
        FROM
            (
            SELECT
                CASE
                WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 THEN 'Mais de dez dias'
                WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10 THEN 'Menos de dez dias'
                END AS quantidade_dias,
                COUNT(id) AS count_pacientes
            FROM
                pacientes
            WHERE
                situacao IN (1, 2, 3, 6, 7, 8, 9, 10, 11, 12)
            GROUP BY
                data_inicio_monitoramento,
                data_inicio_sintoma
            ) as TBBB
        WHERE
            quantidade_dias IS NOT NULL
        GROUP BY
            quantidade_dias;
    ";
}
