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
use App\DoencaCronica;

class PacienteController extends Controller
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
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = $request->input('email');
      $user->role = "paciente";
      try {
        $user->save();
      } catch(\Exception $exception) {
        echo 'user response:';
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
          echo 'paciente response:';
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      //$cronicas = $paciente->doenca_cronica = $request->input('doenca_cronica');
      /*for($c = 0; $c < count($cronicas); $c++){
        if($cronicas[$c] !== null){
          $cronica = new DoencaCronica;
          $cronica->paciente_id = $paciente->id;
          $cronica->tipo = $cronicas[$c];
          try {
            $cronica->save();
          } catch(\Exception $exception) {
            echo 'cronica response:';
            return response()->json(['message' => $exception->getMessage()], 500);
          }
        }
      }*/
      $cronica = new DoencaCronica;
      $cronica->paciente_id = $paciente->id;
      $cronica->tipo = json_encode($request->input('doenca_cronica'));
      try {
        $cronica->save();
      } catch(\Exception $exception) {
        echo 'cronica response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      $sintomas = json_encode($request->input('sintomas'));
      $sintoma = new Sintoma;
      $sintoma->paciente_id = $paciente->id;
      $sintoma->data_inicio_sintoma = $request->input('data_inicio_sintoma');
      $sintoma->sintoma_manifestado = $sintomas;
      $sintoma->febre_temperatura_maxima = $request->input('febre_temperatura_maxima');
      $sintoma->data_medicao_temperatura = $request->input('data_medicao_temperatura');
      $sintoma->temperatura_atual = $request->input('temperatura_atual');
      $sintoma->cansaco_saturacao = $request->input('cansaco_saturacao');
      $sintoma->cansaco_frequencia_respiratoria = $request->input('cansaco_frequencia_respiratoria');
      try {
        $sintoma->save();
      } catch(\Exception $exception) {
        echo 'sintoma response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      $ajudas = $request->input('ajuda_tipo');
      for($a = 0; $a < count($ajudas); $a++){
        if($ajudas[$a] !== null){
          $ajuda = new AjudaTipo;
          $ajuda->paciente_id = $paciente->id;
          $ajuda->tipo = $ajudas[$a];
          try {
            $ajuda->save();
          } catch(\Exception $exception) {
            echo 'ajuda response:';
            return response()->json(['message' => $exception->getMessage()], 500);
          }
        }
      }

      $emocionais = $request->input('estado_emocional');
      $emocional = new EstadoEmocional;
      $emocional->paciente_id = $paciente->id;
      $emocional->situacao = $request->input('estado_emocional');
      $emocional->medo = $request->input('medo');
      try {
        $emocional->save();
      } catch(\Exception $exception) {
        echo 'emocional response:';
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
          echo 'observacao response:';
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      //return response()->json(['message' => 'Cadastro feito com sucesso.'], 200);
      return view('pages.paciente.create')->with(['success' => 'Cadastro feito com sucesso.']);
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
      $paciente = $user->paciente;
      $cronica_search = $paciente->doencas_cronicas;
      $cronicas = DoencaCronica::find($cronica_search[0]->id);
      //dd($cronica);
      //$cronicas = $paciente->doencas_cronicas;
      $sintomas_search = $paciente->sintomas;
      $sintomas = Sintoma::find($sintomas_search[0]->id);
      $ajudas_search = $paciente->tipos_ajuda;
      //dd($ajudas_search[0]);
      $ajuda = AjudaTipo::find($ajudas_search[0]->id);
      $emocionais_search = $paciente->estado_emocional;
      $emocional = EstadoEmocional::find($emocionais_search->id);
      $observacao_search = $paciente->observacao;
      $observacao_search ? $observacao = Observacao::find($paciente->observacao->id) : $observacao = new Observacao;

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->role = "paciente";
      try {
        $user->save();
      } catch(\Exception $exception) {
        echo 'user response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      if($user){
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
          echo 'paciente response:';
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      //dd($cronicas->tipo);
      $input_cronicas = $paciente->doenca_cronica = $request->input('doenca_cronica');
      $old_cronicas = [];
      $new_cronicas = [];
      /*foreach($cronicas as $old){
        echo $old;
        exit;
        array_push($old_cronicas, $old->tipo);
      }*/
      $cronicas_decode = (array) json_decode($cronicas->tipo);
      for($o = 0; $o < count($cronicas_decode); $o++){
        array_push($old_cronicas, $cronicas_decode[$o]);
      }
      //dd($old_cronicas);
      for($i = 0; $i < count($input_cronicas); $i++){
        if($input_cronicas[$i] !== null){
          array_push($new_cronicas, $input_cronicas[$i]);
        }
      }
      //dd($new_cronicas);
      $current_cronicas =  array_values(array_diff(array_merge($old_cronicas, $new_cronicas),array_intersect($old_cronicas, $new_cronicas)));
      //$current_cronicas = array_unique(array_merge($old_cronicas, $new_cronicas));

      if(!$current_cronicas){
        $cronicas->tipo = json_encode($request->input('doenca_cronica'));
      } else {
        $cronicas->tipo = $new_cronicas;
      }
      //dd($cronicas);
      //exit;
      try {
        $cronicas->save();
      } catch(\Exception $exception) {
        echo 'cronica response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      /*for($c = 0; $c < count($current_cronicas); $c++){
        if($current_cronicas[$c] !== null){
          $final_cronica = new DoencaCronica;
          $final_cronica->paciente_id = $paciente->id;
          $final_cronica->tipo = $current_cronicas[$c];
          try {
            $final_cronica->save();
          } catch(\Exception $exception) {
            echo 'cronica response:';
            return response()->json(['message' => $exception->getMessage()], 500);
          }
        }
      }*/

      //$input_sintomas = $paciente->sintomas = json_encode($request->input('sintomas'));
      $input_sintomas = $paciente->sintomas = $request->input('sintomas');
      $old_sintomas = [];
      $new_sintomas = [];
      //dd($sintomas[0]->sintoma_manifestado);

      $sintomas_decode = (array) json_decode($sintomas->sintoma_manifestado);
      //echo count($sintomas_decode);
      //dd(array_values($sintomas_decode));

      for($o = 0; $o < count($sintomas_decode); $o++){
        array_push($old_sintomas, array_values($sintomas_decode)[$o]);
      }

      for($s = 0; $s < count($request->input('sintomas')); $s++){
        if($input_sintomas[$s] !== null){
          array_push($new_sintomas, $input_sintomas[$s]);
        }
      }
      //var_dump($old_sintomas);
      //var_dump($new_sintomas);
      //exit;

      $current_sintomas =  array_values(array_diff(array_merge($old_sintomas, $new_sintomas),array_intersect($old_sintomas, $new_sintomas)));
      //$current_sintomas = array_unique(array_merge($old_sintomas, $new_sintomas));
      //dd($sintomas);
      if(!$current_sintomas){
        $sintomas->sintoma_manifestado = $request->input('sintomas');
      } else {
        $sintomas->sintoma_manifestado = $new_sintomas;
      }
      //dd($sintomas);
      //dd($current_sintomas);

      $sintomas->paciente_id = $paciente->id;
      $sintomas->data_inicio_sintoma = $request->input('data_inicio_sintoma');
      //$sintomas->sintoma_manifestado = $current_sintomas;
      $sintomas->febre_temperatura_maxima = $request->input('febre_temperatura_maxima');
      $sintomas->data_medicao_temperatura = $request->input('data_medicao_temperatura');
      $sintomas->temperatura_atual = $request->input('temperatura_atual');
      $sintomas->cansaco_saturacao = $request->input('cansaco_saturacao');
      $sintomas->cansaco_frequencia_respiratoria = $request->input('cansaco_frequencia_respiratoria');
      //dd($sintomas);
      try {
        $sintomas->save();
      } catch(\Exception $exception) {
        echo 'cronica response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      /*$sintoma->paciente_id = $paciente->id;
      $sintoma->data_inicio_sintoma = $request->input('data_inicio_sintoma');
      $sintoma->sintoma_manifestado = $sintomas;
      $sintoma->febre_temperatura_maxima = $request->input('febre_temperatura_maxima');
      $sintoma->data_medicao_temperatura = $request->input('data_medicao_temperatura');
      $sintoma->temperatura_atual = $request->input('temperatura_atual');
      $sintoma->cansaco_saturacao = $request->input('cansaco_saturacao');
      $sintoma->cansaco_frequencia_respiratoria = $request->input('cansaco_frequencia_respiratoria');
      try {
        $sintoma->save();
      } catch(\Exception $exception) {
        echo 'sintoma response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }*/

      $ajudas = $request->input('ajuda_tipo');
      $old_ajudas = json_decode($ajuda->tipo);
      $new_ajudas = [];
      $ajuda->paciente_id = $paciente->id;

      for($a = 0; $a < count($ajudas); $a++){
        if($ajudas[$a] !== null){
          array_push($new_ajudas, $ajuda->tipo = $ajudas[$a]);
        }
      }
      $current_ajudas =  array_values(array_diff(array_merge($old_ajudas, $new_ajudas),array_intersect($old_ajudas, $new_ajudas)));
      if(!$current_ajudas){
        $ajuda->tipo = $old_ajudas;
      } else {
        $ajuda->tipo = $new_ajudas;
      }
      try {
        $ajuda->save();
      } catch(\Exception $exception) {
        echo 'ajuda response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      /*for($a = 0; $a < count($ajudas); $a++){
        if($ajudas[$a] !== null){
          $ajuda->paciente_id = $paciente->id;
          $ajuda->tipo = $ajudas[$a];
          try {
            $ajuda->save();
          } catch(\Exception $exception) {
            echo 'ajuda response:';
            return response()->json(['message' => $exception->getMessage()], 500);
          }
        }
      }*/

      //$emocionais = $request->input('estado_emocional');
      $emocional->paciente_id = $paciente->id;
      $emocional->situacao = $request->input('estado_emocional');
      $emocional->medo = $request->input('medo');
      try {
        $emocional->save();
      } catch(\Exception $exception) {
        echo 'emocional response:';
        return response()->json(['message' => $exception->getMessage()], 500);
      }

      $observacoes = $request->input('observacoes');

      if($observacoes){
        $observacao->paciente_id = $paciente->id;
        $observacao->comentarios = $observacoes;
        try {
          $observacao->save();
        } catch(\Exception $exception) {
          echo 'observacao response:';
          return response()->json(['message' => $exception->getMessage()], 500);
        }
      }

      //return response()->json(['message' => 'Cadastro feito com sucesso.'], 200);
      return view('pages.paciente.create')->with(['success' => 'Cadastro feito com sucesso.']);
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
