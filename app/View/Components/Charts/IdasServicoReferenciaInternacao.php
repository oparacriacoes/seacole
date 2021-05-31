<?php

namespace App\View\Components\Charts;

use App\Enums\SituacoesCaso;
use App\Paciente;
use Illuminate\Support\Facades\DB;

class IdasServicoReferenciaInternacao extends ChartComponent
{
    protected string $componentView = 'components.charts.idas-servico-referencia-internacao';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('idas_servico_saude'),
            'data' => $collection->pluck('total'),
        ];
    }

    private $query = "
        SELECT
            COALESCE(quant_ida_servico, 0) idas_servico_saude,
            COUNT(pac.id) total
        FROM
            pacientes pac
        LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
        GROUP BY
            idas_servico_saude
        ORDER BY 1;
    ";
}
