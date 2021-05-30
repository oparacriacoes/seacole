<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Agente;
use DB;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->email);
        $user->role = 'agente';
        DB::beginTransaction();
        try {
            DB::commit();
            $user->save();
        } catch (\Exception $exception) {
            //return response()->json(['message' => $exception->getMessage()]);
            DB::rollback();
            \Log::info($exception);
            return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
        }

        if ($user) {
            $agente = new Agente;
            $agente->user_id = $user->id;
            $agente->fone_celular_1 = $request->fone_celular_1;
            $agente->fone_celular_2 = $request->fone_celular_2;
            DB::beginTransaction();
            try {
                DB::commit();
                $agente->save();
                return redirect()->route('agente')->with('success', 'Cadastro efetuado com sucesso.');
            } catch (\Exception $exception) {
                DB::rollback();
                \Log::info($exception);
                //return response()->json(['message' => $exception->getMessage()]);
                return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        DB::beginTransaction();
        try {
            $agente = Agente::find($id);
            $user = User::find($agente->user->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password_confirm !== null) {
                $user->password = Hash::make($request->password_confirm);
            }
            $user->role = 'agente';
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
        }

        if ($user) {
            DB::beginTransaction();
            try {
                $agente->user_id = $user->id;
                $agente->fone_celular_1 = $request->input('data')['fone_celular_1'];
                $agente->fone_celular_2 = $request->input('data')['fone_celular_2'];
                $agente->save();
                DB::commit();
                return redirect()->route('')->with('success', 'Dados alterados com sucesso.');
            } catch (\Exception $e) {
                DB::rollback();
                \Log::info($e);
                return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agente = Agente::find($id);
        $user = User::find($agente->user_id);

        $delete_agente = Agente::destroy($id);
        $delete_user = User::destroy($user->id);

        return redirect()->back()->with('success', 'Agente removido com sucesso.');
    }
}
