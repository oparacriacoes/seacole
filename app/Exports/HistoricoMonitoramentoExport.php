<?php

namespace App\Exports;

use App\Enums\SintomasManifestadosEnum;
use App\Helpers\BuilderSelectRawFromModel;
use App\Models\EvolucaoSintoma;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoricoMonitoramentoExport implements FromQuery, WithHeadings
{
    use Exportable;

    private ?string $pacienteId;
    private BuilderSelectRawFromModel $builderSelectRawFromModel;

    public function __construct(?int $pacienteId = null)
    {
        $this->pacienteId = $pacienteId;
        $this->builderSelectRawFromModel = new BuilderSelectRawFromModel(new EvolucaoSintoma());
        $this->builderSelectRawFromModel->loadEnums('sintomas_atuais', SintomasManifestadosEnum::readables());
        $this->builderSelectRawFromModel->mount();
    }

    public function headings(): array
    {
        $headings = ['nome', 'data_nascimento', 'cor_raca'];
        array_push($headings, ...$this->builderSelectRawFromModel->getHeadings());
        return $headings;
    }

    public function query()
    {
        $query = DB::table('evolucao_sintomas')
            ->join('pacientes', 'evolucao_sintomas.paciente_id', '=', 'pacientes.id')
            ->select([
                'pacientes.name',
                'pacientes.data_nascimento',
                'pacientes.cor_raca',
                DB::raw($this->builderSelectRawFromModel->getSelectRaw())
            ])
            ->whereNotNull('pacientes.id')
            ->when($this->pacienteId, function ($query, $pacienteId) {
                return $query->where('evolucao_sintomas.paciente_id', $pacienteId);
            })
            ->orderBy('pacientes.name');

        return $query;
    }
}
