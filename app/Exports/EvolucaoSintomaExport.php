<?php

namespace App\Exports;

use App\Models\EvolucaoSintoma;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class EvolucaoSintomaExport implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function title(): string
    {
        return 'Monitoramentos';
    }

    public function view(): View
    {
        return view('pages.paciente.prontuario')
            ->with([
                'prontuarios' => EvolucaoSintoma::orderBy('paciente_id')->get()
            ]);
    }
}
