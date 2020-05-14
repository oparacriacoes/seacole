<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Medico;

class MedicoController extends Controller
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
      $user->name = $request->input('data')['name'];
      $user->email = $request->input('data')['email'];
      $user->password = Hash::make($request->input('data')['email']);
      $user->role = 'medico';
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message', $exception->getMessage()]);
      }

      if($user){
        $medico = new Medico;
        $medico->user_id = $user->id;
        $medico->fone_celular_1 = $request->input('data')['fone_celular_1'];
        $medico->fone_celular_2 = $request->input('data')['fone_celular_2'];
        try {
          $medico->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()]);
        }
      }

      return response()->json(['message' => 'Cadastro feito com sucesso.']);
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
      $medico = Medico::find($id);
      $user = $medico->user;
      $user->name = $request->input('data')['name'];
      $user->email = $request->input('data')['email'];
      if( $request->input('data')['password_confirm'] !== null ){
        $user->password = Hash::make($request->input('data')['password_confirm']);
      }
      $user->role = 'medico';
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message', $exception->getMessage()]);
      }

      if($user){
        $medico->user_id = $user->id;
        $medico->fone_celular_1 = $request->input('data')['fone_celular_1'];
        $medico->fone_celular_2 = $request->input('data')['fone_celular_2'];
        try {
          $medico->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()]);
        }
    }

    return response()->json(['message' => 'Cadastro atualizado com sucesso.']);
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return null;
    }
}
