<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinaRequest;
use App\Models\Vacina;
use Illuminate\Http\Request;
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
        $vacina = new Vacina();
        return view('pages.gerenciamento.vacinas.create', compact('vacina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VacinaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacinaRequest $request)
    {
        $dataForm = $request->validated();

        try {
            $vacina = Vacina::create($dataForm);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage(), [$dataForm]);
            back()->withInput()->with('error', 'Erro ao cadastrar vacina');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacina $vacina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacina $vacina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacina $vacina)
    {
        //
    }
}
