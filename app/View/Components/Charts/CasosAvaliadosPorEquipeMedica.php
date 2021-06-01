<?php

namespace App\View\Components\Charts;

use Illuminate\Support\Facades\DB;

class CasosAvaliadosPorEquipeMedica extends ChartComponent
{
    protected string $componentView = 'components.charts.casos-avaliados-por-equipe-medica';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        return [
            'labels' => $collection->pluck('medicos'),
            'data' => $collection->pluck('quantidade_pacientes'),
        ];
    }

    private $query = "
        SELECT
            COALESCE(us.name, 'Sem acompanhamento médico') AS medicos,
            COUNT(pac.id) AS quantidade_pacientes
        FROM
            pacientes pac
            LEFT JOIN medicos md ON pac.medico_id = md.id
            LEFT JOIN users us ON md.user_id = us.id
        GROUP BY
            us.name;
    ";
}
