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
        $data = Paciente::selectRaw("DATE_FORMAT(data_inicio_monitoramento, '%Y-%m') date, count(id) value")
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->whereNotNull('data_inicio_monitoramento')
            ->get();

        // quem é mais velho data_inicio_monitoramento ou data_inicio_ac_psicologico

        return response()->json($data);
    }
}
