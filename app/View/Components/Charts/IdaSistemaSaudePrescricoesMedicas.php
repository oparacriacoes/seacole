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
                WHEN medicamento IS NULL THEN 'Não recebeu nenhum medicamento'
                WHEN medicamento IN (
                    'Medico do SUS receitou, Azitromicina',
                    'médico hospital, Azitromicina',
                    'médico sus, Azitromicina',
                    'Último dia de Azitromicina'
                ) THEN 'Recebeu somente azitromicina'
                WHEN medicamento LIKE '%azitromicina%' THEN 'Azitromicina e outros medicamentos'
                ELSE 'Somente outros medicamentos'
                END AS medicamento,
                pac.id
            FROM
                pacientes pac
                LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
                LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
            WHERE
                quant_ida_servico > 1
            ORDER BY
                1
            ) TB
        group by
            cor_raca,
            medicamento
        order by
            medicamento,
            cor_raca; 
            ;
    ";
}
