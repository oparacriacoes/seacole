<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class FaixaEtariaPorGeneroB extends ChartComponent
{
    protected string $componentView = 'components.charts.faixa-etaria-por-genero-b';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $collectionToChartDataset = new CollectionToChartDatasets(
            'idade',
            'identidade_genero',
            'total',
            $collection
        );

        return [
            'labels' => $collectionToChartDataset->getLabels(),
            'datasets' => $collectionToChartDataset->getDatasets(),
        ];
    }

    private $query = "
        select
            count(id) as total,
            idade,
            identidade_genero
        from (
        SELECT
            id,
            identidade_genero,
            CASE
            WHEN idade is null THEN 'Não informado'
            WHEN idade <= 4 THEN '0-4'
            WHEN idade >= 5
            AND idade <= 9 THEN '5-9'
            WHEN idade >= 10
            AND idade <= 14 THEN '10-14'
            WHEN idade >= 15
            AND idade <= 19 THEN '15-19'
            WHEN idade >= 20
            AND idade <= 24 THEN '20-24'
            WHEN idade >= 25
            AND idade <= 29 THEN '25-29'
            WHEN idade >= 30
            AND idade <= 34 THEN '30-34'
            WHEN idade >= 35
            AND idade <= 39 THEN '35-39'
            WHEN idade >= 40
            AND idade <= 44 THEN '40-44'
            WHEN idade >= 45
            AND idade <= 49 THEN '45-49'
            WHEN idade >= 50
            AND idade <= 54 THEN '50-54'
            WHEN idade >= 55
            AND idade <= 59 THEN '55-59'
            WHEN idade >= 60
            AND idade <= 64 THEN '60-64'
            WHEN idade >= 65
            AND idade <= 69 THEN '65-69'
            WHEN idade >= 70
            AND idade <= 74 THEN '70-74'
            WHEN idade >= 75
            AND idade <= 79 THEN '75-79'
            WHEN idade >= 80
            AND idade <= 84 THEN '80-84'
            WHEN idade >= 85
            AND idade <= 89 THEN '85-89'
            WHEN idade >= 90
            AND idade <= 94 THEN '90-94'
            WHEN idade >= 95
            AND idade <= 99 THEN '95-99'
            WHEN idade >= 100 THEN '100+'
            END AS idade,
            CASE
            WHEN idade is null THEN null
            WHEN idade <= 4 THEN 0
            WHEN idade >= 5
            AND idade <= 9 THEN 1
            WHEN idade >= 10
            AND idade <= 14 THEN 2
            WHEN idade >= 15
            AND idade <= 19 THEN 3
            WHEN idade >= 20
            AND idade <= 24 THEN 4
            WHEN idade >= 25
            AND idade <= 29 THEN 5
            WHEN idade >= 30
            AND idade <= 34 THEN 6
            WHEN idade >= 35
            AND idade <= 39 THEN 7
            WHEN idade >= 40
            AND idade <= 44 THEN 8
            WHEN idade >= 45
            AND idade <= 49 THEN 9
            WHEN idade >= 50
            AND idade <= 54 THEN 10
            WHEN idade >= 55
            AND idade <= 59 THEN 11
            WHEN idade >= 60
            AND idade <= 64 THEN 12
            WHEN idade >= 65
            AND idade <= 69 THEN 13
            WHEN idade >= 70
            AND idade <= 74 THEN 14
            WHEN idade >= 75
            AND idade <= 79 THEN 15
            WHEN idade >= 80
            AND idade <= 84 THEN 16
            WHEN idade >= 85
            AND idade <= 89 THEN 17
            WHEN idade >= 90
            AND idade <= 94 THEN 18
            WHEN idade >= 95
            AND idade <= 99 THEN 19
            WHEN idade >= 100 THEN 20
            END AS ordem_faixa
        from (
        select
            id,
            TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) AS idade,
            if(identidade_genero is null, 'sem informação', identidade_genero) as identidade_genero
        from
            pacientes
        ) as query_1
        order by ordem_faixa
        ) as query_2
        group by identidade_genero, idade, ordem_faixa
        order by ordem_faixa, identidade_genero;
    ";
}
