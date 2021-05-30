<?php

namespace App\Http\Controllers;

use App\Enums\DesfechosEnum;
use App\Enums\SintomasIniciais;
use App\Models\Paciente;
use App\Models\QuadroAtual;

class DashboardController extends Controller
{
    public function index()
    {
        $pacientes_total = Paciente::count();
        $casos_confirmado = Paciente::where('sintomas_iniciais', SintomasIniciais::CONFIRMADO)->count();
        $total_obitos = QuadroAtual::where('desfecho', DesfechosEnum::OBITO_COVID)->count();

        return view('pages.dashboard', [
            'pacientes_total' => $pacientes_total,
            'casos_confirmado' => $casos_confirmado,
            'total_obitos' => $total_obitos
        ]);
    }
}
