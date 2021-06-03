<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class IdaSistemaSaudePrescricoesMedicas extends ChartComponent
{
    protected string $componentView = 'components.charts.ida-sistema-saude-prescricoes-medicas';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $colletionToChartDataset = new CollectionToChartDatasets(
            'medicamento',
            'cor_raca',
            'total',
            $collection
        );

        return [
            'labels' => array_values(array_unique(join_colors_to_black($collection))),
            'sublabels' => $colletionToChartDataset->getLabels(),
            'datasets' => stack_black_colors($colletionToChartDataset->getDatasets())
        ];
    }

    private $query = "
        SELECT
            medicamento,
            cor_raca,
            COUNT(*) AS total
        FROM
            (
            SELECT
                cor_raca,
                CASE
                WHEN si.recebeu_med_covid NOT LIKE '%azitromicina%' THEN 'Somente outros medicamentos'
                WHEN si.recebeu_med_covid LIKE '%azitromicina%' and si.recebeu_med_covid LIKE '%,%' THEN 'Azitromicina e outros medicamentos'
                WHEN si.recebeu_med_covid LIKE '%azitromicina%' and si.recebeu_med_covid NOT LIKE '%,%' THEN 'Somente Azitromicina'
                END AS medicamento,
                pac.id
            FROM
                pacientes pac
                LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
            WHERE
                si.quant_ida_servico > 0
                and si.recebeu_med_covid is not null
            ORDER BY
                1
            ) TB
        group by
            cor_raca,
            medicamento
        order by
            medicamento,
            cor_raca;
    ";
}
