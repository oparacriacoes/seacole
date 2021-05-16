<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RacaCorAuxilioEmergencial extends ChartComponent
{
    protected string $componentView = 'components.charts.raca-cor-auxilio-emergencial';

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
            'datasets' => [

            ],
        ];
    }

    private $query = "
        SELECT
            cor_raca as label,
            COALESCE(SUM(sem_informacao), 0) AS sem_informacao,
            COALESCE(SUM(sim), 0) AS sim,
            COALESCE(SUM(nao), 0) AS nao,
            COALESCE(SUM(sim_preta), 0) AS sim_preta,
            COALESCE(SUM(nao_preta), 0) AS nao_preta,
            COALESCE(SUM(sim_parda), 0) AS sim_parda,
            COALESCE(SUM(nao_parda), 0) AS nao_parda
        FROM
            (
            SELECT
                CASE
                    WHEN cor_raca IS NULL THEN 'Sem info.'
                    WHEN cor_raca IN ('Preta', 'Parda') THEN 'Negra'
                    ELSE cor_raca
                END AS cor_raca,
                CASE
                    WHEN auxilio_emergencial IS NULL THEN COUNT(id)
                END AS sem_informacao,
                CASE
                    WHEN auxilio_emergencial = true
                AND cor_raca NOT IN ('Preta', 'Parda') THEN COUNT(id)
                END AS sim,
                CASE
                    WHEN auxilio_emergencial = false
                AND cor_raca NOT IN ('Preta', 'Parda') THEN COUNT(id)
                END AS nao,
                CASE
                    WHEN auxilio_emergencial = true
                AND cor_raca = 'Preta' THEN COUNT(id)
                END AS sim_preta,
                CASE
                    WHEN auxilio_emergencial = false
                AND cor_raca = 'Preta' THEN COUNT(id)
                END AS nao_preta,
                CASE
                    WHEN auxilio_emergencial = true
                AND cor_raca = 'Parda' THEN COUNT(id)
                END AS sim_parda,
                CASE
                    WHEN auxilio_emergencial = false
                AND cor_raca = 'Parda' THEN COUNT(id)
                END AS nao_parda
            FROM
                pacientes
            GROUP BY auxilio_emergencial, cor_raca
            ) TBB
        GROUP BY cor_raca
        ORDER BY cor_raca;
    ";
}
