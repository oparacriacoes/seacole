<?php

namespace App\Http\Controllers;

use App\Actions\UpdateVacina;
use App\Http\Requests\VacinaRequest;
use App\Models\Vacina;
use App\Models\Vacinacao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class VacinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacinas = Vacina::orderBy('name')->get();
        return view('pages.gerenciamento.vacinas.index', compact('vacinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vacina = new Vacina(['doses' => 1]);
        return view('pages.gerenciamento.vacinas.create', compact('vacina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VacinaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacinaRequest $request)
    {
        $dataForm = $request->validated();
        $dataForm['reference_key'] = (string) Str::of($dataForm['name'])->slug('_');

        try {
            $vacina = Vacina::create($dataForm);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage(), [$dataForm]);
            return back()->withInput()->with('error', 'Erro ao cadastrar vacina');
        }

        return redirect(route('vacinas.show', $vacina));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function show(Vacina $vacina)
    {
        $pacientes_vacinados = 0;
        $pacientes_parcialmente_vacinados = 0;

        if ($vacina->doses === 1)
        {
            $pacientes_vacinados = Vacinacao::where('vacina_id', $vacina->id)->count();
        } else {
            $rows = Vacinacao::where('vacina_id', $vacina->id)
                ->select('paciente_id', DB::raw('COUNT(id) as doses'))
                ->groupBy('paciente_id', 'vacina_id')
                ->get();

            $pacientes_vacinados = $rows->where('doses', '>=', $vacina->doses)->count();
            $pacientes_parcialmente_vacinados = $rows->where('doses', '<', $vacina->doses)->count();
        }

        return view('pages.gerenciamento.vacinas.show', compact('vacina', 'pacientes_vacinados', 'pacientes_parcialmente_vacinados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacina $vacina)
    {
        return view('pages.gerenciamento.vacinas.edit', compact('vacina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VacinaRequest  $request
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function update(VacinaRequest $request, Vacina $vacina)
    {
        try {
            $vacina_updated = UpdateVacina::update($vacina, $request->validated());
        } catch (\Exception $ex) {
            Log::error($ex->getMessage(), $request->validated());
            return back()->withInput()->with('error', 'Erro ao alterar informações da vacina');
        }

        return redirect(route('vacinas.show', $vacina_updated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacina $vacina)
    {
        $vacina->delete();
        return redirect(route('vacinas.index'));
    }
}
