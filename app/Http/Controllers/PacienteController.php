<?php

namespace App\Http\Controllers;

use App\AjudaTipo;
use App\DoencaCronica;
use App\EstadoEmocional;
use App\Events\SintomaEvolucao;
use App\Exports\PacientesExport;
use App\Observacao;
use App\Sintoma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Paciente;
use App\Agente;
use App\Medico;
use App\Psicologo;
use App\EvolucaoSintoma;
use App\User;
use App\Articuladora;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
  public function index()
  {
    if( Auth::user()->role === 'agente' ){
      $pacientes = Auth::user()->agente->pacientes;
    } elseif( Auth::user()->role === 'medico' ) {
      $pacientes = Paciente::get();
    } elseif( Auth::user()->role === 'psicologo' ) {
      $pacientes = Auth::user()->psicologo->pacientes;
    } else {
      $pacientes = Paciente::get();
    }

    return view('pages.paciente.index')->with(compact('pacientes'));
  }

  public function store(Request $request)
  {
    $dataForm = $request->all();
    DB::beginTransaction();
    $user = new User;
    $user->name = $dataForm['name'];
    $user->email = $dataForm['email'];
    $user->password =$dataForm['email'];
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
      if($dataForm['data_nascimento'] !== null){
        $paciente->data_nascimento = Carbon::createFromFormat('d/m/Y', $dataForm['data_nascimento'])->format('Y-m-d');
      }
      $paciente->situacao = $dataForm['situacao'];
      $paciente->cor_raca = $dataForm['cor_raca'];
      $paciente->endereco_cep = $dataForm['endereco_cep'];
      $paciente->endereco_rua = $dataForm['endereco_rua'];
      $paciente->endereco_numero = $dataForm['endereco_numero'];
      $paciente->endereco_bairro = $dataForm['endereco_bairro'];
      $paciente->endereco_cidade = $dataForm['endereco_cidade'];
      $paciente->endereco_uf = $dataForm['endereco_uf'];
      $paciente->ponto_referencia = $dataForm['ponto_referencia'];
      $paciente->endereco_complemento = $dataForm['endereco_complemento'];
      $paciente->fone_fixo = $dataForm['fone_fixo'];
      $paciente->fone_celular = $dataForm['fone_celular'];
      $paciente->numero_pessoas_residencia = $dataForm['numero_pessoas_residencia'];
      $paciente->responsavel_residencia = $dataForm['responsavel_residencia'];
      $paciente->renda_residencia = $dataForm['renda_residencia'];
      $paciente->outras_informacao = $dataForm['outras_informacao'];
      $paciente->remedios_consumidos = $dataForm['remedios_consumidos'];
      if($dataForm['agente'] !== 'null'){
        $paciente->agente_id = $dataForm['agente'];
      }
      if($dataForm['medico'] !== 'null'){
        $paciente->medico_id = $dataForm['medico'];
      }
      if( $dataForm['psicologo_id'] !== 'null' ){
        $paciente->psicologo_id = $dataForm['psicologo_id'];
      }
      if(isset($dataForm['acompanhamento_medico'])){
        $paciente->acompanhamento_medico = $dataForm['acompanhamento_medico'];
      }
    
      if($dataForm['data_teste_confirmatorio'] !== null){
        $paciente->data_teste_confirmatorio = Carbon::createFromFormat('d/m/Y', $dataForm['data_teste_confirmatorio'])->format('Y-m-d');
      }
      if(isset($dataForm['teste_utilizado'])){
        $paciente->teste_utilizado = $dataForm['teste_utilizado'];
      }
      if(isset($dataForm['sintomas_iniciais'])){
        $paciente->sintomas_iniciais = $dataForm['sintomas_iniciais'];
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

    if(isset($dataForm['doenca_cronica'])){
      $cronica = new DoencaCronica;
      $cronica->paciente_id = $paciente->id;
      $cronica->tipo = json_encode($dataForm['doenca_cronica']);
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

    if(isset($dataForm['sintomas'])){
      $sintomas = json_encode($dataForm['sintomas']);
      $sintoma = new Sintoma;
      $sintoma->paciente_id = $paciente->id;
      if($dataForm['data_inicio_sintoma'] !== null){
        $sintoma->data_inicio_sintoma = Carbon::createFromFormat('d/m/Y', $dataForm['data_inicio_sintoma'])->format('Y-m-d');
      }
      $sintoma->sintoma_manifestado = $sintomas;
     
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

    if(isset($dataForm['ajuda_tipo'])){
      $ajudatipo = $dataForm['ajuda_tipo'];
      if (sizeof($ajudatipo) > 0) {
        if (empty($ajudatipo[sizeof($ajudatipo) - 1])) {
            unset($ajudatipo[sizeof($ajudatipo) - 1]);
        }
      }
      $ajuda = new AjudaTipo;
      $ajuda->paciente_id = $paciente->id;
      $ajuda->tipo = json_encode($ajudatipo);
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

    if(isset($dataForm['estado_emocional'])){
      $emocionais = $dataForm['estado_emocional'];
      $emocional = new EstadoEmocional;
      $emocional->paciente_id = $paciente->id;
      $emocional->situacao = $dataForm['estado_emocional'];
      $emocional->medo = $dataForm['medo'];
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

    // $observacoes = $dataForm['observacoes'];
    // if($observacoes){
    //   $observacao = new Observacao;
    //   $observacao->paciente_id = $paciente->id;
    //   $observacao->comentarios = $observacoes;
    //   try {
    //     $observacao->save();
    //   } catch(\Exception $exception) {
    //     DB::rollBack();
    //     $retorna['success'] = false;
    //     $retorna['message'] = 'Erro ao salvar observações. Descrição do erro: ' . $exception->getMessage();
    //     echo json_encode($retorna);
    //     return;
    //   }
    // }

    if( isset($sintoma) ) {
      event(new SintomaEvolucao(new EvolucaoSintoma(json_decode(json_encode($sintoma), true))));
    }

    DB::commit();
      $retorna['success'] = true;
      $retorna['message'] = 'Cadastro feito com sucesso.';
      echo json_encode($retorna);
      // return $retorna;
  }

  public function add()
  {
    $agentes = Agente::get();
    $medicos = Medico::get();
    $psicologos = Psicologo::all();
    $articuladoras = Articuladora::all();

    return view('pages.paciente.create')->with(compact('agentes', 'medicos', 'psicologos', 'articuladoras'));
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

  public function edit($id)
  {
    $paciente = Paciente::find($id);
    $sintomas = $paciente->sintomas;
    $ajudas = $paciente->tipos_ajuda;
    $emocional = $paciente->estado_emocional;
    $observacao = $paciente->observacao;
    $cronicas = $paciente->doencas_cronicas;
    $items = $paciente->items;
    $agentes = Agente::get();
    $medicos = Medico::get();
    $psicologos = Psicologo::all();
    $dados = $paciente->dados;

    return view('pages.paciente.edit')->with(compact('paciente', 'sintomas', 'ajudas', 'emocional', 'observacao', 'cronicas', 'items', 'agentes', 'medicos', 'psicologos', 'dados'));
  }

  public function ExportarExcelPacientes()
  {
    return Excel::download(new PacientesExport(), 'pacientes.xlsx');
  }
}
