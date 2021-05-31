<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaixaEtariaPorRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.faixa-etaria-por-raca-cor';

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
            faixa_idade as label,
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
                WHEN idade <= 4 THEN '0-4'
                WHEN idade >= 5 AND idade <= 9 THEN '5-9'
                WHEN idade >= 10 AND idade <= 14 THEN '10-14'
                WHEN idade >= 15 AND idade <= 19 THEN '15-19'
                WHEN idade >= 20 AND idade <= 24 THEN '20-24'
                WHEN idade >= 25 AND idade <= 29 THEN '25-29'
                WHEN idade >= 30 AND idade <= 34 THEN '30-34'
                WHEN idade >= 35 AND idade <= 39 THEN '35-39'
                WHEN idade >= 40 AND idade <= 44 THEN '40-44'
                WHEN idade >= 45 AND idade <= 49 THEN '45-49'
                WHEN idade >= 50 AND idade <= 54 THEN '50-54'
                WHEN idade >= 55 AND idade <= 59 THEN '55-59'
                WHEN idade >= 60 AND idade <= 64 THEN '60-64'
                WHEN idade >= 65 AND idade <= 69 THEN '65-69'
                WHEN idade >= 70 AND idade <= 74 THEN '70-74'
                WHEN idade >= 75 AND idade <= 79 THEN '75-79'
                WHEN idade >= 80 AND idade <= 84 THEN '80-84'
                WHEN idade >= 85 AND idade <= 89 THEN '85-89'
                WHEN idade >= 90 AND idade <= 94 THEN '90-94'
                WHEN idade >= 95 AND idade <= 99 THEN '95-99'
                WHEN idade > 100 THEN '100+'
                ELSE 'Não informado'
            END AS faixa_idade,
            CASE
                WHEN idade <= 4 THEN 0
                WHEN idade >= 5 AND idade <= 9 THEN 1
                WHEN idade >= 10 AND idade <= 14 THEN 2
                WHEN idade >= 15 AND idade <= 19 THEN 3
                WHEN idade >= 20 AND idade <= 24 THEN 4
                WHEN idade >= 25 AND idade <= 29 THEN 5
                WHEN idade >= 30 AND idade <= 34 THEN 6
                WHEN idade >= 35 AND idade <= 39 THEN 7
                WHEN idade >= 40 AND idade <= 44 THEN 8
                WHEN idade >= 45 AND idade <= 49 THEN 9
                WHEN idade >= 50 AND idade <= 54 THEN 10
                WHEN idade >= 55 AND idade <= 59 THEN 11
                WHEN idade >= 60 AND idade <= 64 THEN 12
                WHEN idade >= 65 AND idade <= 69 THEN 13
                WHEN idade >= 70 AND idade <= 74 THEN 14
                WHEN idade >= 75 AND idade <= 79 THEN 15
                WHEN idade >= 80 AND idade <= 84 THEN 16
                WHEN idade >= 85 AND idade <= 89 THEN 17
                WHEN idade >= 90 AND idade <= 94 THEN 18
                WHEN idade >= 95 AND idade <= 99 THEN 19
                WHEN idade >= 100 THEN 20
                ELSE 21
            END AS ordem_faixa,
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
                TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) AS idade,
                id,
                cor_raca
                FROM
                pacientes
            ) TB
            GROUP BY idade, cor_raca
        ) TBB
        GROUP BY faixa_idade, ordem_faixa
        ORDER BY ordem_faixa;
    ";
}
