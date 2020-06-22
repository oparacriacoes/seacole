<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Paciente;
use App\Sintoma;
use App\AjudaTipo;
use App\EstadoEmocional;
use App\Observacao;
use App\DoencaCronica;
use App\Events\SintomaEvolucao;
use App\EvolucaoSintoma;
use Illuminate\Support\Facades\DB;

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
      DB::beginTransaction();
      $user = new User;
      $user->name = $request->input('data')['name'];
      $user->email = $request->input('data')['email'];
      $user->password = $request->input('data')['email'];
      $user->role = "paciente";
      try {
        $user->save();
      } catch(\Exception $exception) {
        DB::rollBack();
        $retorna['success'] = false;
        $retorna['message'] = 'Erro na criação de usuário. Descrição do erro: ' . $exception->getMessage();
        echo json_encode($retorna);
        return;
      }

      if($user){
        $paciente = new Paciente;
        $paciente->user_id = $user->id;
        if($request->input('data')['data_nascimento'] !== null){
          $paciente->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_nascimento'])->format('Y-m-d');
        }
        $paciente->cor_raca = $request->input('data')['cor_raca'];
        $paciente->endereco_cep = $request->input('data')['endereco_cep'];
        $paciente->endereco_rua = $request->input('data')['endereco_rua'];
        $paciente->endereco_numero = $request->input('data')['endereco_numero'];
        $paciente->endereco_bairro = $request->input('data')['endereco_bairro'];
        $paciente->endereco_cidade = $request->input('data')['endereco_cidade'];
        $paciente->endereco_uf = $request->input('data')['endereco_uf'];
        $paciente->ponto_referencia = $request->input('data')['ponto_referencia'];
        $paciente->endereco_complemento = $request->input('data')['endereco_complemento'];
        $paciente->fone_fixo = $request->input('data')['fone_fixo'];
        $paciente->fone_celular = $request->input('data')['fone_celular'];
        $paciente->numero_pessoas_residencia = $request->input('data')['numero_pessoas_residencia'];
        $paciente->responsavel_residencia = $request->input('data')['responsavel_residencia'];
        $paciente->renda_residencia = $request->input('data')['renda_residencia'];
        $paciente->outras_doencas = $request->input('data')['outras_doencas'];
        $paciente->remedios_consumidos = $request->input('data')['remedios_consumidos'];
        if($request->input('data')['agente'] !== 'null'){
          $paciente->agente_id = $request->input('data')['agente'];
        }
        if($request->input('data')['medico'] !== 'null'){
          $paciente->medico_id = $request->input('data')['medico'];
        }
        if( $request->input('data')['psicologo_id'] !== 'null' ){
          $paciente->psicologo_id = $request->input('data')['psicologo_id'];
        }
        if(isset($request->input('data')['acompanhamento_medico'])){
          $paciente->acompanhamento_medico = $request->input('data')['acompanhamento_medico'];
        }
        if(isset($request->input('data')['isolamento_residencial'])){
          $paciente->isolamento_residencial = $request->input('data')['isolamento_residencial'];
        }
        if(isset($request->input('data')['alimentacao_disponivel'])){
          $paciente->alimentacao_disponivel = $request->input('data')['alimentacao_disponivel'];
        }
        if(isset($request->input('data')['auxilio_terceiros'])){
          $paciente->auxilio_terceiros = $request->input('data')['auxilio_terceiros'];
        }
        if(isset($request->input('data')['tarefas_autocuidado'])){
          $paciente->tarefas_autocuidado = $request->input('data')['tarefas_autocuidado'];
        }
        try {
          $paciente->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro na criação de paciente. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }

      if(isset($request->input('data')['doenca_cronica'])){
        $cronica = new DoencaCronica;
        $cronica->paciente_id = $paciente->id;
        $cronica->tipo = json_encode($request->input('data')['doenca_cronica']);
        try {
          $cronica->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar doenças crônica. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }

      if(isset($request->input('data')['sintomas'])){
        $sintomas = json_encode($request->input('data')['sintomas']);
        $sintoma = new Sintoma;
        $sintoma->paciente_id = $paciente->id;
        if($request->input('data')['data_inicio_sintoma'] !== null){
          $sintomas->data_inicio_sintoma = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_inicio_sintoma'])->format('Y-m-d');
        }
        $sintoma->horario_sintoma = $request->input('data')['horario_sintoma'];
        $sintoma->sintoma_manifestado = $sintomas;
        $sintoma->febre_temperatura_maxima = $request->input('data')['febre_temperatura_maxima'];
        if($request->input('data')['data_medicao_temperatura'] !== null){
          $sintomas->data_medicao_temperatura = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_medicao_temperatura'])->format('Y-m-d');
        }
        $sintoma->temperatura_atual = $request->input('data')['temperatura_atual'];
        $sintoma->cansaco_saturacao = $request->input('data')['cansaco_saturacao'];
        $sintoma->cansaco_frequencia_respiratoria = $request->input('data')['cansaco_frequencia_respiratoria'];
        $sintoma->pressao_arterial = $request->input('data')['cansaco_pressao_arterial'];
        try {
          $sintoma->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar sintomas. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }

      if(isset($request->input('data')['ajuda_tipo'])){
        $ajuda = new AjudaTipo;
        $ajuda->paciente_id = $paciente->id;
        $ajuda->tipo = json_encode($request->input('data')['ajuda_tipo']);
        try {
          $ajuda->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar ajudas. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }
//
//      $ajudas = $request->input('data')['ajuda_tipo'];
//      for($a = 0; $a < count($ajudas); $a++){
//        if($ajudas[$a] !== null){
//          $ajuda = new AjudaTipo;
//          $ajuda->paciente_id = $paciente->id;
//          $ajuda->tipo = $ajudas[$a];
//          try {
//            $ajuda->save();
//          } catch(\Exception $exception) {
//            DB::rollBack();
//            $retorna['success'] = false;
//            $retorna['message'] = $exception->getMessage();
//            echo json_encode($retorna);
//            return;
//          }
//        }
//      }

      if(isset($request->input('data')['estado_emocional'])){
        $emocionais = $request->input('data')['estado_emocional'];
        $emocional = new EstadoEmocional;
        $emocional->paciente_id = $paciente->id;
        $emocional->situacao = $request->input('data')['estado_emocional'];
        $emocional->medo = $request->input('data')['medo'];
        try {
          $emocional->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar estados emocional. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }

      $observacoes = $request->input('data')['observacoes'];
      if($observacoes){
        $observacao = new Observacao;
        $observacao->paciente_id = $paciente->id;
        $observacao->comentarios = $observacoes;
        try {
          $observacao->save();
        } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar observações. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
        }
      }

      if( isset($sintoma) ) {
        event(new SintomaEvolucao(new EvolucaoSintoma(json_decode(json_encode($sintoma), true))));
      }

      DB::commit();
        $retorna['success'] = true;
        $retorna['message'] = 'Cadastro feito com sucesso.';
        echo json_encode($retorna);
        return;
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
      DB::beginTransaction();
      $paciente = Paciente::find($id);
      $user = $paciente->user;

      $cronica_search = $paciente->doencas_cronicas;
      $cronicas = DoencaCronica::find($cronica_search[0]->id);

      $sintomas_search = $paciente->sintomas;
      if(!$sintomas_search->isEmpty()){
        $sintomas = Sintoma::find($sintomas_search[0]->id);
      }

      $ajudas_search = $paciente->tipos_ajuda;
      if(!$ajudas_search->isEmpty()){
        $ajuda = AjudaTipo::find($ajudas_search[0]->id);
      }

      $emocionais_search = $paciente->estado_emocional;
      if($emocionais_search != null){
        $emocional = EstadoEmocional::find($emocionais_search->id);
      }

      $observacao_search = $paciente->observacao;
      $observacao_search ? $observacao = Observacao::find($paciente->observacao->id) : $observacao = new Observacao;

      $user->name = $request->input('data')['name'];
      $user->email = $request->input('data')['email'];
      $user->role = "paciente";
      try {
        $user->save();
      } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar usuário. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
      }

      if($user){
        $paciente->user_id = $user->id;
        if($request->input('data')['data_nascimento'] !== null){
          $paciente->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_nascimento'])->format('Y-m-d');
        }
        $paciente->cor_raca = $request->input('data')['cor_raca'];
        $paciente->endereco_cep = $request->input('data')['endereco_cep'];
        $paciente->endereco_rua = $request->input('data')['endereco_rua'];
        $paciente->endereco_numero = $request->input('data')['endereco_numero'];
        $paciente->endereco_bairro = $request->input('data')['endereco_bairro'];
        $paciente->endereco_cidade = $request->input('data')['endereco_cidade'];
        $paciente->endereco_uf = $request->input('data')['endereco_uf'];
        $paciente->ponto_referencia = $request->input('data')['ponto_referencia'];
        $paciente->endereco_complemento = $request->input('data')['endereco_complemento'];
        $paciente->fone_fixo = $request->input('data')['fone_fixo'];
        $paciente->fone_celular = $request->input('data')['fone_celular'];
        $paciente->numero_pessoas_residencia = $request->input('data')['numero_pessoas_residencia'];
        $paciente->responsavel_residencia = $request->input('data')['responsavel_residencia'];
        $paciente->renda_residencia = $request->input('data')['renda_residencia'];
        $paciente->outras_doencas = $request->input('data')['outras_doencas'];
        $paciente->remedios_consumidos = $request->input('data')['remedios_consumidos'];
        if($request->input('data')['agente'] !== 'null'){
          $paciente->agente_id = $request->input('data')['agente'];
        }
        if($request->input('data')['medico'] !== 'null'){
          $paciente->medico_id = $request->input('data')['medico'];
        }
        if( $request->input('data')['psicologo_id'] !== 'null' ){
          $paciente->psicologo_id = $request->input('data')['psicologo_id'];
        } else {
          $paciente->psicologo_id = NULL;
        }
        if(isset($request->input('data')['acompanhamento_medico'])){
          $paciente->acompanhamento_medico = $request->input('data')['acompanhamento_medico'];
        }
        if(isset($request->input('data')['isolamento_residencial'])){
          $paciente->isolamento_residencial = $request->input('data')['isolamento_residencial'];
        }
        if(isset($request->input('data')['alimentacao_disponivel'])){
          $paciente->alimentacao_disponivel = $request->input('data')['alimentacao_disponivel'];
        }
        if(isset($request->input('data')['auxilio_terceiros'])){
          $paciente->auxilio_terceiros = $request->input('data')['auxilio_terceiros'];
        }
        if(isset($request->input('data')['tarefas_autocuidado'])){
          $paciente->tarefas_autocuidado = $request->input('data')['tarefas_autocuidado'];
        }
        try {
          $paciente->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar paciente. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
      }

      $input_cronicas = $paciente->doenca_cronica = $request->input('data')['doenca_cronica'];
      $old_cronicas = [];
      $new_cronicas = [];

      $cronicas_decode = (array) json_decode($cronicas->tipo);
      for($o = 0; $o < count($cronicas_decode); $o++){
        array_push($old_cronicas, $cronicas_decode[$o]);
      }
      if( count($request->input('data')['doenca_cronica']) > 1 ){
        for($i = 0; $i < count($input_cronicas); $i++){
          if($input_cronicas[$i] !== null){
            array_push($new_cronicas, $input_cronicas[$i]);
          }
        }
      } else {
        $new_cronicas = [null];
      }

      $current_cronicas =  array_values(array_diff(array_merge($old_cronicas, $new_cronicas),array_intersect($old_cronicas, $new_cronicas)));

      if(!$current_cronicas){
        $cronicas->tipo = json_encode($request->input('data')['doenca_cronica']);
      } else {
        $cronicas->tipo = $new_cronicas;
      }
      try {
        $cronicas->save();
      } catch(\Exception $exception) {
          DB::rollBack();
          $retorna['success'] = false;
          $retorna['message'] = 'Erro ao salvar doenças crônicas. Descrição do erro: ' . $exception->getMessage();
          echo json_encode($retorna);
          return;
      }

      if( array_key_exists('sintomas', $request->input('data')) ){
        $input_sintomas = $paciente->sintomas = $request->input('data')['sintomas'];
        $old_sintomas = [];
        $new_sintomas = [];

        if($sintomas_search->isEmpty()){
          $sintomas = new Sintoma;
        }

        $sintomas_decode = (array) json_decode($sintomas->sintoma_manifestado);

        for($o = 0; $o < count($sintomas_decode); $o++){
          array_push($old_sintomas, array_values($sintomas_decode)[$o]);
        }

        for($s = 0; $s < count($request->input('data')['sintomas']); $s++){
          if($input_sintomas[$s] !== null){
            array_push($new_sintomas, $input_sintomas[$s]);
          }
        }

        $current_sintomas =  array_values(array_diff(array_merge($old_sintomas, $new_sintomas),array_intersect($old_sintomas, $new_sintomas)));

        if(!$current_sintomas){
          $sintomas->sintoma_manifestado = json_encode($request->input('data')['sintomas']);
        } else {
          $sintomas->sintoma_manifestado = json_encode($new_sintomas);
        }
        $sintomas->paciente_id = $paciente->id;
        if($request->input('data')['data_inicio_sintoma'] !== null){
            $sintomas->data_inicio_sintoma = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_inicio_sintoma'])->format('Y-m-d');
        }
        $sintomas->horario_sintoma = $request->input('data')['horario_sintoma'];
        $sintomas->febre_temperatura_maxima = $request->input('data')['febre_temperatura_maxima'];
        if($request->input('data')['data_medicao_temperatura'] !== null){
          $sintomas->data_medicao_temperatura = Carbon::createFromFormat('d/m/Y', $request->input('data')['data_medicao_temperatura'])->format('Y-m-d');
        }
        $sintomas->temperatura_atual = $request->input('data')['temperatura_atual'];
        $sintomas->cansaco_saturacao = $request->input('data')['cansaco_saturacao'];
        $sintomas->cansaco_frequencia_respiratoria = $request->input('data')['cansaco_frequencia_respiratoria'];
        $sintomas->pressao_arterial = $request->input('data')['cansaco_pressao_arterial'];
        try {
          $sintomas->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar sintomas. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
      }

//      if($request->input('data')['ajuda_tipo'][0] != null){
        $ajudas = $request->input('data')['ajuda_tipo'];
        $ajuda = new AjudaTipo;
        if(!isset($ajuda)){
          $old_ajudas = [];
        } else { $old_ajudas = json_decode($ajuda->tipo); };

        $new_ajudas = [];
        $ajuda->paciente_id = $paciente->id;

        for($a = 0; $a < count($ajudas); $a++){
          if($ajudas[$a] !== null){
            array_push($new_ajudas, $ajuda->tipo = $ajudas[$a]);
          }
        }
        if (empty($old_ajudas)) {$old_ajudas = [];}
        if (empty($new_ajudas)) {$new_ajudas = [];}

//        $current_ajudas =  array_values(array_diff(array_merge($old_ajudas, $new_ajudas),array_intersect($old_ajudas, $new_ajudas)));
//        if(!$current_ajudas){
//          $ajuda->tipo = json_encode($old_ajudas);
//        } else {
//          $ajuda->tipo = json_encode($new_ajudas);
//        }
        $ajuda->tipo = json_encode($request->input('data')['ajuda_tipo']);
//        $ajuda->tipo = json_encode($new_ajudas);
        try {
          $ajuda->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar ajuda. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
//      }

      if(array_key_exists('estado_emocional', $request->input('data'))) {
        if(!isset($emocional)){ $emocional = new EstadoEmocional; };
        $emocional->paciente_id = $paciente->id;
        $emocional->situacao = $request->input('data')['estado_emocional'];
        $emocional->medo = $request->input('data')['medo'];
        try {
          $emocional->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar estado emocional. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
      } elseif(!array_key_exists('estado_emocional', $request->input('data'))) {
        if(!isset($emocional)){ $emocional = new EstadoEmocional; };
        $emocional->paciente_id = $paciente->id;
        $emocional->situacao = null;
        $emocional->medo = $request->input('data')['medo'];
        try {
          $emocional->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar estado emocional. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
      }

      $observacoes = $request->input('data')['observacoes'];
      if($observacoes){
        $observacao->paciente_id = $paciente->id;
        $observacao->comentarios = $observacoes;
        try {
          $observacao->save();
        } catch(\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar observação. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }
      }

      if( isset($sintomas) ) {
        event(new SintomaEvolucao(new EvolucaoSintoma(json_decode(json_encode($sintomas), true))));
      }


        DB::commit();
        $retorna['success'] = true;
        $retorna['message'] = 'Cadastro atualizado com sucesso.';
        echo json_encode($retorna);
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $paciente = Paciente::find($id);
      $user = User::find($paciente->user_id);

      $delete_paciente = Paciente::destroy($id);
      $delete_user = User::destroy($user->id);

      return response()->json(['message' => 'Paciente removido com sucesso']);
    }
}
