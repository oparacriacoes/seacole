<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;

class IdaSistemaSaudePrescricoesMedicas1 extends ChartComponent
{
    protected string $componentView = 'components.charts.ida-sistema-saude-prescricoes-medicas1';

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
                WHEN si.recebeu_med_covid is null THEN 'Nenhum medicamento prescrito'
            END AS medicamento
        FROM
            pacientes pac
            LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
        WHERE
            si.quant_ida_servico > 0
            and pac.cor_raca = 'preta'
        group by medicamento
        ORDER BY
            1;
    ";
}
