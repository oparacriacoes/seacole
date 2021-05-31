<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClasseSocialPorRendaFamiliar extends ChartComponent
{
    protected string $componentView = 'components.charts.classe-social-por-renda-familiar';

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
            renda_residencia as label,
            COALESCE(SUM(sem_informacao), 0) AS sem_informacao,
            COALESCE(SUM(preta), 0) AS preta,
            COALESCE(SUM(parda), 0) AS parda,
            COALESCE(SUM(branca), 0) AS branca,
            COALESCE(SUM(amarela), 0) AS amarela,
            COALESCE(SUM(indigena), 0) AS indigena
        FROM
            (
            SELECT
                CASE
                    WHEN renda_residencia > 0 AND renda_residencia <= 1254 THEN 'Classe E'
                    WHEN renda_residencia >= 1255 AND renda_residencia <= 2004 THEN 'Classe D'
                    WHEN renda_residencia >= 2005 AND renda_residencia <= 8640 THEN 'Classe C'
                    WHEN renda_residencia >= 8641 AND renda_residencia <= 11261 THEN 'Classe B'
                    WHEN renda_residencia >= 11262 THEN 'Classe A'
                    ELSE 'Sim info.'
                END AS renda_residencia,
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
                pacientes
            GROUP BY
                renda_residencia,
                cor_raca
            ) TBB
        GROUP BY renda_residencia
        ORDER BY renda_residencia;
    ";
}
