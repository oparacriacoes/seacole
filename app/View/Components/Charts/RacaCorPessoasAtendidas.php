<?php

namespace App\View\Components\Charts;

use App\Models\Paciente;

class RacaCorPessoasAtendidas extends ChartComponent
{
    protected string $componentView = 'components.charts.raca-cor-pessoas-atendidas';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('cor_raca, count(id) as total')
            ->groupBy('cor_raca')
            ->orderBy('cor_raca', 'desc')
            ->get();

        $collection->transform(function ($item) {
            if (is_null($item['cor_raca'])) {
                $item['cor_raca'] = 'Sem informação';
            }
            return $item;
        });

        $black_sum = $collection->whereIn('cor_raca', ['Preta', 'Parda'])->sum('total');
        $black_percentual = number_format(($black_sum * 100 / $collection->sum('total')), 2);

        return [
            'labels' => $collection->pluck('cor_raca'),
            'data' => $collection->pluck('total'),
            'title' => "Pessoas negras (pretas + parda) totalizam ${black_percentual}% do total"
        ];
    }
}
