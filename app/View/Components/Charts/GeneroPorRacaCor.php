<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use App\Models\Paciente;

class GeneroPorRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.genero-por-raca-cor';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('identidade_genero, cor_raca, count(id) as total')
            ->groupBy('cor_raca', 'identidade_genero')
            ->orderBy('identidade_genero')
            ->orderBy('cor_raca')
            ->get();

        $collectionToChartDataset = new CollectionToChartDatasets('identidade_genero', 'cor_raca', 'total', $collection);

        return [
            'labels' => $collectionToChartDataset->getLabels(),
            'datasets' => $collectionToChartDataset->getDatasets(),
        ];
    }
}
