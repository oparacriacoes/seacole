<?php

namespace App\View\Components\Charts;

use App\Paciente;
use Illuminate\View\Component;

class DiagnosticoCovidRacarCor extends ChartComponent
{
    protected string $componentView = 'components.charts.diagnostico-covid-racar-cor';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('endereco_cidade, count(id) as total')
            ->groupBy('cor_raca', '')
            ->orderBy('total', 'desc')
            ->get();

        dd($collection);

        // $collection->transform(function ($item, $key) {
        //     if (is_null($item['endereco_cidade'])) {
        //         $item['endereco_cidade'] = 'Sem informação';
        //     }
        //     return $item;
        // });

        return [
            'labels' => $collection->pluck('endereco_cidade'),
            'data' => $collection->pluck('total'),
        ];
    }
}
