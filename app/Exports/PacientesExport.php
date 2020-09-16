<?php

namespace App\Exports;

use App\Paciente;
use App\Articuladora;
//use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

//class PacientesExport implements FromCollection
//class PacientesExport implements FromView
class PacientesExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
          'nome',
          'name_social',
          'identidade_genero',
          'orientacao_sexual',
          'agente',
          'medico',
          'articuladora',
          'atendimento_semanal_psicologia',
          'acompanhamento_psicologico',
          'horario_at_psicologia',
          'como_chegou_ao_projeto',
          'nucleo_uneafro_qual',
          'como_chegou_ao_projeto_outro',
          'psicologo',
          'situacao',
          'data_nascimento',
          'cor_raca',
          'endereco_cep',
          'endereco_rua',
          'endereco_numero',
          'endereco_bairro',
          'endereco_cidade',
          'endereco_uf',
          'ponto_referencia',
          'endereco_complemento',
          'fone_fixo',
          'fone_celular',
          'numero_pessoas_residencia',
          'responsavel_residencia',
          'renda_residencia',
          'doenca_cronica',
          'descreve_doencas',
          'remedios_consumidos',
          'acompanhamento_medico',
          'isolamento_residencial',
          'alimentacao_disponivel',
          'auxilio_terceiros',
          'tarefas_autocuidado',
          'teste_utilizado',
          'resultado_teste ',
          'outras_informacao',
          'data_teste_confirmatorio ',
          'data_inicio_sintoma',
          'data_inicio_monitoramento',
          'data_inicio_ac_psicologico',
          'data_encerramento_ac_psicologico',
          'data_finalizacao_caso',
          'auxilio_emergencial',
          'descreve_doencas',
          'tuberculose',
          'tabagista',
          'cronico_alcool',
          'outras_drogas',
          'gestante',
          'amamenta',
          'gestacao_alto_risco',
          'pos_parto',
          'data_parto',
          'data_ultima_mestrucao',
          'trimestre_gestacao',
          'motivo_risco_gravidez',
          'data_ultima_consulta',
          'sistema_saude',
          'acompanhamento_ubs',
        ];
    }

    public function collection()
    {
//        $pacientes = $pacientes->join('contacts', 'users.id', '=', 'contacts.user_id')
//        $pacientes = DB::select("SELECT P.id, PACIENTE.name AS PACIENTE, AGENTE.name AS AGENTE, MEDICO.name AS MEDICO, PSICOLOGO.name AS PSICOLOGO, P.situacao, P.data_nascimento, P.cor_raca, P.endereco_cep, P.endereco_rua,
//        P.endereco_numero, P.endereco_bairro, P.endereco_cidade, P.endereco_uf, P.ponto_referencia, P.endereco_complemento, P.fone_fixo, P.fone_celular, P.numero_pessoas_residencia, P.responsavel_residencia,
//        P.renda_residencia, P.doenca_cronica, P.outras_doencas, P.remedios_consumidos, P.acompanhamento_medico, P.isolamento_residencial, P.alimentacao_disponivel, P.auxilio_terceiros, P.tarefas_autocuidado,
//        P.teste_utilizado, P.data_teste_confirmatorio, P.caso_confirmado, P.sintomas_iniciais, AJ.tipo AS AJUDA_TIPO, DC.tipo AS DOENCA_CRONICA, EE.situacao AS ESTADO_EMOCIONAL_SITUACAO,
//        EE.medo AS ESTADO_EMOCIONAL_MEDO, ES.data_inicio_sintoma, ES.horario_sintoma, ES.sintoma_manifestado, ES.febre_temperatura_maxima, ES.data_medicao_temperatura, ES.temperatura_atual,
//        ES.cansaco_saturacao, ES.cansaco_frequencia_respiratoria, ES.pressao_arterial, I.nome_item, O.comentarios
//        FROM pacientes P
//        INNER JOIN users PACIENTE ON PACIENTE.id = P.user_id
//        LEFT JOIN agentes A ON A.id = P.agente_id LEFT JOIN users AGENTE ON AGENTE.id = A.user_id
//        LEFT JOIN medicos M ON M.id = P.medico_id LEFT JOIN users MEDICO ON MEDICO.id = M.user_id
//        LEFT JOIN psicologos PS ON PS.id = P.psicologo_id LEFT JOIN users PSICOLOGO ON PSICOLOGO.id = PS.user_id
//        LEFT JOIN ajuda_tipos AJ ON AJ.paciente_id = P.id AND AJ.id IN (SELECT MAX(id) FROM ajuda_tipos WHERE paciente_id = P.id)
//        LEFT JOIN doenca_cronicas DC ON DC.paciente_id = P.id AND DC.id IN (SELECT MAX(id) FROM doenca_cronicas WHERE paciente_id = P.id)
//        LEFT JOIN estado_emocionals EE ON EE.paciente_id = P.id AND EE.id IN (SELECT MAX(id) FROM estado_emocionals WHERE paciente_id = P.id)
//        LEFT JOIN evolucao_sintomas ES ON ES.paciente_id = P.id AND ES.id IN (SELECT MAX(id) FROM evolucao_sintomas WHERE paciente_id = P.id)
//        LEFT JOIN items I ON I.paciente_id = P.id AND I.id IN (SELECT MAX(id) FROM items WHERE paciente_id = P.id)
//        LEFT JOIN observacaos O ON O.paciente_id = P.id AND O.id IN (SELECT MAX(id) FROM observacaos WHERE paciente_id = P.id)
//        ORDER BY P.id;");
//        return $pacientes;
        return Paciente::all();
    }

    public function view(): View
    {
      return view('pages.paciente.index', [
        'pacientes' => Paciente::all(),
      ]);
    }

    public function array(): array
    {
      $pacientes = Paciente::get();
      $pacientes_array = [];

      foreach($pacientes as $paciente){

        $resultado_teste = @unserialize($paciente->resultado_teste);
        if( $resultado_teste === false ){
          $resultado_teste = $paciente->resultado_teste;
        }

        $teste_utilizado = @unserialize($paciente->teste_utilizado);
        if( $teste_utilizado === false ){
          $teste_utilizado = $paciente->teste_utilizado;
        }

        array_push($pacientes_array, [
          'nome' => $paciente->user->name,
          'name_social' => $paciente->name_social ? $paciente->name_social : '',
          'identidade_genero' => $paciente->identidade_genero ? $paciente->identidade_genero : '',
          'orientacao_sexual' => $paciente->orientacao_sexual ? $paciente->orientacao_sexual : '',
          'agente' => $paciente->agente ? $paciente->agente->user->name : '',
          'medico' => $paciente->medico ? $paciente->medico->user->name : '',
          'articuladora' => $paciente->articuladora_responsavel ? Articuladora::where('id', $paciente->articuladora_responsavel)->first()->name : '',
          'atendimento_semanal_psicologia' => $paciente->atendimento_semanal_psicologia ? $paciente->atendimento_semanal_psicologia : '',
          'acompanhamento_psicologico' => $paciente->acompanhamento_psicologico ? unserialize($paciente->acompanhamento_psicologico) : '',
          'horario_at_psicologia' => $paciente->horario_at_psicologia ? $paciente->horario_at_psicologia : '',
          'como_chegou_ao_projeto' => $paciente->como_chegou_ao_projeto ? $paciente->como_chegou_ao_projeto : '',
          'nucleo_uneafro_qual' => $paciente->nucleo_uneafro_qual ? $paciente->nucleo_uneafro_qual : '',
          'como_chegou_ao_projeto_outro' => $paciente->como_chegou_ao_projeto_outro ? $paciente->como_chegou_ao_projeto_outro : '',
          'psicologo' => $paciente->psicologo ? $paciente->psicologo->user->name : '',
          'situacao' => $paciente->situacao ? $paciente->situacao : '',
          'data_nascimento' => $paciente->data_nascimento ? $paciente->data_nascimento : '',
          'cor_raca' => $paciente->cor_raca ? $paciente->cor_raca : '',
          'endereco_cep' => $paciente->endereco_cep ? $paciente->endereco_cep : '',
          'endereco_rua' => $paciente->endereco_rua ? $paciente->endereco_rua : '',
          'endereco_numero' => $paciente->endereco_numero ? $paciente->endereco_numero : '',
          'endereco_bairro' => $paciente->endereco_bairro ? $paciente->endereco_bairro : '',
          'endereco_cidade' => $paciente->endereco_cidade ? $paciente->endereco_cidade : '',
          'endereco_uf' => $paciente->endereco_uf ? $paciente->endereco_uf : '',
          'ponto_referencia' => $paciente->ponto_referencia ? $paciente->ponto_referencia : '',
          'endereco_complemento' => $paciente->endereco_complemento ? $paciente->endereco_complemento : '',
          'fone_fixo' => $paciente->fone_fixo ? $paciente->fone_fixo : '',
          'fone_celular' => $paciente->fone_celular ? $paciente->fone_celular : '',
          'numero_pessoas_residencia' => $paciente->numero_pessoas_residencia ? $paciente->numero_pessoas_residencia : '',
          'responsavel_residencia' => $paciente->responsavel_residencia ? $paciente->responsavel_residencia : '',
          'renda_residencia' => $paciente->renda_residencia ? $paciente->renda_residencia : '',
          'doenca_cronica' => $paciente->doenca_cronica ? unserialize($paciente->doenca_cronica) : '',
          'descreve_doencas' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',
          'remedios_consumidos' => $paciente->remedios_consumidos ? $paciente->remedios_consumidos : '',
          'acompanhamento_medico' => $paciente->acompanhamento_medico ? $paciente->acompanhamento_medico : '',
          'isolamento_residencial' => $paciente->isolamento_residencial ? $paciente->isolamento_residencial : '',
          'alimentacao_disponivel' => $paciente->alimentacao_disponivel ? $paciente->alimentacao_disponivel : '',
          'auxilio_terceiros' => $paciente->auxilio_terceiros ? $paciente->auxilio_terceiros : '',
          'tarefas_autocuidado' => $paciente->tarefas_autocuidado ? $paciente->tarefas_autocuidado : '',
          //'teste_utilizado' => $paciente->teste_utilizado ? unserialize($paciente->teste_utilizado) : '',
          'teste_utilizado' => $teste_utilizado,
          'resultado_teste' => $resultado_teste ? $resultado_teste : '',
          'outras_informacao' => $paciente->outras_informacao ? $paciente->outras_informacao : '',
          'data_teste_confirmatorio' => $paciente->data_teste_confirmatorio ? $paciente->data_teste_confirmatorio : '',
          'data_inicio_sintoma' => $paciente->data_inicio_sintoma ? $paciente->data_inicio_sintoma : '',
          'data_inicio_monitoramento' => $paciente->data_inicio_monitoramento ? $paciente->data_inicio_monitoramento : '',
          'data_inicio_ac_psicologico' => $paciente->data_inicio_ac_psicologico ? $paciente->data_inicio_ac_psicologico : '',
          'data_encerramento_ac_psicologico' => $paciente->data_encerramento_ac_psicologico ? $paciente->data_encerramento_ac_psicologico : '',
          'data_finalizacao_caso' => $paciente->data_finalizacao_caso ? $paciente->data_finalizacao_caso : '',
          'auxilio_emergencial' => $paciente->auxilio_emergencial ? $paciente->auxilio_emergencial : '',
          'descreve_doencas' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',
          'tuberculose' => $paciente->tuberculose ? $paciente->tuberculose : '',
          'tabagista' => $paciente->tabagista ? $paciente->tabagista : '',
          'cronico_alcool' => $paciente->cronico_alcool ? $paciente->cronico_alcool : '',
          'outras_drogas' => $paciente->outras_drogas ? $paciente->outras_drogas : '',
          'gestante' => $paciente->gestante ? $paciente->gestante : '',
          'amamenta' => $paciente->amamenta ? $paciente->amamenta : '',
          'gestacao_alto_risco' => $paciente->gestacao_alto_risco ? $paciente->gestacao_alto_risco : '',
          'pos_parto' => $paciente->pos_parto ? $paciente->pos_parto : '',
          'data_parto' => $paciente->data_parto ? $paciente->data_parto : '',
          'data_ultima_mestrucao' => $paciente->data_ultima_mestrucao ? $paciente->data_ultima_mestrucao : '',
          'trimestre_gestacao' => $paciente->trimestre_gestacao ? $paciente->trimestre_gestacao : '',
          'motivo_risco_gravidez' => $paciente->motivo_risco_gravidez ? $paciente->motivo_risco_gravidez : '',
          'data_ultima_consulta' => $paciente->data_ultima_consulta ? $paciente->data_ultima_consulta : '',
          'sistema_saude'  => $paciente->sistema_saude ? unserialize($paciente->sistema_saude) : '',
          'acompanhamento_ubs' => $paciente->acompanhamento_ubs ? $paciente->acompanhamento_ubs : '',
        ]);
      }
      //dd($pacientes_array);
      return [$pacientes_array];
    }

}
