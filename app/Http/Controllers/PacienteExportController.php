<?php

namespace App\Http\Controllers;

use App\Exports\HistoricoMonitoramentoExport;
use App\Exports\HistoricoVacinacaoExport;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PacienteExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pacient-export.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('export_evolucao_sintomas')) {
            $filename = 'historico_monitoramento_' . now()->format('d_m_Y') . '.xlsx';
            return (new HistoricoMonitoramentoExport())->download($filename);
        } elseif ($request->has('export_vacinacao')) {
            $filename = 'historico_vacinacao_' . now()->format('d_m_Y') . '.xlsx';
            return (new HistoricoVacinacaoExport())->download($filename);
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::select(['id', 'name'])->findOrFail($id);

        if ($request->has('export_evolucao_sintomas')) {
            $filename = 'historico_monitoramento' . Str::slug($paciente->name, '_') . '.xlsx';
            return (new HistoricoMonitoramentoExport($paciente->id))->download($filename);
        }

        return back();
    }
}
