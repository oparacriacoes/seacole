<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
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
      //dd($request->all());
      DB::beginTransaction();
      try {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->email);
        $user->role = 'medico';
        $user->save();
        DB::commit();
      } catch(\Exception $e) {
        DB::rollback();
        \Log::info($e);
        return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
      }

      if($user){
        DB::beginTransaction();
        try {
          $medico = new Medico;
          $medico->user_id = $user->id;
          $medico->fone_celular_1 = $request->fone_celular_1;
          $medico->fone_celular_2 = $request->fone_celular_2;
          $medico->save();
          DB::commit();
          return redirect()->route('medico')->with('success', 'Dados salvos com sucesso.');
        } catch(\Exception $e) {
          DB::rollback();
          \Log::info($e);
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
      $medico = Medico::find($id);
      $user = User::find($medico->user_id);

      $delete_medico = Medico::destroy($id);
      $delete_user = User::destroy($user->id);

      return response()->json(['message' => 'Médico excluído com sucesso.']);
    }
}
