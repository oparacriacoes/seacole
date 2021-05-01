<?php

namespace App\Http\Controllers;

use App\AjudaTipo;
use App\DoencaCronica;
use App\EstadoEmocional;
use App\Events\SintomaEvolucao;
use App\Exports\PacientesExport;
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
use App\QuadroAtual;
use App\Monitoramento;
use App\SaudeMental;
use App\ServicoInternacao;
use App\InsumosOferecido;
use Hash;

class PacienteController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'agente') {
            $pacientes = Auth::user()->agente->pacientes->sortBy('situacao');
        } elseif (Auth::user()->role === 'medico') {
            $pacientes = Paciente::orderBy('situacao')->get();
        } elseif (Auth::user()->role === 'psicologo') {
            $pacientes = Auth::user()->psicologo->pacientes->sortBy('situacao');
        } else {
            $pacientes = Paciente::orderBy('situacao')->get();
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
        $user->password = $dataForm['email'];
        $user->role = "paciente";
        try {
            $user->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro na criação de usuário. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }

        if ($user) {
            $paciente = new Paciente;
            $paciente->user_id = $user->id;
            if ($dataForm['data_nascimento'] !== null) {
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
            $paciente->identidade_genero = $dataForm['identidade_genero'];
            $paciente->orientacao_sexual = $dataForm['orientacao_sexual'];
            $paciente->descreve_doencas = $dataForm['descreve_doencas'];
            $paciente->trimestre_gestacao = $dataForm['trimestre_gestacao'];
            $paciente->motivo_risco_gravidez = $dataForm['motivo_risco_gravidez'];
            if ($dataForm['agente'] !== 'null') {
                $paciente->agente_id = $dataForm['agente'];
            }
            if ($dataForm['medico'] !== 'null') {
                $paciente->medico_id = $dataForm['medico'];
            }
            if ($dataForm['psicologo_id'] !== 'null') {
                $paciente->psicologo_id = $dataForm['psicologo_id'];
            }
            if ($dataForm['articuladora_responsavel'] !== 'null') {
                $paciente->articuladora_responsavel = $dataForm['articuladora_responsavel'];
            }
            if ($dataForm['name_social'] !== 'null') {
                $paciente->name_social = $dataForm['name_social'];
            }
            if (isset($dataForm['acompanhamento_medico'])) {
                $paciente->acompanhamento_medico = $dataForm['acompanhamento_medico'];
            }
            if (isset($dataForm['auxilio_emergencial'])) {
                $paciente->auxilio_emergencial = $dataForm['auxilio_emergencial'];
            }
            if (isset($dataForm['tuberculose'])) {
                $paciente->tuberculose = $dataForm['tuberculose'];
            }
            if (isset($dataForm['tabagista'])) {
                $paciente->tuberculose = $dataForm['tabagista'];
            }
            if (isset($dataForm['cronico_alcool'])) {
                $paciente->cronico_alcool = $dataForm['cronico_alcool'];
            }
            if (isset($dataForm['outras_drogas'])) {
                $paciente->outras_drogas = $dataForm['outras_drogas'];
            }
            if (isset($dataForm['gestante'])) {
                $paciente->gestante = $dataForm['gestante'];
            }
            if (isset($dataForm['amamenta'])) {
                $paciente->amamenta = $dataForm['amamenta'];
            }
            if (isset($dataForm['gestacao_alto_risco'])) {
                $paciente->gestacao_alto_risco = $dataForm['gestacao_alto_risco'];
            }
            if (isset($dataForm['pos_parto'])) {
                $paciente->pos_parto = $dataForm['pos_parto'];
            }
            if (isset($dataForm['acompanhamento_ubs'])) {
                $paciente->acompanhamento_ubs = $dataForm['acompanhamento_ubs'];
            }

            if ($dataForm['data_teste_confirmatorio'] !== null) {
                $paciente->data_teste_confirmatorio = Carbon::createFromFormat('d/m/Y', $dataForm['data_teste_confirmatorio'])->format('Y-m-d');
            }
            if (isset($dataForm['teste_utilizado'])) {
                $paciente->teste_utilizado = json_encode($dataForm['teste_utilizado']);
            }
            if (isset($dataForm['sistema_saude'])) {
                $paciente->sistema_saude = json_encode($dataForm['sistema_saude']);
            }
            if (isset($dataForm['doenca_cronica'])) {
                $paciente->doenca_cronica = json_encode($dataForm['doenca_cronica']);
            }
            if (isset($dataForm['resultado_teste'])) {
                $paciente->resultado_teste = $dataForm['resultado_teste'];
            }
            if (isset($dataForm['sintomas_iniciais'])) {
                $paciente->sintomas_iniciais = $dataForm['sintomas_iniciais'];
            }
            if ($dataForm['data_inicio_monitoramento'] !== null) {
                $paciente->data_inicio_sintoma = Carbon::createFromFormat('d/m/Y', $dataForm['data_inicio_monitoramento'])->format('Y-m-d');
            }
            if ($dataForm['data_finalizacao_caso'] !== null) {
                $paciente->data_finalizacao_caso = Carbon::createFromFormat('d/m/Y', $dataForm['data_finalizacao_caso'])->format('Y-m-d');
            }
            if ($dataForm['data_parto'] !== null) {
                $paciente->data_parto = Carbon::createFromFormat('d/m/Y', $dataForm['data_parto'])->format('Y-m-d');
            }
            if ($dataForm['data_ultima_mestrucao'] !== null) {
                $paciente->data_ultima_mestrucao = Carbon::createFromFormat('d/m/Y', $dataForm['data_ultima_mestrucao'])->format('Y-m-d');
            }
            if ($dataForm['data_ultima_consulta'] !== null) {
                $paciente->data_ultima_consulta = Carbon::createFromFormat('d/m/Y', $dataForm['data_ultima_consulta'])->format('Y-m-d');
            }

            try {
                $paciente->save();
            } catch (\Exception $exception) {
                DB::rollBack();
                $retorna['success'] = false;
                $retorna['message'] = 'Erro na criação de paciente. Descrição do erro: ' . $exception->getMessage();
                echo json_encode($retorna);
                return;
            }
        }

        if (isset($dataForm['doenca_cronica'])) {
            $cronica = new DoencaCronica;
            $cronica->paciente_id = $paciente->id;
            $cronica->tipo = json_encode($dataForm['doenca_cronica']);
            try {
                $cronica->save();
            } catch (\Exception $exception) {
                DB::rollBack();
                $retorna['success'] = false;
                $retorna['message'] = 'Erro ao salvar doenças crônica. Descrição do erro: ' . $exception->getMessage();
                echo json_encode($retorna);
                return;
            }
        }


        $sintoma = new Sintoma;
        $sintoma->paciente_id = $paciente->id;
        if ($dataForm['data_inicio_sintoma'] !== null) {
            $sintoma->data_inicio_sintoma = Carbon::createFromFormat('d/m/Y', $dataForm['data_inicio_sintoma'])->format('Y-m-d');
        }

        try {
            $sintoma->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            $retorna['success'] = false;
            $retorna['message'] = 'Erro ao salvar sintomas. Descrição do erro: ' . $exception->getMessage();
            echo json_encode($retorna);
            return;
        }

        if (isset($dataForm['ajuda_tipo'])) {
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
            } catch (\Exception $exception) {
                DB::rollBack();
                $retorna['success'] = false;
                $retorna['message'] = 'Erro ao salvar ajudas. Descrição do erro: ' . $exception->getMessage();
                echo json_encode($retorna);
                return;
            }
        }

        if (isset($dataForm['estado_emocional'])) {
            $emocionais = $dataForm['estado_emocional'];
            $emocional = new EstadoEmocional;
            $emocional->paciente_id = $paciente->id;
            $emocional->situacao = $dataForm['estado_emocional'];
            $emocional->medo = $dataForm['medo'];
            try {
                $emocional->save();
            } catch (\Exception $exception) {
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

        if (isset($sintoma)) {
            event(new SintomaEvolucao(new EvolucaoSintoma(json_decode(json_encode($sintoma), true))));
        }

        DB::commit();
        $retorna['success'] = true;
        $retorna['message'] = 'Cadastro feito com sucesso.';
        echo json_encode($retorna);

        return redirect('admin/paciente');
    }

    public function add()
    {
        $paciente = new Paciente();
        $agentes = Agente::get();
        $medicos = Medico::get();
        $psicologos = Psicologo::all();
        $articuladoras = Articuladora::all();

        return view('pages.paciente.create')->with(compact('paciente', 'agentes', 'medicos', 'psicologos', 'articuladoras'));
    }

    public function storeGeral(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->name),
                'role' => 'paciente',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
        }

        $dados = [
            'user_id' => $user->id,
            'agente_id' => $request->agente,
            'medico_id' => $request->medico,
            'articuladora_responsavel' => $request->articuladora_responsavel,
            'saude_mental' => $request->saude_mental,
            'acompanhamento_psicologico' => $request->acompanhamento_psicologico ? serialize($request->acompanhamento_psicologico) : null,
            'atendimento_semanal_psicologia' => $request->atendimento_semanal_psicologia,
            'horario_at_psicologia' => $request->horario_at_psicologia,
            'como_chegou_ao_projeto' => $request->como_chegou_ao_projeto,
            'como_chegou_ao_projeto_outro' => $request->como_chegou_ao_projeto_outro,
            'nucleo_uneafro_qual' => $request->nucleo_uneafro_qual,
            'psicologo_id' => $request->psicologo_id,
            'situacao' => $request->situacao,
            'data_nascimento' => $request->data_nascimento,
            'cor_raca' => $request->cor_raca,
            'endereco_cep' => $request->endereco_cep,
            'endereco_rua' => $request->endereco_rua,
            'endereco_numero' => $request->endereco_numero,
            'endereco_bairro' => $request->endereco_bairro,
            'endereco_cidade' => $request->endereco_cidade,
            'endereco_uf' => $request->endereco_uf,
            'ponto_referencia' => $request->ponto_referencia,
            'endereco_complemento' => $request->endereco_complemento,
            'fone_fixo' => $request->fone_fixo,
            'fone_celular' => $request->fone_celular,
            'numero_pessoas_residencia' => $request->numero_pessoas_residencia,
            'responsavel_residencia' => $request->responsavel_residencia,
            'renda_residencia' => $request->renda_residencia,
            'doenca_cronica' => $request->doenca_cronica ? serialize($request->doenca_cronica) : null,
            'remedios_consumidos' => $request->remedios_consumidos,
            'acompanhamento_medico' => $request->acompanhamento_medico,
            'teste_utilizado' => $request->teste_utilizado ? serialize($request->teste_utilizado) : null,
            'resultado_teste' => $request->resultado_teste ? serialize($request->resultado_teste) : null,
            'data_teste_confirmatorio' => $request->data_teste_confirmatorio,
            'sintomas_iniciais' => $request->sintomas_iniciais,
            'data_inicio_sintoma' => $request->data_inicio_sintoma,
            'data_inicio_monitoramento' => $request->data_inicio_monitoramento,
            'data_finalizacao_caso' => $request->data_finalizacao_caso,
            'data_inicio_ac_psicologico' => $request->data_inicio_ac_psicologico,
            'data_encerramento_ac_psicologico' => $request->data_encerramento_ac_psicologico,
            'name_social' => $request->name_social,
            'identidade_genero' => $request->identidade_genero,
            'orientacao_sexual' => $request->orientacao_sexual,
            'auxilio_emergencial' => $request->auxilio_emergencial,
            'descreve_doencas' => $request->descreve_doencas,
            'tuberculose' => $request->tuberculose,
            'tabagista' => $request->tabagista,
            'cronico_alcool' => $request->cronico_alcool,
            'outras_drogas' => $request->outras_drogas,
            'gestante' => $request->gestante,
            'amamenta' => $request->amamenta,
            'gestacao_alto_risco' => $request->gestacao_alto_risco,
            'pos_parto' => $request->pos_parto,
            'data_parto' => $request->data_parto,
            'data_ultima_mestrucao' => $request->data_ultima_mestrucao,
            'trimestre_gestacao' => $request->trimestre_gestacao,
            'motivo_risco_gravidez' => $request->motivo_risco_gravidez,
            'data_ultima_consulta' => $request->data_ultima_consulta,
            'sistema_saude' => $request->sistema_saude ? serialize($request->sistema_saude) : null,
            'acompanhamento_ubs' => $request->acompanhamento_ubs,
            'outras_informacao' => $request->outras_informacao,
        ];

        DB::beginTransaction();
        try {
            $paciente = Paciente::create($dados);
            DB::commit();
            return redirect()->route('paciente/edit', $paciente->id)->with('success', 'Dados salvos com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect()->back()->withInput()->with('error', 'Não foi possível realizar esta operação.');
            //return redirect()->back()->with('error', 'Não foi possível realizar esta operação.');
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

    public function edit($id)
    {
        $paciente = Paciente::find($id);
        $sintomas = $paciente->sintomas;
        $ajudas = $paciente->tipos_ajuda;
        $emocional = $paciente->estado_emocional;
        $observacao = $paciente->observacao;
        $cronicas = unserialize($paciente->doenca_cronica);
        $sistema_saude = unserialize($paciente->sistema_saude);

        $teste_utilizado = @unserialize($paciente->teste_utilizado);
        if ($teste_utilizado === false) {
            $teste_utilizado = $paciente->teste_utilizado;
        }

        $items = $paciente->items;
        $quadro = QuadroAtual::where('paciente_id', $id)->first();
        if ($quadro) {
            $sintomas_quadro = unserialize($quadro->sintomas_manifestados);
            $sequelas = unserialize($quadro->sequelas);
        } else {
            $quadro = new QuadroAtual();
            $sintomas_quadro = [];
            $sequelas = [];
        }
        $agentes = Agente::get();
        $medicos = Medico::get();
        $psicologos = Psicologo::all();
        $dados = $paciente->dados;
        $articuladoras = Articuladora::all();
        $monitoramento = Monitoramento::where('paciente_id', $paciente->id)->first();
        if ($monitoramento) {
            $monitoramento_sintomas = unserialize($monitoramento->sintomas_atuais);
        } else {
            $monitoramento_sintomas = [];
            $monitoramento = new Monitoramento();
        }

        $saude_mental = SaudeMental::where('paciente_id', $paciente->id)->first();

        $internacao = ServicoInternacao::where('paciente_id', $paciente->id)->first();
        if ($internacao) {
            $internacao_servico = unserialize($internacao->precisou_servico);
            $internacao_remedio = unserialize($internacao->recebeu_med_covid);
            $internacao_problema = unserialize($internacao->teve_algum_problema);
            $internacao_local = unserialize($internacao->local_internacao);
        } else {
            $internacao = new ServicoInternacao();
            $internacao_servico = [];
            $internacao_remedio = [];
            $internacao_problema = [];
            $internacao_local = [];
        }



        $insumos = $paciente->insumos_oferecidos()->first() ?? new InsumosOferecido();
        if ($insumos) {
            $insumos_ajuda = @unserialize($insumos->precisa_tipo_ajuda);
            $insumos_tratamento = @unserialize($insumos->tratamento_financiado);
            $insumos_materiais = @unserialize($insumos->material_entregue);
        } else {
            $insumos_ajuda = [];
            $insumos_tratamento = array();
            $insumos_materiais = [];
        }

        $prontuarios = EvolucaoSintoma::where('paciente_id', $id)->orderBy('data_monitoramento')->get();

        $acompanhamento_psicologico = unserialize($paciente->acompanhamento_psicologico);

        $resultado_teste = @unserialize($paciente->resultado_teste);
        if ($resultado_teste === false) {
            $resultado_teste = $paciente->resultado_teste;
        }

        return view('pages.paciente.edit')->with(compact('paciente', 'quadro', 'sintomas_quadro', 'ajudas', 'emocional', 'observacao', 'cronicas', 'items', 'agentes', 'medicos', 'psicologos', 'dados', 'articuladoras', 'sistema_saude', 'teste_utilizado', 'monitoramento', 'monitoramento_sintomas', 'saude_mental', 'internacao', 'internacao_servico', 'internacao_remedio', 'internacao_problema', 'internacao_local', 'insumos', 'insumos_ajuda', 'insumos_tratamento', 'prontuarios', 'acompanhamento_psicologico', 'resultado_teste', 'insumos_materiais', 'sequelas'));
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        $dados = [
            'user_id' => $paciente->user_id,
            'agente_id' => $request->agente,
            'medico_id' => $request->medico,
            'articuladora_responsavel' => $request->articuladora_responsavel,
            'saude_mental' => $request->saude_mental,
            'acompanhamento_psicologico' => $request->acompanhamento_psicologico ? serialize($request->acompanhamento_psicologico) : null,
            'atendimento_semanal_psicologia' => $request->atendimento_semanal_psicologia,
            'horario_at_psicologia' => $request->horario_at_psicologia,
            'como_chegou_ao_projeto' => $request->como_chegou_ao_projeto,
            'como_chegou_ao_projeto_outro' => $request->como_chegou_ao_projeto_outro,
            'nucleo_uneafro_qual' => $request->nucleo_uneafro_qual,
            'psicologo_id' => $request->psicologo_id,
            'situacao' => $request->situacao,
            'data_nascimento' => $request->data_nascimento,
            'cor_raca' => $request->cor_raca,
            'endereco_cep' => $request->endereco_cep,
            'endereco_rua' => $request->endereco_rua,
            'endereco_numero' => $request->endereco_numero,
            'endereco_bairro' => $request->endereco_bairro,
            'endereco_cidade' => $request->endereco_cidade,
            'endereco_uf' => $request->endereco_uf,
            'ponto_referencia' => $request->ponto_referencia,
            'endereco_complemento' => $request->endereco_complemento,
            'fone_fixo' => $request->fone_fixo,
            'fone_celular' => $request->fone_celular,
            'numero_pessoas_residencia' => $request->numero_pessoas_residencia,
            'responsavel_residencia' => $request->responsavel_residencia,
            'renda_residencia' => $request->renda_residencia,
            'doenca_cronica' => $request->doenca_cronica ? serialize($request->doenca_cronica) : null,
            'remedios_consumidos' => $request->remedios_consumidos,
            'acompanhamento_medico' => $request->acompanhamento_medico,
            'isolamento_residencial' => $request->isolamento_residencial,
            'alimentacao_disponivel' => $request->alimentacao_disponivel,
            'auxilio_terceiros' => $request->auxilio_terceiros,
            'tarefas_autocuidado' => $request->tarefas_autocuidado,
            'teste_utilizado' => $request->teste_utilizado ? serialize($request->teste_utilizado) : null,
            'resultado_teste' => $request->resultado_teste ? serialize($request->resultado_teste) : null,
            'data_teste_confirmatorio' => $request->data_teste_confirmatorio,
            'sintomas_iniciais' => $request->sintomas_iniciais,
            'data_inicio_sintoma' => $request->data_inicio_sintoma,
            'data_inicio_monitoramento' => $request->data_inicio_monitoramento,
            'data_finalizacao_caso' => $request->data_finalizacao_caso,
            'data_inicio_ac_psicologico' => $request->data_inicio_ac_psicologico,
            'data_encerramento_ac_psicologico' => $request->data_encerramento_ac_psicologico,
            'name_social' => $request->name_social,
            'identidade_genero' => $request->identidade_genero,
            'orientacao_sexual' => $request->orientacao_sexual,
            'auxilio_emergencial' => $request->auxilio_emergencial,
            'descreve_doencas' => $request->descreve_doencas,
            'tuberculose' => $request->tuberculose,
            'tabagista' => $request->tabagista,
            'cronico_alcool' => $request->cronico_alcool,
            'outras_drogas' => $request->outras_drogas,
            'gestante' => $request->gestante,
            'amamenta' => $request->amamenta,
            'gestacao_alto_risco' => $request->gestacao_alto_risco,
            'pos_parto' => $request->pos_parto,
            'data_parto' => $request->data_parto,
            'data_ultima_mestrucao' => $request->data_ultima_mestrucao,
            'trimestre_gestacao' => $request->trimestre_gestacao,
            'motivo_risco_gravidez' => $request->motivo_risco_gravidez,
            'data_ultima_consulta' => $request->data_ultima_consulta,
            'sistema_saude' => $request->sistema_saude ? serialize($request->sistema_saude) : null,
            'acompanhamento_ubs' => $request->acompanhamento_ubs,
            'outras_informacao' => $request->outras_informacao,
        ];

        DB::beginTransaction();
        try {
            DB::commit();
            $paciente->update($dados);
            return redirect()->back()->with('success', 'Dados atualizados com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return redirect()->back()->with('error', 'Não foi possível realizar a operação.');
        }
    }

    public function ExportarExcelPacientes()
    {
        $date = Carbon::now();

        return Excel::download(new PacientesExport(), 'pacientes_' . $date->format('d-m-Y-h:m') . '.xlsx');
    }
}
