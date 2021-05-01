<?php

namespace App\Http\Controllers;

use App\Enums\ChartsEnum;
use App\Paciente;
class ChartController extends Controller
{
    public function index()
    {
        $charts = ChartsEnum::readables();

        return view('pages.charts', [
            'charts' => $charts
        ]);
    }

    public function novos_casos_monitorados()
    {
        $data = Paciente::selectRaw("DATE_FORMAT(coalesce(least(data_inicio_monitoramento, data_inicio_ac_psicologico), data_inicio_monitoramento, data_inicio_ac_psicologico) old_date, '%Y-%m') date, count(id) value")
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->whereRaw("coalesce(least(data_inicio_monitoramento, data_inicio_ac_psicologico), data_inicio_monitoramento, data_inicio_ac_psicologico) is not null")
            ->get();

        // quem é mais velho data_inicio_monitoramento ou data_inicio_ac_psicologico

        return response()->json($data);
    }
}
