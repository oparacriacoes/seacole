<?php

namespace App\Http\Controllers;

use App\Enums\SintomasManifestadosEnum;
use App\Helpers\BuilderSelectRawFromModel;
use App\Models\EvolucaoSintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bsfm = new BuilderSelectRawFromModel(new EvolucaoSintoma());
        $bsfm->loadEnums('sintomas_atuais', SintomasManifestadosEnum::readables());
        $select = $bsfm->getSelect();

        $query = "select $select from " . $bsfm->getTable() . ";";

        dd($query);

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

            $cases_raw = "";
            $sintomas_atuais = SintomasManifestadosEnum::readables();

            foreach($sintomas_atuais as $key => $value) {
                $column = str_replace('-', '_', $key);
                $cases_raw .= <<<EOT
                CASE 
                    WHEN evolucao_sintomas.sintomas_atuais is null THEN null
                    WHEN evolucao_sintomas.sintomas_atuais like '%$key%' THEN 'sim'
                    ELSE 'não'
                END as $column,
    EOT;
            }



            $select_raw = <<<EOT
            evolucao_sintomas.data_monitoramento,
            evolucao_sintomas.horario_monitoramento,
            $cases_raw
            evolucao_sintomas.sintomas_outro,
            evolucao_sintomas.temperatura_atual,
            evolucao_sintomas.frequencia_cardiaca_atual,
            evolucao_sintomas.algum_sinal,
            evolucao_sintomas.saturacao_atual,
            evolucao_sintomas.pressao_arterial_atual,
            evolucao_sintomas.equipe_medica,
            evolucao_sintomas.frequencia_respiratoria_atual,
            evolucao_sintomas.medicamento

EOT;

            $data = DB::table('evolucao_sintomas')
                ->join('pacientes', 'evolucao_sintomas.paciente_id', '=', 'pacientes.id')
                ->select(['pacientes.id', 'pacientes.name', 'pacientes.data_nascimento', 'pacientes.cor_raca',
                    DB::raw($select_raw)
                ])
                ->whereNotNull('pacientes.id')
                ->orderBy('pacientes.id', 'asc')
                ->limit(10)
                ->get();

            return $data;
        }

        return $request;
    }
}
