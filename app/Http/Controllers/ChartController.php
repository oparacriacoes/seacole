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
        ])->with([
            'datefrom' => request('datefrom', '2020-03-01'),
            'dateto' => request('dateto', now()->format('Y-m-d')),
            'chart' => request('chart', 1)
        ]);
    }
}
