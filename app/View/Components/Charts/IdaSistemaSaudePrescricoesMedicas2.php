<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;

class IdaSistemaSaudePrescricoesMedicas2 extends ChartComponent
{
    protected string $componentView = 'components.charts.ida-sistema-saude-prescricoes-medicas2';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('medicamento'),
            'data' => $collection->pluck('total')
        ];
    }

    private $query = "
        SELECT
            count(si.id) as total,
            CASE
                WHEN si.recebeu_med_covid NOT LIKE '%azitromicina%' THEN 'Somente outros medicamentos'
                WHEN si.recebeu_med_covid LIKE '%azitromicina%'
                and si.recebeu_med_covid LIKE '%,%' THEN 'Azitromicina e outros medicamentos'
                WHEN si.recebeu_med_covid LIKE '%azitromicina%'
                and si.recebeu_med_covid NOT LIKE '%,%' THEN 'Somente Azitromicina'
            END AS medicamento
        FROM
            pacientes pac
            LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
        WHERE
            si.quant_ida_servico > 0
            and si.recebeu_med_covid is not null
            and pac.cor_raca = 'parda'
        group by medicamento
        ORDER BY
            1;
    ";
}
