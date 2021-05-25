<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiasSintomasRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.dias-sintomas-raca-cor';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $datasets = [];
        $labels = array_filter(array_keys((array)$collection->first()), function ($label) {
            return $label != 'label';
        });

        foreach ($labels as $label) {
            array_push($datasets, [
                'label' => (string)Str::of($label)->replace('_', ' ')->title(),
                'data' => $collection->pluck($label)
            ]);
        }

        return [
            'labels' => $collection->pluck('label'),
            'datasets' => $datasets,
        ];
    }

    private $query = "
        SELECT
            dias as label,
            COALESCE(SUM(sem_informacao), 0) AS sem_informacao,
            COALESCE(SUM(preta), 0) AS preta,
            COALESCE(SUM(parda), 0) AS parda,
            COALESCE(SUM(branca), 0) AS branca,
            COALESCE(SUM(amarela), 0) AS amarela,
            COALESCE(SUM(indigena), 0) AS indigena
        FROM
            (
            SELECT
                DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) AS dias,
                CASE
                    WHEN cor_raca IS NULL THEN COUNT(id)
                END AS sem_informacao,
                CASE
                    WHEN cor_raca = 'Preta' THEN COUNT(id)
                END AS preta,
                CASE
                    WHEN cor_raca = 'Parda' THEN COUNT(id)
                END AS parda,
                CASE
                    WHEN cor_raca = 'Branca' THEN COUNT(id)
                END AS branca,
                CASE
                    WHEN cor_raca = 'Amarela' THEN COUNT(id)
                END AS amarela,
                CASE
                    WHEN cor_raca = 'Indígena' THEN COUNT(id)
                END AS indigena
            FROM
                (
                SELECT
                    id,
                    cor_raca,
                    data_inicio_monitoramento,
                    data_inicio_sintoma
                FROM
                    (
                    SELECT
                        id,
                        cor_raca,
                        data_inicio_monitoramento data_inicio_monitoramento,
                        data_inicio_sintoma
                    FROM
                        pacientes
                    WHERE
                        situacao IN (1, 2, 3, 6, 7, 8, 9, 10, 11, 12)
                    ) TB
                ) TBB
            GROUP BY 1, cor_raca
            ) TBBB
        WHERE
            dias >= 0
        GROUP BY dias
        ORDER BY dias;
    ";
}
