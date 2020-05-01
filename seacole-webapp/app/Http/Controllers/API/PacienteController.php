<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Paciente;
use App\Sintoma;
use App\AjudaTipo;
use App\EstadoEmocional;
use App\Observacao;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pacientes = User::where('role', 'paciente')->get();

      return response()->json(['pacientes' => $pacientes]);
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
      $user->password = $request->input('email');
      $user->role = "paciente";
      try {
        $user->save();
      } catch(\Exception $exception) {
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      if($user){
        $paciente = new Paciente;
        $paciente->user_id = $user->id;
        $paciente->data_nascimento = $request->input('data_nascimento');
        $paciente->endereco_cep = $request->input('endereco_cep');
        $paciente->endereco_rua = $request->input('endereco_rua');
        $paciente->endereco_numero = $request->input('endereco_numero');
        $paciente->endereco_bairro = $request->input('endereco_bairro');
        $paciente->endereco_cidade = $request->input('endereco_cidade');
        $paciente->endereco_uf = $request->input('endereco_uf');
        $paciente->endereco_complemento = $request->input('endereco_complemento');
        $paciente->fone_fixo = $request->input('fone_fixo');
        $paciente->fone_celular = $request->input('fone_celular');
        $paciente->numero_pessoas_residencia = $request->input('numero_pessoas_residencia');
        $paciente->doenca_cronica = $request->input('doenca_cronica');
        $paciente->outras_doencas = $request->input('outras_doencas');
        $paciente->remedios_consumidos = $request->input('remedios_consumidos');
        $paciente->acompanhamento_medico = $request->input('acompanhamento_medico');
        $paciente->isolamento_residencial = $request->input('isolamento_residencial');
        $paciente->alimentacao_disponivel = $request->input('alimentacao_disponivel');
        $paciente->auxilio_terceiros = $request->input('auxilio_terceiros');
        $paciente->tarefas_autocuidado = $request->input('tarefas_autocuidado');
        try {
          $paciente->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      $sintomas = $request->input('sintomas');
      $sintoma = new Sintoma;
      $sintoma->paciente_id = $paciente->id;
      $sintoma->data_inicio_sintoma = $sintomas['data_inicio_sintoma'];
      $sintoma->sintoma_manifestado = $sintomas['sintoma_manifestado'];
      $sintoma->febre_temperatura_maxima = $sintomas['febre_temperatura_maxima'];
      $sintoma->data_medicao_temperatura = $sintomas['data_medicao_temperatura'];
      $sintoma->temperatura_atual = $sintomas['temperatura_atual'];
      $sintoma->cansaco_saturacao = $sintomas['cansaco_saturacao'];
      $sintoma->cansaco_frequencia_respiratoria = $sintomas['cansaco_frequencia_respiratoria'];
      try {
        $sintoma->save();
      } catch(\Exception $exception) {
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      $ajudas = $request->input('ajuda_tipo');
      for($a = 0; $a < count($ajudas); $a++){
        $ajuda = new AjudaTipo;
        $ajuda->paciente_id = $paciente->id;
        $ajuda->tipo = $ajudas[$a];
        try {
          $ajuda->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      $emocionais = $request->input('estado_emocional');
      $emocional = new EstadoEmocional;
      $emocional->paciente_id = $paciente->id;
      $emocional->situacao = $emocionais['situacao'];
      $emocional->medo = $emocionais['medo'];
      try {
        $emocional->save();
      } catch(\Exception $exception) {
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      $observacoes = $request->input('observacoes');
      if($observacoes){
        $observacao = new Observacao;
        $observacao->paciente_id = $paciente->id;
        $observacao->comentarios = $observacoes;
        try {
          $observacao->save();
        } catch(\Exception $exception) {
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      return response()->json(['message' => 'Cadastro feito com sucesso.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $paciente = Paciente::find($id);
      $paciente->user;

      return response()->json(['paciente' => $paciente]);
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
      $paciente = Paciente::find($id);
      $paciente->user;

      return response()->json([
        'paciente' => $paciente,
      ]);
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
