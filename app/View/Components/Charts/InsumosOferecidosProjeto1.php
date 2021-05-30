<?php

namespace App\View\Components\Charts;

use App\Enums\MateriaisEntreguesEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class InsumosOferecidosProjeto1 extends ChartComponent
{
    protected string $componentView = 'components.charts.insumos-oferecidos-projeto1';

    public function chartData(): array
    {
        $collection = collect();
        $filters = array_slice(MateriaisEntreguesEnum::readables(), 0, 3, true);

        foreach ($filters as $key => $value) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    strtolower('%' . $key . '%'),
                    $value,
                    $value
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'info',
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
        select
            count(id) as total,
            cor_raca,
            material_entregue as info
        from (
            select
                p.id,
                CASE
                    WHEN cor_raca is null THEN 'Sem Informação'
                    ELSE cor_raca
                END as cor_raca,
                CASE
                    WHEN LOWER(io.material_entregue) like ? THEN CONCAT(?, ' - Sim')
                    ELSE CONCAT(?, ' - Não')
                END AS material_entregue
            from
                pacientes p
                inner join insumos_oferecidos io on io.paciente_id = p.id
            order by
                material_entregue desc,
                cor_raca
            ) as tb
        group by
            cor_raca,
            info
        order by
            info desc,
            cor_raca;
            ";
}
