<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index($chart_id)
    {
        $chart_view = 'graph-' . $chart_id;
        return view('pages.graficos.' . $chart_view);
    }

    public function novos_casos_monitorados()
    {
        $data = Paciente::selectRaw("DATE_FORMAT(data_inicio_monitoramento, '%Y-%m') date, count(id) value")
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->whereNotNull('data_inicio_monitoramento')
            ->get();

        return response()->json($data);
    }
}
