<?php

namespace App\Http\Controllers;

use App\Models\Articuladora;
use App\Models\Monitoramento;
use App\Models\Paciente;
use App\Models\QuadroAtual;
use App\Models\ServicoInternacao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NormalizeData extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function getModel($key)
    {
        $models = [
            'pacientes' => Paciente::class,
            'monitoramentos' => Monitoramento::class,
            'servicos_internacao' => ServicoInternacao::class,
            'quadros' => QuadroAtual::class
        ];

        return $models[$key];
    }

    private function getDateFields($key)
    {
        $fields = [
            'pacientes' => [
                'data_inicio_ac_psicologico',
                'data_encerramento_ac_psicologico',
                'data_ultima_consulta',
                'data_ultima_mestrucao',
                'data_parto',
                'data_finalizacao_caso',
                'data_inicio_monitoramento',
                'data_inicio_sintoma',
                'data_teste_confirmatorio',
                'data_nascimento'
            ],
            'monitoramentos' => [
                'data_monitoramento'
            ],
            'servicos_internacao' => [
                'data_ultima_ida_servico_de_saude',
                'data_entrada_internacao',
                'data_alta_hospitalar'
            ],
            'quadros' => [
                'data_temp_max',
                'data_sat_max',
                'data_freq_max'
            ]
        ];

        return $fields[$key];
    }

    private $valid_normalize = true;

    public function index(Request $request)
    {
        $modelKey = $request->get('model', 'pacientes');
        $model = $this->getModel($modelKey);
        $dateFields = $this->getDateFields($modelKey);
        $defaultFields = ['id'];

        if ($modelKey != 'pacientes') {
            array_push($defaultFields, 'paciente_id');
        }

        $fields = array_merge($defaultFields, $dateFields);

        $collection = $model::where(function ($query) use ($dateFields) {
            foreach ($dateFields as $field) {
                $query->orWhereNotNull($field);
            }
        })->select($fields)->get();

        $collection->each(function ($row) use ($dateFields) {
            foreach ($dateFields as $field) {
                if ($row[$field]) {
                    $old_date = $row[$field];
                    $new_date = $this->applyFormat($old_date);

                    $row[$field] = [
                        'old' => $old_date,
                        'new' => $new_date,
                        'valid' => $old_date == $new_date
                    ];
                }
            }
        });

        $valid_normalize = $this->valid_normalize;

        return view('pages.normalize.index', compact('collection', 'fields', 'modelKey', 'valid_normalize'));
    }

    public function update(Request $request)
    {
        $modelKey = $request->get('model', 'pacientes');
        $model = $this->getModel($modelKey);
        $fields = $this->getDateFields($modelKey);

        $collection = $model::where(function ($query) use ($fields) {
            foreach ($fields as $field) {
                $query->orWhereNotNull($field);
            }
        })->select(array_merge(['id'], $fields))->get();

        $collection->each(function ($row) use ($fields) {
            foreach ($fields as $field) {
                if ($row[$field]) {
                    $row[$field] = $this->applyFormat($row[$field]);
                }
            }
            $row->save();
        });

        return redirect(route('normalize.index', ['model' => $modelKey]));
    }

    private function applyFormat($date)
    {
        if (Carbon::hasFormat($date, 'd/m/Y')) {
            return Carbon::createFromFormat('d/m/Y', $date)->toDateString();
        } elseif (Carbon::hasFormat($date, 'd/m/y')) {
            return Carbon::createFromFormat('d/m/y', $date)->toDateString();
        }

        try {
            $date = new Carbon($date);
            return $date->toDateString();
        } catch (\Throwable $th) {
            $this->valid_normalize = false;
        }

        return "ERROR";
    }
}
