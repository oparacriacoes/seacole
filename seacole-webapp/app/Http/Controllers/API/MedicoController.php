<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
      $medicos = User::where('role', 'medico')->get();

      return response()->json(['medicos' => $medicos]);
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
      $user->password = $request->input('password');
      $user->role = 'medico';
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message', $exception->getMessage()]);
      }

      if($user){
        $medico = new Medico;
        $medico->user_id = $user->id;
        $medico->fone_fixo = $request->input('fone_fixo');
        $medico->fone_celular = $request->input('fone_celular');
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
      $medico = Medico::find($id);
      $medico->user;

      return response()->json(['medico' => $medico]);
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
        //
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
