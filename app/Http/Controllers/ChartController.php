<?php

namespace App\Http\Controllers;

use App\Enums\ChartsEnum;
use Elao\Enum\Exception\InvalidValueException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    public function index()
    {
        $charts = ChartsEnum::readables();
        $chart = ChartsEnum::CASOS_MONITORADOS;

        try {
            $chart = ChartsEnum::get(request('chart'), ChartsEnum::CASOS_MONITORADOS)->getValue();
        } catch (InvalidValueException $ex) {
            Log::warning($ex->getMessage(), [
                'user_id' => Auth::user()->id
            ]);
        }

        return view('pages.charts', [
            'charts' => $charts
        ])->with([
            'datefrom' => request('datefrom', '2020-03-01'),
            'dateto' => request('dateto', now()->format('Y-m-d')),
            'chart' => $chart,
            'chartComponent' => 'charts.' . $chart,
        ]);
    }
}
