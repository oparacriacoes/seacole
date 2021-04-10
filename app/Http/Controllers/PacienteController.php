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
use App\Http\Requests\PacienteStoreRequest;
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

    public function create()
    {
        $paciente = new Paciente();
        $agentes = Agente::get();
        $medicos = Medico::get();
        $psicologos = Psicologo::all();
        $articuladoras = Articuladora::all();

        return view('pages.paciente.create')->with(compact('paciente', 'agentes', 'medicos', 'psicologos', 'articuladoras'));
    }

    public function store(PacienteStoreRequest $request)
    {
        $dataForm = $request->validated();

        return $dataForm;
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

    public function edit(Paciente $paciente)
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

    public function update(Request $request, Paciente $paciente)
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
        $sintoma = Sintoma::where('paciente_id', $id)->first();
        if ($sintoma) {
            $delete_sintoma = Sintoma::destroy($sintoma->id);
        }

        $ajuda_tipo = AjudaTipo::where('paciente_id', $paciente->id)->first();
        if ($ajuda_tipo) {
            $delete_ajuda_tipo = AjudaTipo::destroy($ajuda_tipo->id);
        }

        $delete_paciente = Paciente::destroy($paciente->id);
        $delete_user = User::destroy($user->id);

        return redirect()->back()->with('success', 'Paciente excluído com sucesso.');
    }

    public function ExportarExcelPacientes()
    {
        $date = Carbon::now();

        return Excel::download(new PacientesExport(), 'pacientes_' . $date->format('d-m-Y-h:m') . '.xlsx');
    }
}
