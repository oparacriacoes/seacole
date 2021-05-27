<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TempoInternacaoRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.tempo-internacao-raca-cor';

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
            tempo_internacao as label,
            COALESCE(SUM(sem_informacao), 0) AS sem_informacao,
            COALESCE(SUM(preta), 0) AS preta,
            COALESCE(SUM(parda), 0) AS parda,
            COALESCE(SUM(branca), 0) AS branca,
            COALESCE(SUM(amarela), 0) AS amarela,
            COALESCE(SUM(indigena), 0) AS indigena
        FROM
            (
            SELECT
                REPLACE(si.tempo_internacao, ' dias', '') AS tempo_internacao,
                CAST(
                REPLACE(si.tempo_internacao, ' dias', '') AS SIGNED
                ) AS tempo_internacao_order,
                CASE
                WHEN cor_raca IS NULL THEN COUNT(pac.id)
                END AS sem_informacao,
                CASE
                WHEN cor_raca = 'Preta' THEN COUNT(pac.id)
                END AS preta,
                CASE
                WHEN cor_raca = 'Parda' THEN COUNT(pac.id)
                END AS parda,
                CASE
                WHEN cor_raca = 'Branca' THEN COUNT(pac.id)
                END AS branca,
                CASE
                WHEN cor_raca = 'Amarela' THEN COUNT(pac.id)
                END AS amarela,
                CASE
                WHEN cor_raca = 'Indígena' THEN COUNT(pac.id)
                END AS indigena
            FROM
                pacientes pac
                INNER JOIN servico_internacaos si ON si.paciente_id = pac.id
            WHERE
                tempo_internacao IS NOT NULL
            GROUP BY
                tempo_internacao,
                cor_raca
            ) TB
        GROUP BY
            tempo_internacao,
            tempo_internacao_order
        ORDER BY
            tempo_internacao_order;
    ";
}
