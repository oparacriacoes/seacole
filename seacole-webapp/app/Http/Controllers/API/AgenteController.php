<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Agente;

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
      $user = new User;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      //$user->password = $request->input('password');
      $user->password = Hash::make($request->input('email'));
      $user->role = 'agente';
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message' => $exception->getMessage()]);
      }

      if($user){
        $agente = new Agente;
        $agente->user_id = $user->id;
        $agente->fone_fixo = $request->input('fone_fixo');
        $agente->fone_celular = $request->input('fone_celular');
        try {
          $agente->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()]);
        }
      }

      //return response()->json(['message' => 'Cadastro feito com sucesso.']);
      return view('pages.agente.create')->with(['success' => 'Cadastro feito com sucesso.']);
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
      $user = User::find($id);
      $agente = $user->agente;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('email'));
      $user->role = 'agente';
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message' => $exception->getMessage()]);
      }

      if($user){
        //$agente = new Agente;
        $agente->user_id = $user->id;
        $agente->fone_fixo = $request->input('fone_fixo');
        $agente->fone_celular = $request->input('fone_celular');
        try {
          $agente->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()]);
        }
      }
      return view('pages.agente.create')->with(['success' => 'Cadastro atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
