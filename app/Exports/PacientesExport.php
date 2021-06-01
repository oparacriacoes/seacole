<?php

namespace App\Exports;

use App\Models\Paciente;
use App\Models\Articuladora;
use App\Enums\SituacoesCaso;
use App\Exports\Headings\PacientesHeadings;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PacientesExport implements FromArray, WithTitle, WithHeadings, WithMultipleSheets
{
    private ?int $pacienteId;

    public function __construct(?int $pacienteId = null)
    {
        $this->pacienteId = $pacienteId;
    }

    public function sheets(): array
    {
        $sheets = [
            new PacientesExport(),
        ];

        return $sheets;
    }

    public function title(): string
    {
        return 'Geral';
    }

    public function headings(): array
    {
        return (new PacientesHeadings())->headings();
    }

    public function array(): array
    {
        $pacientes_rows = [];

        Paciente::query()
            ->when($this->pacienteId, function ($query, $pacienteId) {
                return $query->where('id', $pacienteId);
            })
            ->orderBy('name')
            ->chunk(100, function ($pacientes) use (&$pacientes_rows) {
                foreach ($pacientes as $paciente) {
                    $doenca = $paciente->doenca_cronica ?? [];
                    in_array('1', $doenca) ? $has = 'Sim' : $has = 'Não';
                    in_array('2', $doenca) ? $dm = 'Sim' : $dm = 'Não';
                    in_array('3', $doenca) ? $dislipidemia = 'Sim' : $dislipidemia = 'Não';
                    in_array('4', $doenca) ? $asma_bronquite = 'Sim' : $asma_bronquite = 'Não';
                    in_array('5', $doenca) ? $tuberculose_ativa = 'Sim' : $tuberculose_ativa = 'Não';
                    in_array('6', $doenca) ? $cardiopatias = 'Sim' : $cardiopatias = 'Não';
                    in_array('7', $doenca) ? $outras_doencas_respiratorias = 'Sim' : $outras_doencas_respiratorias = 'Não';
                    in_array('8', $doenca) ? $artrite_artrose_reumatismo = 'Sim' : $artrite_artrose_reumatismo = 'Não';
                    in_array('9', $doenca) ? $doenca_autoimune = 'Sim' : $doenca_autoimune = 'Não';
                    in_array('10', $doenca) ? $doenca_renal = 'Sim' : $doenca_renal = 'Não';
                    in_array('11', $doenca) ? $doenca_neurologica = 'Sim' : $doenca_neurologica = 'Não';
                    in_array('12', $doenca) ? $cancer = 'Sim' : $cancer = 'Não';
                    in_array('13', $doenca) ? $ansiedade = "Sim" : $ansiedade = 'Não';
                    in_array('14', $doenca) ? $depressao = 'Sim' : $depressao = 'Não';
                    in_array('15', $doenca) ? $demencia = 'Sim' : $demencia = 'Não';
                    in_array('16', $doenca) ? $outras_questoes_saude_mental = 'Sim' : $outras_questoes_saude_mental = 'Não';

                    $age = $paciente->age;
                    $classe = $this->incomeClass($paciente->renda_residencia);
                    $age_range = $this->ageRange($age);

                    //CALCULA e CLASSIFICA A RENDA PER CAPTA
                    if ($paciente->renda_residencia && $paciente->numero_pessoas_residencia) {
                        $income_by_person = ($paciente->renda_residencia / $paciente->numero_pessoas_residencia);
                        $perCapta = number_format($income_by_person, 2, ',', '.');
                        $classe_percapta = $this->incomeClass($income_by_person);
                    } else {
                        $perCapta = 'Dados insuficientes';
                        $classe_percapta = 'Dados insuficientes';
                    }

                    //DETERMINA A RAÇA (PARDA & PRETA = NEGRA)
                    if ($paciente->cor_raca === 'preta' || $paciente->cor_raca === 'parda') {
                        $raca_cor = 'Negra';
                    } else {
                        $raca_cor = $paciente->cor_raca;
                    };

                    $raca_cor_1 = $paciente->cor_raca;

                    //CALCULA O TOTAL DE DIAS DE MONITORAMENTO
                    if ($paciente->data_inicio_monitoramento && $paciente->data_finalizacao_caso) {
                        $monitoring_days = $this->monitoringDays($paciente->data_inicio_monitoramento, $paciente->data_finalizacao_caso);
                    } else {
                        $monitoring_days = 'Dados insuficientes';
                    }

                    $acompanhamento = $paciente->acompanhamento_psicologico ?? [];
                    in_array('individual', $acompanhamento) ? $acompanhamento_individual = 'Sim' : $acompanhamento_individual = 'Não';
                    in_array('em grupo', $acompanhamento) ? $acompanhamento_grupo = 'Sim' : $acompanhamento_grupo = 'Não';


                    if ($paciente->teste_utilizado) {
                        $teste = $paciente->teste_utilizado;
                        in_array('pcr', $teste) ? $pcr = 'Sim' : $pcr = 'Não';
                        in_array('sorologias', $teste) ? $sorologias = 'Sim' : $sorologias = 'Não';
                        in_array('teste-rapido', $teste) ? $teste_rapido = 'Sim' : $teste_rapido = 'Não';
                        in_array('nao-informado', $teste) ? $nao_informado = 'Sim' : $nao_informado = 'Não';
                    } else {
                        $pcr = '';
                        $sorologias = '';
                        $teste_rapido = '';
                        $nao_informado = '';
                    };

                    if ($paciente->resultado_teste) {
                        $resultado = $paciente->resultado_teste;
                        in_array('pcr-positivo', $resultado) ? $pcr_positivo = 'Sim' : $pcr_positivo = 'Não';
                        in_array('pcr-negativo', $resultado) ? $pcr_negativo = 'Sim' : $pcr_negativo = 'Não';
                        in_array('igm-positivo', $resultado) ? $igm_positivo = 'Sim' : $igm_positivo = 'Não';
                        in_array('img-negativo', $resultado) ? $igm_negativo = 'Sim' : $igm_negativo = 'Não';
                        in_array('igg-positivo', $resultado) ? $igg_positivo = 'Sim' : $igg_positivo = 'Não';
                        in_array('igg-negativo', $resultado) ? $igg_negativo = 'Sim' : $igg_negativo = 'Não';
                    } else {
                        $pcr_positivo = '';
                        $pcr_negativo = '';
                        $igm_positivo = '';
                        $igm_negativo = '';
                        $igg_positivo = '';
                        $igg_negativo = '';
                    };

                    $sistema_saude = $paciente->sistema_saude ?? [];
                    in_array('sus', $sistema_saude) ? $sus_publico = 'Sim' : $sus_publico = 'Não';
                    in_array('convenio-plano', $sistema_saude) ? $convenio_plano_saude = 'Sim' : $convenio_plano_saude = 'Não';
                    in_array("servico-popular-pago", $sistema_saude) ? $pagos_populares = 'Sim' : $pagos_populares = 'Não';
                    in_array('servico-privado', $sistema_saude) ? $nao_cobertos_convenios = 'Sim' : $nao_cobertos_convenios = 'Não';

                    $quadro = $paciente->quadro_atual;
                    $sintomas_manifestados = $quadro->sintomas_manifestados;
                    if (!$sintomas_manifestados) {
                        $tosse = 'Não Informado';
                        $falta_de_ar = 'Não Informado';
                        $febre = 'Não Informado';
                        $dor_de_cabeca = 'Não Informado';
                        $perda_de_olfato = 'Não Informado';
                        $perda_de_paladar = 'Não Informado';
                        $enjoo_vomitos = 'Não Informado';
                        $diarreia = 'Não Informado';
                        $aumento_pressao = 'Não Informado';
                        $queda_pressao = 'Não Informado';
                        $dor_toracica = 'Não Informado';
                        $sonolencia_cansaco = 'Não Informado';
                        $confusao_mental = 'Não Informado';
                        $desmaio = 'Não Informado';
                        $convulsao = 'Não Informado';
                        $outros_sintomas = 'Não Informado';
                    } else {
                        in_array('tosse', $sintomas_manifestados) ? $tosse = 'Sim' : $tosse = 'Não';
                        in_array('falta-ar', $sintomas_manifestados) ? $falta_de_ar = 'Sim' : $falta_de_ar = 'Não';
                        in_array('febre', $sintomas_manifestados) ? $febre = 'Sim' : $febre = 'Não';
                        in_array('dor-cabeca', $sintomas_manifestados) ? $dor_de_cabeca = 'Sim' : $dor_de_cabeca = 'Não';
                        in_array('perda-olfato', $sintomas_manifestados) ? $perda_de_olfato = 'Sim' : $perda_de_olfato = 'Não';
                        in_array('perda-paladar', $sintomas_manifestados) ? $perda_de_paladar = 'Sim' : $perda_de_paladar = 'Não';
                        in_array('enjoo', $sintomas_manifestados) ? $enjoo_vomitos = 'Sim' : $enjoo_vomitos = 'Não';
                        in_array('diarreia', $sintomas_manifestados) ? $diarreia = 'Sim' : $diarreia = 'Não';
                        in_array('aumento-pressao', $sintomas_manifestados) ? $aumento_pressao = 'Sim' : $aumento_pressao = 'Não';
                        in_array('queda-brusca-pressao', $sintomas_manifestados) ? $queda_pressao = 'Sim' : $queda_pressao = 'Não';
                        in_array('pressão-baixa', $sintomas_manifestados) ? $dor_toracica = 'Sim' : $dor_toracica = 'Não';
                        in_array('sonolencia', $sintomas_manifestados) ? $sonolencia_cansaco = 'Sim' : $sonolencia_cansaco = 'Não';
                        in_array('confusao-mental', $sintomas_manifestados) ? $confusao_mental = 'Sim' : $confusao_mental = 'Não';
                        in_array('desmaio', $sintomas_manifestados) ? $desmaio = 'Sim' : $desmaio = 'Não';
                        in_array('convulsao', $sintomas_manifestados) ? $convulsao = 'Sim' : $convulsao = 'Não';
                        in_array('outros', $sintomas_manifestados) ? $outros_sintomas = 'Sim' : $outros_sintomas = 'Não';
                    }
                    $sequelas = $quadro->sequelas;
                    if (!$sequelas) {
                        $perda_persistente_olfato = '';
                        $perda_persistente_paladar = '';
                        $tosse_persistente = '';
                        $falta_ar_persistente = '';
                        $dor_cabeca_persistente = '';
                        $eventos_tromboliticos = '';
                        $danos_renais = '';
                        $sequelas_outros = '';
                    } else {
                        in_array('perda-persistente-olfato', $sequelas) ? $perda_persistente_olfato = 'Sim' : $perda_persistente_olfato = 'Não';
                        in_array('perda-persistente-paladar', $sequelas) ? $perda_persistente_paladar = 'Sim' : $perda_persistente_paladar = 'Não';
                        in_array('tosse-persistente', $sequelas) ? $tosse_persistente = 'Sim' : $tosse_persistente = 'Não';
                        in_array('falta-ar-persistente', $sequelas) ? $falta_ar_persistente = 'Sim' : $falta_ar_persistente = 'Não';
                        in_array('dor-cabeca-persistente', $sequelas) ? $dor_cabeca_persistente = 'Sim' : $dor_cabeca_persistente = 'Não';
                        in_array('eventos-tromboliticos', $sequelas) ? $eventos_tromboliticos = 'Sim' : $eventos_tromboliticos = 'Não';
                        in_array('danos-renais', $sequelas) ? $danos_renais = 'Sim' : $danos_renais = 'Não';
                        in_array('outros?', $sequelas) ? $sequelas_outros = 'Sim' : $sequelas_outros = 'Não';
                    }

                    $saude_mental = $paciente->saude_mental;

                    $internacao = $paciente->servico_internacao;
                    $precisou_servico = $internacao->precisou_servico;
                    if (!$precisou_servico) {
                        $ubs_posto_de_saude = '';
                        $upa = '';
                        $ama = '';
                        $hospital_publico = '';
                        $hospital_privado = '';
                    } else {
                        in_array('ubs', $precisou_servico) ? $ubs_posto_de_saude = 'Sim' : $ubs_posto_de_saude = 'Não';
                        in_array('upa', $precisou_servico) ? $upa = 'Sim' : $upa = 'Não';
                        in_array('ama', $precisou_servico) ? $ama = 'Sim' : $ama = 'Não';
                        in_array('hospital-publico', $precisou_servico) ? $hospital_publico = 'Sim' : $hospital_publico = 'Não';
                        in_array('hospital-privado', $precisou_servico) ? $hospital_privado = 'Sim' : $hospital_privado = 'Não';
                    }
                    $recebeu_medicacao = $internacao->recebeu_med_covid;
                    if (!$recebeu_medicacao) {
                        $azitromicina = '';
                        $outro_antibiotico = '';
                        $ivermectina = '';
                        $cloroquina_hidroxicloroquina = '';
                        $oseltamivir = '';
                        $algum_antialergico = '';
                        $algum_corticoide = '';
                        $algum_antiinflamatorio = '';
                        $vitamina_d = '';
                        $zinco = '';
                        $outro_medicamento = '';
                    } else {
                        in_array('azitromicina', $recebeu_medicacao) ? $azitromicina = 'Sim' : $azitromicina = 'Não';
                        in_array('antibiotico', $recebeu_medicacao) ? $outro_antibiotico = 'Sim' : $outro_antibiotico = 'Não';
                        in_array('ivermectina', $recebeu_medicacao) ? $ivermectina = 'Sim' : $ivermectina = 'Não';
                        in_array('cloroquina-hidroxicloroquina', $recebeu_medicacao) ? $cloroquina_hidroxicloroquina = 'Sim' : $cloroquina_hidroxicloroquina = 'Não';
                        in_array('oseltamivir', $recebeu_medicacao) ? $oseltamivir = 'Sim' : $oseltamivir = 'Não';
                        in_array('antialergico', $recebeu_medicacao) ? $algum_antialergico = 'Sim' : $algum_antialergico = 'Não';
                        in_array('corticoide', $recebeu_medicacao) ? $algum_corticoide = 'Sim' : $algum_corticoide = 'Não';
                        in_array('antiinflamatorio', $recebeu_medicacao) ? $algum_antiinflamatorio = 'Sim' : $algum_antiinflamatorio = 'Não';
                        in_array('vitamina-d', $recebeu_medicacao) ? $vitamina_d = 'Sim' : $vitamina_d = 'Não';
                        in_array('zinco', $recebeu_medicacao) ? $zinco = 'Sim' : $zinco = 'Não';
                        in_array('outro', $recebeu_medicacao) ? $outro_medicamento = 'Sim' : $outro_medicamento = 'Não';
                    }
                    $problema_internacao = $internacao->teve_algum_problema;
                    if (!$problema_internacao) {
                        $problema_ubs = '';
                        $problema_upa = '';
                        $problema_ama = '';
                        $problema_hospital_publico = '';
                        $problema_hospital_privado = '';
                        $problema_outro = '';
                    } else {
                        in_array('ubs', $problema_internacao) ? $problema_ubs = 'Sim' : $problema_ubs = 'Não';
                        in_array('upa', $problema_internacao) ? $problema_upa = 'Sim' : $problema_upa = 'Não';
                        in_array('ama', $problema_internacao) ? $problema_ama = 'Sim' : $problema_ama = 'Não';
                        in_array('hospital-publico', $problema_internacao) ? $problema_hospital_publico = 'Sim' : $problema_hospital_publico = 'Não';
                        in_array('hospital-privado', $problema_internacao) ? $problema_hospital_privado = 'Sim' : $problema_hospital_privado = 'Não';
                        in_array('outro?', $problema_internacao) ? $problema_outro = 'Sim' : $problema_outro = 'Não';
                    }
                    $local_internacao = $internacao->local_internacao;
                    if (!$local_internacao) {
                        $hospital_publico_referencia = '';
                        $hospital_campanha = '';
                        $hospital_particular_referencia = '';
                        $hospital_ipiranga = '';
                        $hospital_financiado_projeto = '';
                    } else {
                        in_array('hospital-publico-referencia', $local_internacao) ? $hospital_publico_referencia = 'Sim' : $hospital_publico_referencia = 'Não';
                        in_array('hospital-campanha', $local_internacao) ? $hospital_campanha = 'Sim' : $hospital_campanha = 'Não';
                        in_array('hospital-particular-referencia', $local_internacao) ? $hospital_particular_referencia = 'Sim' : $hospital_particular_referencia = 'Não';
                        in_array('hospital-municipal-ipiranga', $local_internacao) ? $hospital_ipiranga = 'Sim' : $hospital_ipiranga = 'Não';
                        in_array('hospital-privado-financiado-projeto', $local_internacao) ? $hospital_financiado_projeto = 'Sim' : $hospital_financiado_projeto = 'Não';
                    }
                    if ($internacao && $internacao->data_entrada_internacao && $internacao->data_alta_hospitalar) {
                        $tempo_internacao = $this->monitoringDays($internacao->data_entrada_internacao, $internacao->data_alta_hospitalar);
                    } else {
                        $tempo_internacao = 'Dados insuficientes';
                    }

                    $insumos_oferecidos = $paciente->insumos_oferecidos;
                    $precisa_ajuda = $insumos_oferecidos->precisa_tipo_ajuda;
                    if (!$precisa_ajuda) {
                        $precisa_ajuda === 'remedios-uso-continuo' ? $remedios_uso_continuo = 'Sim' : $remedios_uso_continuo = 'Não';
                        $precisa_ajuda === 'remedio-tratamento-quadro-atual' ? $remedios_tratamento_quadro_atual = 'Sim' : $remedios_tratamento_quadro_atual = 'Não';
                        $precisa_ajuda === 'alimento-cesta-basica' ? $produtos_necessidade_basica = 'Sim' : $produtos_necessidade_basica = 'Não';
                        $precisa_ajuda === 'outros' ? $ajuda_outros = 'Sim' : $ajuda_outros = 'Não';
                    } else {
                        $precisa_ajuda && in_array('remedios-uso-continuo', $precisa_ajuda) ? $remedios_uso_continuo = 'Sim' : $remedios_uso_continuo = 'Não';
                        $precisa_ajuda && in_array('remedio-tratamento-quadro-atual', $precisa_ajuda) ? $remedios_tratamento_quadro_atual = 'Sim' : $remedios_tratamento_quadro_atual = 'Não';
                        $precisa_ajuda && in_array('alimento-cesta-basica', $precisa_ajuda) ? $produtos_necessidade_basica = 'Sim' : $produtos_necessidade_basica = 'Não';
                        $precisa_ajuda && in_array('outros', $precisa_ajuda) ? $ajuda_outros = 'Sim' : $ajuda_outros = 'Não';
                    }

                    $tratamento_financiado = $insumos_oferecidos->tratamento_financiado;
                    if (!$tratamento_financiado) {
                        $tratamento_financiado === 'alopaticos' ? $tratamento_financiado_alopatico = 'Sim' : $tratamento_financiado_alopatico = 'Não';
                        $tratamento_financiado === 'pics' ? $tratamento_financiado_pics = 'Sim' : $tratamento_financiado_pics = 'Não';
                    } else {
                        $tratamento_financiado && in_array('alopaticos', $tratamento_financiado) ? $tratamento_financiado_alopatico = 'Sim' : $tratamento_financiado_alopatico = 'Não';
                        $tratamento_financiado && in_array('pics', $tratamento_financiado) ? $tratamento_financiado_pics = 'Sim' : $tratamento_financiado_pics = 'Não';
                    }

                    $material_entregue = $insumos_oferecidos->material_entregue ?? [];
                    in_array('cartilha-cuidados', $material_entregue) ? $cartilha_cuidados = 'Sim' : $cartilha_cuidados = 'Não';
                    in_array('termometro', $material_entregue) ? $termometro = 'Sim' : $termometro = 'Não';
                    in_array('dipirona', $material_entregue) ? $dipirona = 'Sim' : $dipirona = 'Não';
                    in_array('paracetamol', $material_entregue) ? $paracetamol = 'Sim' : $paracetamol = 'Não';
                    in_array('oximetro', $material_entregue) ? $oximetro = 'Sim' : $oximetro = 'Não';
                    in_array('mascaras-tecido', $material_entregue) ? $mascaras_tecido = 'Sim' : $mascaras_tecido = 'Não';
                    in_array('material-limpeza', $material_entregue) ? $mascaras_limpeza = 'Sim' : $mascaras_limpeza = 'Não';
                    in_array('cesta-basica', $material_entregue) ? $cesta_basica = 'Sim' : $cesta_basica = 'Não';

                    $paciente_row = [
                        'Nome' => $paciente->name,
                        'Nome social' => $paciente->name_social ?? '',
                        'Tel. fixo' => $paciente->fone_fixo ?? '',
                        'Tel. celular' => $paciente->fone_celular ?? '',
                        'Data nascimento' => $paciente->data_nascimento ? $paciente->data_nascimento->format('Y-m-d') : '',
                        'Idade' => $age,
                        'Faixa Etária' => $age_range,
                        'Responsável residência' => $paciente->responsavel_residencia ?? '',
                        'Email' => $paciente->email ?? '',
                        'CEP' => $paciente->endereco_cep ?? '',
                        'Rua' => $paciente->endereco_rua ?? '',
                        'Número' => $paciente->endereco_numero ?? '',
                        'Complemento' => $paciente->endereco_complemento ?? '',
                        'Bairro' => $paciente->endereco_bairro ?? '',
                        'Cidade' => $paciente->endereco_cidade ?? '',
                        'UF' => $paciente->endereco_uf ?? '',
                        'Ponto referência' => $paciente->ponto_referencia ?? '',
                        'Identidade gênero' => $paciente->identidade_genero ?? '',
                        'Orientação sexual' => $paciente->orientacao_sexual ?? '',
                        'raca_cor' => $raca_cor ?? '',
                        'raca_cor_1' => $raca_cor_1 ?? '',
                        'Nº pessoas residência' => $paciente->numero_pessoas_residencia ?? '',
                        'Auxílio emergencial' => human_boolean($paciente->auxilio_emergencial),
                        'Renda residência' => $paciente->renda_residencia ?? '',
                        'Classe Social' => $classe,
                        'Renda per capta' => $perCapta,
                        'Classe Social (Renda Per Capta)' => $classe_percapta,
                        'Como chegou ao projeto' => $paciente->como_chegou_ao_projeto ?? '',
                        'Núcleo UNEAFRO qual?' => $paciente->nucleo_uneafro_qual ?? '',
                        'Como chegou ao projeto outro' => $paciente->como_chegou_ao_projeto_outro ?? '',
                        'Data início sintoma' => $paciente->data_inicio_sintoma ? $paciente->data_inicio_sintoma->format('Y-m-d') : '',
                        'Data início monitoramento' => $paciente->data_inicio_monitoramento ? $paciente->data_inicio_monitoramento->format('Y-m-d') : '',
                        'Data finalização caso' => $paciente->data_finalizacao_caso ? $paciente->data_finalizacao_caso->format('Y-m-d') : '',
                        'Total dias monitoramento' => $monitoring_days,
                        'Situação' => $paciente->situacao ? (string)SituacoesCaso::get((int)$paciente->situacao) : '',
                        'Agente' => $paciente->agente ? $paciente->agente->user->name : '',
                        'Médico' => $paciente->medico ? $paciente->medico->user->name : '',
                        'Articuladora' => $paciente->articuladora_responsavel ? Articuladora::where('id', $paciente->articuladora_responsavel)->first()->name : '',
                        'Psicólogo' => $paciente->psicologo ? $paciente->psicologo->user->name : '',
                        'Data início ac. psicológico' => $paciente->data_inicio_ac_psicologico ? $paciente->data_inicio_ac_psicologico->format('Y-m-d') : '',
                        'Data encerramento ac. psicológico' => $paciente->data_encerramento_ac_psicologico ? $paciente->data_encerramento_ac_psicologico->format('Y-m-d') : '',
                        'Acomp. psicol. individual' => $acompanhamento_individual,
                        'Acomp. psicol. em grupo' => $acompanhamento_grupo,
                        'At. semanal psicol.' => $paciente->atendimento_semanal_psicologia ? $paciente->atendimento_semanal_psicologia : '',
                        'Hor. at. psicol.' => $paciente->horario_at_psicologia ? $paciente->horario_at_psicologia : '',
                        'diagnostico_covid_19' => $paciente->sintomas_iniciais ? $paciente->sintomas_iniciais : '',
                        'data_teste_confirmatorio' => $paciente->data_teste_confirmatorio ? $paciente->data_teste_confirmatorio->format('Y-m-d') : '',
                        'PCR' => $pcr,
                        'sorologias (IgM/IgG)' => $sorologias,
                        'Teste Rápido' => $teste_rapido,
                        'Não Informado' => $nao_informado,
                        'PCR positivo' => $pcr_positivo,
                        'PCR negativo' => $pcr_negativo,
                        'IgM positivo' => $igm_positivo,
                        'IgM negativo' => $igm_negativo,
                        'IgG positivo' => $igg_positivo,
                        'IgG negativo' => $igg_negativo,
                        'Outras inf. sobre o teste' => $paciente->outras_informacao ? $paciente->outras_informacao : '',

                        'has' => $has,
                        'dm' => $dm,
                        'dislipidemia' => $dislipidemia,
                        'asma_bronquite' => $asma_bronquite,
                        'tuberculose_ativa' => $tuberculose_ativa,
                        'cardiopatias' => $cardiopatias,
                        'outras_doencas_respiratorias' => $outras_doencas_respiratorias,
                        'artrite_artrose_reumatismo' => $artrite_artrose_reumatismo,
                        'doenca_autoimune' => $doenca_autoimune,
                        'doenca_renal' => $doenca_renal,
                        'doenca_neurologica' => $doenca_neurologica,
                        'cancer' => $cancer,
                        'ansiedade' => $ansiedade,
                        'depressao' => $depressao,
                        'demencia' => $demencia,
                        'outras_questoes_saude_mental' => $outras_questoes_saude_mental,
                        'descreva_doencas_assinaladas' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',

                        'tuberculose' => human_boolean($paciente->tuberculose),
                        'tabagista' => human_boolean($paciente->tabagista),
                        'cronico_alcool' => human_boolean($paciente->cronico_alcool),
                        'outras_drogas' => human_boolean($paciente->outras_drogas),

                        'toma_remedios_uso_continuo' => $paciente->remedios_consumidos ? $paciente->remedios_consumidos : '',

                        'Gestante' => human_boolean($paciente->gestante),
                        'Pós parto' => human_boolean($paciente->pos_parto),
                        'Amamenta' => human_boolean($paciente->amamenta),
                        'Gestação alto risco' => human_boolean($paciente->gestacao_alto_risco),
                        'Motivo risco gravidez' => $paciente->motivo_risco_gravidez ?? $paciente->motivo_risco_gravidez,
                        'Data parto' => $paciente->data_parto ? $paciente->data_parto->format('Y-m-d') : '',
                        'Data última mestruação' => $paciente->data_ultima_mestrucao ? $paciente->data_ultima_mestrucao->format('Y-m-d') : '',
                        'Trimestre gestacao' => $paciente->trimestre_gestacao ?? '',
                        'Acompanhamento médico' => human_boolean($paciente->acompanhamento_medico),
                        'Data última consulta' => $paciente->data_ultima_consulta ? $paciente->data_ultima_consulta->format('Y-m-d') : '',

                        'sus_publico' => $sus_publico,
                        'convenio_plano_saude' => $convenio_plano_saude,
                        'pagos_populares' => $pagos_populares,
                        'nao_cobertos_convenios' => $nao_cobertos_convenios,

                        'primeiros_sintomas' => $quadro ? $quadro->primeira_sintoma : 'Não informado',
                        'tosse' => $tosse ? $tosse : 'Não Informado',
                        'falta_de_ar' => $falta_de_ar ? $falta_de_ar : 'Não Informado',
                        'febre' => $febre ? $febre : 'Não Informado',
                        'dor_de_cabeca' => $dor_de_cabeca ? $dor_de_cabeca : 'Não Informado',
                        'perda_de_olfato' => $perda_de_olfato ? $perda_de_olfato : 'Não Informado',
                        'perda_de_paladar' => $perda_de_paladar ? $perda_de_paladar : 'Não Informado',
                        'enjoo_vomitos' => $enjoo_vomitos ? $enjoo_vomitos : 'Não Informado',
                        'diarreia' => $diarreia ? $diarreia : 'Não Informado',
                        'aumento_pressao' => $aumento_pressao ? $aumento_pressao : 'Não Informado',
                        'queda_pressao' => $queda_pressao ? $queda_pressao : 'Não Informado',
                        'dor_toracica' => $dor_toracica ? $dor_toracica : 'Não Informado',
                        'sonolencia_cansaco' => $sonolencia_cansaco ? $sonolencia_cansaco : 'Não Informado',
                        'confusao_mental' => $confusao_mental ? $confusao_mental : 'Não Informado',
                        'desmaio' => $desmaio ? $desmaio : 'Não Informado',
                        'convulsao' => $convulsao ? $convulsao : 'Não Informado',
                        'outros_sintomas' => $outros_sintomas ? $outros_sintomas : 'Não Informado',
                        'temperatura_maxima' => $quadro ? $quadro->temperatura_max : 'Não Informado',
                        'data_temperatura_maxima' => $quadro->data_temp_max ? $quadro->data_temp_max->format('Y-m-d') : 'Não Informado',
                        'saturacao_baixa' => $quadro->data_temp_max ? $quadro->saturacao_baixa : 'Não Informado',
                        'data_saturacao_baixa' => $quadro->data_sat_max ? $quadro->data_sat_max->format('Y-m-d') : 'Não Informado',
                        'frequencia_respiratoria' => $quadro ? $quadro->frequencia_max : 'Não Informado',
                        'data_frequencia_respiratoria' => $quadro->data_freq_max ? $quadro->data_freq_max->format('Y-m-d') : 'Não Informado',
                        'DESFECHO:' => $quadro ? $quadro->desfecho : '',
                        'perda_persistente_olfato' => $perda_persistente_olfato,
                        'perda_persistente_paladar' => $perda_persistente_paladar,
                        'tosse_persistente' => $tosse_persistente,
                        'falta_ar_persistente' => $falta_ar_persistente,
                        'dor_cabeca_persistente' => $dor_cabeca_persistente,
                        'eventos_tromboliticos' => $eventos_tromboliticos,
                        'danos_renais' => $danos_renais,
                        'sequelas_outros' => $sequelas_outros,
                        'SEQUELAS: outros QUAIS?' => $quadro ? $quadro->outra_sequela_qual : '',
                        'Algo mais que queira descrever sobre o caso?' => $quadro ? $quadro->algo_mais_sobre_caso : '',

                        'intensifica_medos' => $saude_mental ? human_boolean($saude_mental->quadro_atual) : 'Não Informado',
                        'detalhe_medos' => $saude_mental ? $saude_mental->detalhes_medos : 'Não Informado',

                        'ubs_posto_de_saude' => $ubs_posto_de_saude,
                        'upa' => $upa,
                        'ama' => $ama,
                        'hospital_publico' => $hospital_publico,
                        'hospital_privado' => $hospital_privado,
                        'precisou_servico_outro' => $internacao ? $internacao->precisou_servico_outro : '',
                        'Quantas idas a serviços de saúde?' => $internacao ? $internacao->quant_ida_servico : '',
                        'Data da última ida a serviço de saúde' => $internacao->data_ultima_ida_servico_de_saude ? $internacao->data_ultima_ida_servico_de_saude->format('Y-m-d') : '',
                        'azitromicina' => $azitromicina,
                        'outro_antibiotico' => $outro_antibiotico,
                        'ivermectina' => $ivermectina,
                        'cloroquina_hidroxicloroquina' => $cloroquina_hidroxicloroquina,
                        'oseltamivir' => $oseltamivir,
                        'algum_antialergico' => $algum_antialergico,
                        'algum_corticoide' => $algum_corticoide,
                        'algum_antiinflamatorio' => $algum_antiinflamatorio,
                        'vitamina_d' => $vitamina_d,
                        'zinco' => $zinco,
                        'outro_medicamento' => $outro_medicamento,
                        'nome_medicamento_prescrito' => $internacao ? $internacao->nome_medicamento : '',
                        'problema_ubs' => $problema_ubs,
                        'problema_upa' => $problema_upa,
                        'problema_ama' => $problema_ama,
                        'problema_hospital_publico' => $problema_hospital_publico,
                        'problema_hospital_privado' => $problema_hospital_privado,
                        'problema_outro' => $problema_outro,
                        'descreva_problema' => $internacao ? $internacao->descreva_problema : '',
                        'precisou_internacao_quadro' => human_boolean($internacao->precisou_internacao),
                        'precisou_ambulancia' => human_boolean($internacao->precisou_ambulancia),
                        'hospital_publico_referencia' => $hospital_publico_referencia,
                        'hospital_campanha' => $hospital_campanha,
                        'hospital_particular_referencia' => $hospital_particular_referencia,
                        'hospital_ipiranga' => $hospital_ipiranga,
                        'hospital_financiado_projeto' => $hospital_financiado_projeto,
                        'nome_hospital_internacao' => $internacao ? $internacao->nome_hospital : '',
                        'data_entrada_internacao' => $internacao->data_entrada_internacao ? $internacao->data_entrada_internacao->format('Y-m-d') : '',
                        'data_alta_hospitalar' => $internacao->data_entrada_internacao ? $internacao->data_entrada_internacao->format('Y-m-d') : '',
                        'tempo_internacao' => $tempo_internacao,

                        'isolamento_residencial' => human_boolean($insumos_oferecidos->condicao_ficar_isolada),
                        'alimentacao_disponivel' => human_boolean($insumos_oferecidos->tem_comida),
                        'auxilio_terceiros' => human_boolean($insumos_oferecidos->tem_alguem),
                        'tarefas_autocuidado' => human_boolean($insumos_oferecidos->tarefas_autocuidado),

                        'remedios_uso_continuo' => $remedios_uso_continuo,
                        'remedios_tratamento_quadro_atual' => $remedios_tratamento_quadro_atual,
                        'produtos_necessidade_basica' => $produtos_necessidade_basica,
                        'ajuda_outros' => $ajuda_outros,
                        'Tratamento foi prescrito por algum médico do projeto?' => human_boolean($insumos_oferecidos->tratamento_prescrito),
                        'tratamento_financiado_alopatico' => $tratamento_financiado_alopatico,
                        'tratamento_financiado_pics' => $tratamento_financiado_pics,
                        'cartilha_cuidados' => $cartilha_cuidados,
                        'termometro' => $termometro,
                        'dipirona' => $dipirona,
                        'paracetamol' => $paracetamol,
                        'oximetro' => $oximetro,
                        'mascaras_tecido' => $mascaras_tecido,
                        'mascaras_limpeza' => $mascaras_limpeza,
                        'cesta_basica' => $cesta_basica,
                        'oximetro_devolvido' => human_boolean($insumos_oferecidos->oximetro_devolvido),
                    ];
                    array_push($pacientes_rows, $paciente_row);
                }
            });
        return [$pacientes_rows];
    }

    private function incomeClass($income)
    {
        $income_parse = floatval($income);

        if (is_null($income)) {
            return '';
        }

        if ($income_parse >= 0 && $income_parse <= 1254) {
            return 'CLASSE E';
        }
        if ($income_parse >= 1255 && $income_parse <= 2004) {
            return 'CLASSE D';
        }
        if ($income_parse >= 2005 && $income_parse <= 8640) {
            return 'CLASSE C';
        }
        if ($income_parse >= 8641 && $income_parse <= 11261) {
            return 'CLASSE B';
        }
        if ($income_parse >= 11262) {
            return 'CLASSE A';
        }
    }

    public function ageRange($age)
    {
        if ($age >= 0 && $age <= 4) {
            return '0-4';
        }
        if ($age >= 5 && $age <= 9) {
            return '5-9';
        }
        if ($age >= 10 && $age <= 14) {
            return '10-14';
        }
        if ($age >= 15 && $age <= 19) {
            return '15-19';
        }
        if ($age >= 20 && $age <= 24) {
            return '20-24';
        }
        if ($age >= 25 && $age <= 29) {
            return '25-29';
        }
        if ($age >= 30 && $age <= 34) {
            return '30-34';
        }
        if ($age >= 35 && $age <= 39) {
            return '35-39';
        }
        if ($age >= 40 && $age <= 44) {
            return '40-44';
        }
        if ($age >= 45 && $age <= 49) {
            return '45-49';
        }
        if ($age >= 50 && $age <= 54) {
            return '50-54';
        }
        if ($age >= 55 && $age <= 59) {
            return '55-59';
        }
        if ($age >= 60 && $age <= 64) {
            return '60-64';
        }
        if ($age >= 65 && $age <= 69) {
            return '65-69';
        }
        if ($age >= 70 && $age <= 74) {
            return '70-74';
        }
        if ($age >= 75 && $age <= 79) {
            return '75-79';
        }
        if ($age >= 80 && $age <= 84) {
            return '80-84';
        }
        if ($age >= 85 && $age <= 89) {
            return '85-89';
        }
        if ($age >= 90 && $age <= 94) {
            return '90-94';
        }
        if ($age >= 95 && $age <= 99) {
            return '95-99';
        }
        if ($age >= 100 && $age <= 104) {
            return '100-104';
        }
    }

    public function monitoringDays($date1, $date2)
    {
        $monitoringDays = $date1->diffInDays($date2);
        return $monitoringDays;
    }
}
