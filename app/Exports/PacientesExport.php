<?php

namespace App\Exports;

use App\Paciente;
use App\Articuladora;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class PacientesExport implements FromArray, WithHeadings, WithMultipleSheets, WithTitle
{
    public function sheets(): array
    {
        $sheets = [
          new PacientesExport(),
          new QuadroAtualExport(),
          new SaudeMentalExport(),
          new ServicoInternacaoExport(),
          new InsumosOferecidoExport(),
        ];

        return $sheets;
    }

    public function title(): string
    {
      return 'Geral';
    }

    public function headings(): array
    {
        return [
          'Nome',
          'Nome social',
          'Tel. fixo',
          'Tel. celular',
          'Data nascimento',
          'Idade',
          'Faixa Etária',
          'Responsável residência',
          'Email',
          'CEP',
          'Rua',
          'Número',
          'Complemento',
          'Bairro',
          'Cidade',
          'UF',
          'Ponto referência',
          'Identidade gênero',
          'Orientação sexual',
          'Cor/Raça',
          'Nº pessoas residência',
          'Auxílio emergencial',
          'Renda residência',
          'Classe Social (Renda Total)',
          'Renda per capta',
          'Classe Social (Renda Per Capta)',
          'Como chegou ao projeto',
          'Núcleo UNEAFRO qual?',
          'Como chegou ao projeto outro',
          'Data início sintoma',
          'Data início monitoramento',
          'Data finalização caso',
          'Total dias monitoramento',
          'Situação',
          'Agente',
          'Médico',
          'Articuladora',
          'Psicólogo',
          'Data início ac. psicológico',
          'Data encerramento ac. psicológico',
          'Acomp. psicol. individual',
          'Acomp. psicol. em grupo',
          'At. semanal psicol.',
          'Hor. at. psicol.',
          //'Diagnóstico', // A FAZER
          'Testes Realizados? PCR',
          'Testes Realizados? Sorologias (IgM/IgG)',
          'Testes Realizados? Teste Rápido',
          'Testes Realizados? Não Informado',

          'Resultados Encontrados - PCR positivo',
          'Resultados Encontrados - PCR negativo',
          'Resultados Encontrados - IgM positivo',
          'Resultados Encontrados - IgM negativo',
          'Resultados Encontrados - IgG positivo',
          'Resultados Encontrados - IgG negativo',

          'Outras inf. sobre o teste',

          'Condições Gerais de Saúde: Hipertensão arterial sistêmica (HAS)',
          'Condições Gerais de Saúde: Diabetes Mellitus (DM)',
          'Condições Gerais de Saúde: Dislipidemia',
          'Condições Gerais de Saúde: Asma / Bronquite',
          'Condições Gerais de Saúde: Tuberculose ativa',
          'Condições Gerais de Saúde: Cardiopatias e outras doenças cardiovasculares',
          'Condições Gerais de Saúde: Outras doenças respiratórias',
          'Condições Gerais de Saúde: Artrite/Artrose/Reumatismo',
          'Condições Gerais de Saúde: Doença autoimune',
          'Condições Gerais de Saúde: Doença renal',
          'Condições Gerais de Saúde: Doença neurológica',
          'Condições Gerais de Saúde: Câncer',
          'Condições Gerais de Saúde: Ansiedade',
          'Condições Gerais de Saúde: Depressão',
          'Condições Gerais de Saúde: Demência',
          'Condições Gerais de Saúde: Outras questões de saúde mental',
          'Condições Gerais de Saúde: Descreva as doenças assinaladas',

          'Tuberculose',
          'Tabagista',
          'Alcool crônico',
          'Outras drogas',
          'Gestante',
          'Pós parto',
          'Amamenta',
          'Gestação alto risco',
          'Motivo risco gravidez',
          'Data parto',
          'Data última menstruação',
          'Trimestre gestacao',
          'Acompanhamento médico',
          'Data última consulta',

          'Onde/como acessa o sistema de saúde? - É usuária/o do SUS (público)',
          'Onde/como acessa o sistema de saúde? - Tem convênio/plano de saúde',
          'Onde/como acessa o sistema de saúde? Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)',
          'Onde/como acessa o sistema de saúde? - Usuária/o de serviços particulares não cobertos por convênios',

          // AQUI VÃO AS INFORMAÇÕES DA ABA 'QUADRO ATUAL' - A FAZER
          // AQUI VÃO AS INFORMAÇÕES DA ABA 'SAÚDE MENTAL' - A FAZER
          // AQUI VÃO AS INFORMAÇÕES DA ABA 'SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO' - A FAZER
          // AQUI VÃO AS INFORMAÇÕES DA ABA 'INSUMOS OFERECIDOS PELO PROJETO' - A FAZER

          // IDENTIFICAR ONDE ENTRARÃO ESTAS INFOS - INICIO
          /*'Remédios consumidos',
          'Isolamento residencial',
          'Alimentacao disponível',
          'Auxílio terceiros',
          'Tarefas autocuidado',
          'Data teste confirmatório',
          'Descrição doenças',
          'Acompanhamento UBS',*/
          // IDENTIFICAR ONDE ENTRARÃO ESTAS INFOS - FIM
        ];
    }


    public function ageCalc($date)
    {
      $date_replace = str_replace('/', '-', $date);
      $date_time = strtotime($date_replace);
      $to_date = date('Y-m-d', $date_time);
      $date_parse = Carbon::parse($to_date);
      return $date_parse->diffInYears();
    }

    public function incomeClass($income)
    {
      $income_parse = (int)$income;

      if( $income_parse >= 0 && $income_parse <= 1254 ){
        return 'CLASSE E';
      }
      if( $income_parse >= 1255 && $income_parse <= 2004 ){
        return 'CLASSE D';
      }
      if( $income_parse >= 2005 && $income_parse <= 8640 ){
        return 'CLASSE C';
      }
      if( $income_parse >= 8641 && $income_parse <= 11261 ){
        return 'CLASSE B';
      }
      if( $income_parse >= 11262 ){
        return 'CLASSE A';
      }
    }

    public function perCapitaIncome($income, $people)
    {
      $income_parse = (int)$income;
      $people_parse = (int)$people;
      $result = $income_parse/$people_parse;
      $perCapta_format = number_format($result, 2, ',', '.');

      return $perCapta_format;
    }

    public function ageRange($age)
    {
      if( $age >= 0 && $age <= 4 ){
        return '0-4';
      }
      if( $age >= 5 && $age <= 9 ){
        return '5-9';
      }
      if( $age >= 10 && $age <= 14 ){
        return '10-14';
      }
      if( $age >= 15 && $age <= 19 ){
        return '15-19';
      }
      if( $age >= 20 && $age <= 24 ){
        return '20-24';
      }
      if( $age >= 25 && $age <= 29 ){
        return '25-29';
      }
      if( $age >= 30 && $age <= 34 ){
        return '30-34';
      }
      if( $age >= 35 && $age <= 39 ){
        return '35-39';
      }
      if( $age >= 40 && $age <= 44 ){
        return '40-44';
      }
      if( $age >= 45 && $age <= 49 ){
        return '45-49';
      }
      if( $age >= 50 && $age <= 54 ){
        return '50-54';
      }
      if( $age >= 55 && $age <= 59 ){
        return '55-59';
      }
      if( $age >= 60 && $age <= 64 ){
        return '60-64';
      }
      if( $age >= 65 && $age <= 69 ){
        return '65-69';
      }
      if( $age >= 70 && $age <= 74 ){
        return '70-74';
      }
      if( $age >= 75 && $age <= 79 ){
        return '75-79';
      }
      if( $age >= 80 && $age <= 84 ){
        return '80-84';
      }
      if( $age >= 85 && $age <= 89 ){
        return '85-89';
      }
      if( $age >= 90 && $age <= 94 ){
        return '90-94';
      }
      if( $age >= 95 && $age <= 99 ){
        return '95-99';
      }
      if( $age >= 100 && $age <= 104 ){
        return '100-104';
      }
    }

    public function monitoringDays($date1, $date2)
    {
      $date1_replace = str_replace('/', '-', $date1);
      $date2_replace = str_replace('/', '-', $date2);
      $date1_time = strtotime($date1_replace);
      $date2_time = strtotime($date2_replace);
      $from_date = date('Y-m-d', $date1_time);
      $to_date = date('Y-m-d', $date2_time);
      $from_parse = Carbon::parse($from_date);
      $to_parse = Carbon::parse($to_date);
      $monitoringDays = $from_parse->diffInDays($to_parse);

      return $monitoringDays;
    }

    public function array(): array
    {
      $pacientes = Paciente::get();
      $pacientes_array = [];

      foreach($pacientes as $paciente){

        $doenca = $paciente->doenca_cronica ? unserialize($paciente->doenca_cronica) : [];
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

        $situacao_array = [];
        if($paciente->situacao === '1'){
          array_push($situacao_array, 'Caso ativo GRAVE');
        }
        if($paciente->situacao === '2'){
          array_push($situacao_array, 'Caso ativo LEVE');
        }
        if($paciente->situacao === '3'){
          array_push($situacao_array, 'Contato caso confirmado - ativo');
        }
        if($paciente->situacao === '4'){
          array_push($situacao_array, 'Outras situações (sem relação com COVID-19) - ativos');
        }
        if($paciente->situacao === '5'){
          array_push($situacao_array, 'Exclusivo psicologia - ativo');
        }
        if($paciente->situacao === '6'){
          array_push($situacao_array, 'Monitoramento encerrado GRAVE - segue apenas com psicólogos');
        }
        if($paciente->situacao === '7'){
          array_push($situacao_array, 'Monitoramento encerrado LEVE - segue apenas com psicólogos');
        }
        if($paciente->situacao === '8'){
          array_push($situacao_array, 'Monitoramento encerrado contato - segue apenas com psicólogos');
        }
        if($paciente->situacao === '9'){
          array_push($situacao_array, 'Monitoramento encerrado outros - segue apenas com psicólogos');
        }
        if($paciente->situacao === '10'){
          array_push($situacao_array, 'Caso finalizado GRAVE');
        }
        if($paciente->situacao === '11'){
          array_push($situacao_array, 'Caso finalizado LEVE');
        }
        if($paciente->situacao === '12'){
          array_push($situacao_array, 'Contato com caso confirmado - finalizado');
        }
        if($paciente->situacao === '13'){
          array_push($situacao_array, 'Outras situações (sem relação com COVID-19) - finalizado');
        }
        if($paciente->situacao === '14'){
          array_push($situacao_array, 'Exclusivo psicologia - finalizado');
        }

        //CALCULA A IDADE DO PACIENTE
        if( $paciente->data_nascimento ){
          $age = $this->ageCalc($paciente->data_nascimento);
        } else {
          $age = '';
        }

        //CLASSIFICA POR RENDA
        if( $paciente->renda_residencia ){
          $renda = $paciente->renda_residencia;
          $renda_replace = str_replace('.','',$renda);
          $classe = $this->incomeClass($renda_replace);
        } else {
          $classe = '';
        }

        //CALCULA A RENDA PER CAPTA
        if( $paciente->renda_residencia && $paciente->numero_pessoas_residencia ){
          $renda = $paciente->renda_residencia;
          $renda_replace = str_replace('.','',$renda);
          $perCapta = $this->perCapitaIncome($renda_replace, $paciente->numero_pessoas_residencia);
        } else {
          $perCapta = 'Dados insuficientes';
        }

        //CLASSIFICA POR RENDA PER-CAPTA
        if( $paciente->renda_residencia && $paciente->numero_pessoas_residencia ){
          $percapta_replace = str_replace('.','',$perCapta);
          $classe_percapta = $this->incomeClass($percapta_replace);
        } else {
          $classe_percapta = 'Dados insuficientes';
        }

        //CALCULA A FAIXA ETÁRIA
        if( $age ){
          $age_range = $this->ageRange($age);
        } else {
          $age_range = '';
        };

        //DETERMINA A RAÇA (PARDA & PRETA = NEGRA)
        if( $paciente->cor_raca === 'Preta' || $paciente->cor_raca === 'Parda' ){
          $raca_cor = 'Negra';
        } else {
          $raca_cor = $paciente->cor_raca;
        };

        //CALCULA O TOTAL DE DIAS DE MONITORAMENTO
        if( $paciente->data_inicio_monitoramento && $paciente->data_finalizacao_caso ){
          $monitoring_days = $this->monitoringDays($paciente->data_inicio_monitoramento, $paciente->data_finalizacao_caso);
        } else {
          $monitoring_days = '';
        }

        if( $paciente->acompanhamento_psicologico ){
          $acompanhamento = @unserialize($paciente->acompanhamento_psicologico);
          in_array('individual', $acompanhamento) ? $acompanhamento_individual = 'Sim' : $acompanhamento_individual = 'Não';
          in_array('em grupo', $acompanhamento) ? $acompanhamento_grupo = 'Sim' : $acompanhamento_grupo = 'Não';
        } else {
          $acompanhamento_individual = '';
          $acompanhamento_grupo = '';
        };

        if( $paciente->teste_utilizado ){
          $teste = @unserialize($paciente->teste_utilizado);
          if($teste === false){
            $paciente->teste_utilizado === 'PCR' ? $pcr = 'Sim' : $pcr = 'Não';
            $paciente->teste_utilizado === 'sorologias (IgM/IgG)' ? $sorologias = 'Sim' : $sorologias = 'Não';
            $paciente->teste_utilizado ===  'teste rápido' ? $teste_rapido = 'Sim' : $teste_rapido = 'Não';
            $paciente->teste_utilizado === 'não informado' ? $nao_informado = 'Sim' : $nao_informado = 'Não';
          } else {
            in_array('PCR', $teste) ? $pcr = 'Sim' : $pcr = 'Não';
            in_array('sorologias (IgM/IgG)', $teste) ? $sorologias = 'Sim' : $sorologias = 'Não';
            in_array('teste rápido', $teste) ? $teste_rapido = 'Sim' : $teste_rapido = 'Não';
            in_array('não informado', $teste) ? $nao_informado = 'Sim' : $nao_informado = 'Não';
          }
        } else {
          $pcr = '';
          $sorologias = '';
          $teste_rapido = '';
          $nao_informado = '';
        };

        if( $paciente->resultado_teste ){
          $resultado = @unserialize($paciente->resultado_teste);
          if( $resultado === false ){
            $paciente->resultado_teste === 'PCR positivo' ? $pcr_positivo = 'Sim' : $pcr_positivo = 'Não';
            $paciente->resultado_teste === 'PCR negativo' ? $pcr_negativo = 'Sim' : $pcr_negativo = 'Não';
            $paciente->resultado_teste === 'IgM positivo' ? $igm_positivo = 'Sim' : $igm_positivo = 'Não';
            $paciente->resultado_teste === 'IgM negativo' ? $igm_negativo = 'Sim' : $igm_negativo = 'Não';
            $paciente->resultado_teste === 'IgG positivo' ? $igg_positivo = 'Sim' : $igg_positivo = 'Não';
            $paciente->resultado_teste === 'IgG negativo' ? $igg_negativo = 'Sim' : $igg_negativo = 'Não';
          } else {
            in_array('PCR positivo', $resultado) ? $pcr_positivo = 'Sim' : $pcr_positivo = 'Não';
            in_array('PCR negativo', $resultado) ? $pcr_negativo = 'Sim' : $pcr_negativo = 'Não';
            in_array('IgM positivo', $resultado) ? $igm_positivo = 'Sim' : $igm_positivo = 'Não';
            in_array('IgM negativo', $resultado) ? $igm_negativo = 'Sim' : $igm_negativo = 'Não';
            in_array('IgG positivo', $resultado) ? $igg_positivo = 'Sim' : $igg_positivo = 'Não';
            in_array('IgG negativo', $resultado) ? $igg_negativo = 'Sim' : $igg_negativo = 'Não';
          }
        } else {
          $pcr_positivo = '';
          $pcr_negativo = '';
          $igm_positivo = '';
          $igm_negativo = '';
          $igg_positivo = '';
          $igg_negativo = '';
        };

        $sistema_saude = $paciente->sistema_saude ? unserialize($paciente->sistema_saude) : [];
        in_array('É usuária/o do SUS (público)', $sistema_saude) ? $sus_publico = 'Sim' : $sus_publico = 'Não';
        in_array('Tem convênio/plano de saúde', $sistema_saude) ? $convenio_plano_saude = 'Sim' : $convenio_plano_saude = 'Não';
        in_array("Usuária/o de serviços pagos 'populares' (Ex: Dr Consulta)", $sistema_saude) ? $pagos_populares = 'Sim' : $pagos_populares = 'Não';
        in_array('Usuária/o de serviços particulares não cobertos por convênios', $sistema_saude) ? $nao_cobertos_convenios = 'Sim' : $nao_cobertos_convenios = 'Não';

        array_push($pacientes_array, [
          'Nome' => $paciente->user->name,
          'Nome social' => $paciente->name_social ? $paciente->name_social : '',
          'Tel. fixo' => $paciente->fone_fixo ? $paciente->fone_fixo : '',
          'Tel. celular' => $paciente->fone_celular ? $paciente->fone_celular : '',
          'Data nascimento' => $paciente->data_nascimento ? $paciente->data_nascimento : '',
          'Idade' => $age,
          'Faixa Etária' => $age_range,
          'Responsável residência' => $paciente->responsavel_residencia ? $paciente->responsavel_residencia : '',
          'Email' => $paciente->user->email ? $paciente->user->email : '',
          'CEP' => $paciente->endereco_cep ? $paciente->endereco_cep : '',
          'Rua' => $paciente->endereco_rua ? $paciente->endereco_rua : '',
          'Número' => $paciente->endereco_numero ? $paciente->endereco_numero : '',
          'Complemento' => $paciente->endereco_complemento ? $paciente->endereco_complemento : '',
          'Bairro' => $paciente->endereco_bairro ? $paciente->endereco_bairro : '',
          'Cidade' => $paciente->endereco_cidade ? $paciente->endereco_cidade : '',
          'UF' => $paciente->endereco_uf ? $paciente->endereco_uf : '',
          'Ponto referência' => $paciente->ponto_referencia ? $paciente->ponto_referencia : '',
          'Identidade gênero' => $paciente->identidade_genero ? $paciente->identidade_genero : '',
          'Orientação sexual' => $paciente->orientacao_sexual ? $paciente->orientacao_sexual : '',
          'Cor/Raça' => $raca_cor ? $raca_cor : '',
          'Nº pessoas residência' => $paciente->numero_pessoas_residencia ? $paciente->numero_pessoas_residencia : '',
          'Auxílio emergencial' => $paciente->auxilio_emergencial ? $paciente->auxilio_emergencial : '',
          'Renda residência' => $paciente->renda_residencia ? $paciente->renda_residencia : '',
          'Classe Social' => $classe,
          'Renda per capta' => $perCapta,
          'Classe Social (Renda Per Capta)' => $classe_percapta,
          'Como chegou ao projeto' => $paciente->como_chegou_ao_projeto ? $paciente->como_chegou_ao_projeto : '',
          'Núcleo UNEAFRO qual?' => $paciente->nucleo_uneafro_qual ? $paciente->nucleo_uneafro_qual : '',
          'Como chegou ao projeto outro' => $paciente->como_chegou_ao_projeto_outro ? $paciente->como_chegou_ao_projeto_outro : '',
          'Data início sintoma' => $paciente->data_inicio_sintoma ? $paciente->data_inicio_sintoma : '',
          'Data início monitoramento' => $paciente->data_inicio_monitoramento ? $paciente->data_inicio_monitoramento : '',
          'Data finalização caso' => $paciente->data_finalizacao_caso ? $paciente->data_finalizacao_caso : '',
          'Total dias monitoramento' => $monitoring_days,
          'Situação' => implode(', ', $situacao_array),
          'Agente' => $paciente->agente ? $paciente->agente->user->name : '',
          'Médico' => $paciente->medico ? $paciente->medico->user->name : '',
          'Articuladora' => $paciente->articuladora_responsavel ? Articuladora::where('id', $paciente->articuladora_responsavel)->first()->name : '',
          'Psicólogo' => $paciente->psicologo ? $paciente->psicologo->user->name : '',
          'Data início ac. psicológico' => $paciente->data_inicio_ac_psicologico ? $paciente->data_inicio_ac_psicologico : '',
          'Data encerramento ac. psicológico' => $paciente->data_encerramento_ac_psicologico ? $paciente->data_encerramento_ac_psicologico : '',
          'Acomp. psicol. individual' => $acompanhamento_individual,
          'Acomp. psicol. em grupo' => $acompanhamento_grupo,
          'At. semanal psicol.' => $paciente->atendimento_semanal_psicologia ? $paciente->atendimento_semanal_psicologia : '',
          'Hor. at. psicol.' => $paciente->horario_at_psicologia ? $paciente->horario_at_psicologia : '',
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

          'Tuberculose' => $paciente->tuberculose ? $paciente->tuberculose : '',
          'Tabagista' => $paciente->tabagista ? $paciente->tabagista : '',
          'Alcool crônico' => $paciente->cronico_alcool ? $paciente->cronico_alcool : '',
          'Outras drogas' => $paciente->outras_drogas ? $paciente->outras_drogas : '',
          'Gestante' => $paciente->gestante ? $paciente->gestante : '',
          'Pós parto' => $paciente->pos_parto ? $paciente->pos_parto : '',
          'Amamenta' => $paciente->amamenta ? $paciente->amamenta : '',
          'Gestação alto risco' => $paciente->gestacao_alto_risco ? $paciente->gestacao_alto_risco : '',
          'Motivo risco gravidez' => $paciente->motivo_risco_gravidez ? $paciente->motivo_risco_gravidez : '',
          'Data parto' => $paciente->data_parto ? $paciente->data_parto : '',
          'Data última mestruação' => $paciente->data_ultima_mestrucao ? $paciente->data_ultima_mestrucao : '',
          'Trimestre gestacao' => $paciente->trimestre_gestacao ? $paciente->trimestre_gestacao : '',
          'Acompanhamento médico' => $paciente->acompanhamento_medico ? $paciente->acompanhamento_medico : '',
          'Data última consulta' => $paciente->data_ultima_consulta ? $paciente->data_ultima_consulta : '',

          'sus_publico' => $sus_publico,
          'convenio_plano_saude' => $convenio_plano_saude,
          'pagos_populares' => $pagos_populares,
          'nao_cobertos_convenios' => $nao_cobertos_convenios,

          // INFOS A SEREM VERIFICADAS ONDE ESTARÃO INSERIDAS - INICIO
          /*'Remédios consumidos' => $paciente->remedios_consumidos ? $paciente->remedios_consumidos : '',
          'Isolamento residencial' => $paciente->isolamento_residencial ? $paciente->isolamento_residencial : '',
          'Alimentacao disponível' => $paciente->alimentacao_disponivel ? $paciente->alimentacao_disponivel : '',
          'Auxílio terceiros' => $paciente->auxilio_terceiros ? $paciente->auxilio_terceiros : '',
          'Tarefas autocuidado' => $paciente->tarefas_autocuidado ? $paciente->tarefas_autocuidado : '',
          'Data teste confirmatório' => $paciente->data_teste_confirmatorio ? $paciente->data_teste_confirmatorio : '',
          'Descrição doenças' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',
          'Acompanhamento UBS' => $paciente->acompanhamento_ubs ? $paciente->acompanhamento_ubs : '',*/
          // INFOS A SEREM VERIFICADAS ONDE ESTARÃO INSERIDAS - FIM
        ]);
      }

      return [$pacientes_array];
    }

}
