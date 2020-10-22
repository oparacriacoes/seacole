<?php

namespace App\Exports;

use App\Paciente;
use App\Articuladora;
use App\QuadroAtual;
use App\SaudeMental;
use App\ServicoInternacao;
use App\InsumosOferecido;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PacientesExport implements FromArray, WithHeadings, WithTitle, WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [
          new PacientesExport(),
          new EvolucaoSintomaExport(),
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

          'DIAGNÓSTICO DE COVID-19',
          'Data do teste confirmatório',
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

          'Já teve tuberculose?',
          'É tabagista?',
          'Faz uso crônico de alcool?',
          'Faz uso crônico de outras drogas?',

          'Toma remédio(s) de uso contínuo? Qual(is)?',

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

          //'QUADRO ATUAL'
          'Primeiros sintomas',
          'SINTOMAS MANIFESTADOS - Tosse',
          'SINTOMAS MANIFESTADOS - Falta de ar',
          'SINTOMAS MANIFESTADOS - Febre',
          'SINTOMAS MANIFESTADOS - Dor de cabeça',
          'SINTOMAS MANIFESTADOS - Perda de olfato',
          'SINTOMAS MANIFESTADOS Perda de paladar',
          'SINTOMAS MANIFESTADOS Enjoo ou vomitos',
          'SINTOMAS MANIFESTADOS Diarreia',
          'SINTOMAS MANIFESTADOS Aumento da pressão',
          'SINTOMAS MANIFESTADOS Queda brusca da pressão',
          'SINTOMAS MANIFESTADOS Dor torácica (dor no peito)',
          'SINTOMAS MANIFESTADOS Sonolência ou cansaço importantes',
          'SINTOMAS MANIFESTADOS Confusão mental',
          'SINTOMAS MANIFESTADOS Desmaio',
          'SINTOMAS MANIFESTADOS Convulsão',
          'SINTOMAS MANIFESTADOS Outros',
          'Temperatura máxima (em graus)',
          'Data temperatura máxima',
          'Saturação mais baixa registrada (%)',
          'Data da saturação mais baixa',
          'Frequência respiratória máxima',
          'Data da Frequência respiratória máxima',

          //'DESFECHO e SEQUELAS'
          'DESFECHO:',
          'SEQUELAS: perda persistente de olfato',
          'SEQUELAS: perda persistente de paladar',
          'SEQUELAS: tosse persistente',
          'SEQUELAS: falta de ar persistente',
          'SEQUELAS: dor de cabeça persistente',
          'SEQUELAS: eventos tromboliticos',
          'SEQUELAS: danos renais',
          'SEQUELAS: outros',
          'SEQUELAS: outros QUAIS?',
          'Algo mais que queira descrever sobre o caso?',

          //'SAÚDE MENTAL'
          'Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?',
          'Escreva sobre o estado emocional e detalhe os medos',

          //'SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO'
          'A pessoa precisou ir a algum serviço de saúde? UBS (Unidade Básica de Saúde - posto de saúde)',
          'A pessoa precisou ir a algum serviço de saúde? UPA (Unidade de Pronto Atendimento)',
          'A pessoa precisou ir a algum serviço de saúde? AMA',
          'A pessoa precisou ir a algum serviço de saúde? Hospital Público',
          'A pessoa precisou ir a algum serviço de saúde? Hospital Privado',
          'A pessoa precisou ir a algum serviço de saúde? OUTRO',
          'Quantas idas a serviços de saúde?',
          'Data da última ida a serviço de saúde',
          'Recebeu medicações para tratar COVID-19? Azitromicina',
          'Recebeu medicações para tratar COVID-19? Outro antibiótico',
          'Recebeu medicações para tratar COVID-19? Ivermectina',
          'Recebeu medicações para tratar COVID-19? Cloroquina/Hidroxicloroquina',
          'Recebeu medicações para tratar COVID-19? Oseltamivir (tamiflu)',
          'Recebeu medicações para tratar COVID-19? Algum antialérgico',
          'Recebeu medicações para tratar COVID-19? Algum corticóide',
          'Recebeu medicações para tratar COVID-19? Algum antiinflamatoŕio',
          'Recebeu medicações para tratar COVID-19? Vitamina D',
          'Recebeu medicações para tratar COVID-19? Zinco',
          'Recebeu medicações para tratar COVID-19? Outro medicamento',
          'Escreva o nome do medicamento prescrito',
          'A pessoa teve algum problema com serviços de referência? UBS (Unidade Básica de Saúde - posto de saúde)',
          'A pessoa teve algum problema com serviços de referência? UPA (Unidade de Pronto Atendimento)',
          'A pessoa teve algum problema com serviços de referência? AMA',
          'A pessoa teve algum problema com serviços de referência? Hospital Público',
          'A pessoa teve algum problema com serviços de referência? Hospital Privado',
          'A pessoa teve algum problema com serviços de referência? OUTRO',
          'Descreva o problema',
          'Precisou de internação pelo quadro (suspeito ou confirmado)?',
          'Precisou de ambulância financiada pelo projeto?',
          'LOCAL DE INTERNAÇÃO Hospital público de referência',
          'LOCAL DE INTERNAÇÃO Hospital de campanha',
          'LOCAL DE INTERNAÇÃO Hospital particular de referência',
          'LOCAL DE INTERNAÇÃO Hospital municipal do Ipiranga (encaminhado pelo projeto)',
          'LOCAL DE INTERNAÇÃO Hospital privado financiado pelo projeto',
          'Nome do Hospital de internação',
          'Data de entrada da internação',
          'Data da alta hospitalar',
          'Tempo de internação (data da alta - data da entrada da internação)',

          //'INSUMOS OFERECIDOS PELO PROJETO'
          'Há condição de ficar isolada, sozinha, em um cômodo da casa?',
          'Tem comida disponível, sem precisar sair?',
          'Tem alguém para auxiliá-lo(a)?',
          'Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)',
          'Precisa de algum tipo de ajuda? Comprar remédios de uso contínuo',
          'Precisa de algum tipo de ajuda? Comprar remédios para o tratamento do quadro atual',
          'Precisa de algum tipo de ajuda? Comprar alimento ou outro produtos de necessidade básica',
          'Precisa de algum tipo de ajuda? Outros',
          'Tratamento foi prescrito por algum médico do projeto?',
          'Tratamento financiado - Alopático  (medicamentos convencionais)',
          'Tratamento financiado - PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)',
          'Foi entregue: Cartilha de cuidados',
          'Foi entregue: Termômetro',
          'Foi entregue: Dipirona',
          'Foi entregue: Paracetamol',
          'Foi entregue: Oxímetro',
          'Foi entregue: Máscaras de tecido',
          'Foi entregue: Máscaras de limpeza',
          'Foi entregue: Cesta básica',
          'Se o caso já tiver sido encerrado: oxímetro foi devolvido?',

          //MONITORAMENTOS
          'Monitoramento ID',
          'Data do monitoramento',
          'QUANTOS DIAS DE SINTOMAS?',
          'Horário do monitoramento',
          'Sintomas atuais: Tosse',
          'Sintomas atuais: Falta de ar',
          'Sintomas atuais: Febre',
          'Sintomas atuais: Dor de cabeça',
          'Sintomas atuais: Perda de olfato',
          'Sintomas atuais: Perda de paladar',
          'Sintomas atuais: outros',
          'Sintomas atuais: Outros DESCREVA',
          'Temperatura atual (em graus)',
          'Saturação atual (%)',
          'Frequência respiratória atual',
          'Frequência cardíaca atual',
          'Pressão Arterial Atual',
          'Algum sinal de gravidade nesse monitoramento?',
          'Equipe médica do projeto prescreveu algum medicamento?',
          'Medicamento prescrito pela equipe médica do projeto',
          'Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?',
          'Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)',
          'Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)',
          'Fez inalação ou vaporização?',
          'Sentiu melhora dos sintomas com inalação ou vaporização',

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

        $raca_cor_1 = $paciente->cor_raca;

        //CALCULA O TOTAL DE DIAS DE MONITORAMENTO
        if( $paciente->data_inicio_monitoramento && $paciente->data_finalizacao_caso ){
          $monitoring_days = $this->monitoringDays($paciente->data_inicio_monitoramento, $paciente->data_finalizacao_caso);
        } else {
          $monitoring_days = 'Dados insuficientes';
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

        $quadro = QuadroAtual::where('paciente_id', $paciente->id)->first();
        $sintomas_manifestados = @unserialize($quadro->sintomas_manifestados);
        if( $sintomas_manifestados === false ){
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
          in_array('falta de ar', $sintomas_manifestados) ? $falta_de_ar = 'Sim' : $falta_de_ar = 'Não';
          in_array('febre', $sintomas_manifestados) ? $febre = 'Sim' : $febre = 'Não';
          in_array('dor de cabeça', $sintomas_manifestados) ? $dor_de_cabeca = 'Sim' : $dor_de_cabeca = 'Não';
          in_array('perda de olfato', $sintomas_manifestados) ? $perda_de_olfato = 'Sim' : $perda_de_olfato = 'Não';
          in_array('perda do paladar', $sintomas_manifestados) ? $perda_de_paladar = 'Sim' : $perda_de_paladar = 'Não';
          in_array('enjoo', $sintomas_manifestados) ? $enjoo_vomitos = 'Sim' : $enjoo_vomitos = 'Não';
          in_array('diarreia', $sintomas_manifestados) ? $diarreia = 'Sim' : $diarreia = 'Não';
          in_array('aumento da pressão', $sintomas_manifestados) ? $aumento_pressao = 'Sim' : $aumento_pressao = 'Não';
          in_array('queda brusca de Pressão', $sintomas_manifestados) ? $queda_pressao = 'Sim' : $queda_pressao = 'Não';
          in_array('pressão baixa', $sintomas_manifestados) ? $dor_toracica = 'Sim' : $dor_toracica = 'Não';
          in_array('sonolência ou cansaço importantes', $sintomas_manifestados) ? $sonolencia_cansaco = 'Sim' : $sonolencia_cansaco = 'Não';
          in_array('confusão mental', $sintomas_manifestados) ? $confusao_mental = 'Sim' : $confusao_mental = 'Não';
          in_array('desmaio', $sintomas_manifestados) ? $desmaio = 'Sim' : $desmaio = 'Não';
          in_array('convulsao', $sintomas_manifestados) ? $convulsao = 'Sim' : $convulsao = 'Não';
          in_array('outros', $sintomas_manifestados) ? $outros_sintomas = 'Sim' : $outros_sintomas = 'Não';
        }
        $sequelas = @unserialize($quadro->sequelas);
        if( $sequelas === false ){
          $perda_persistente_olfato = '';
          $perda_persistente_paladar = '';
          $tosse_persistente = '';
          $falta_ar_persistente = '';
          $dor_cabeca_persistente = '';
          $eventos_tromboliticos = '';
          $danos_renais = '';
          $sequelas_outros = '';
        } else {
          in_array('perda persistente de olfato', $sequelas) ? $perda_persistente_olfato = 'Sim' : $perda_persistente_olfato = 'Não';
          in_array('perda persistente de paladar', $sequelas) ? $perda_persistente_paladar = 'Sim' : $perda_persistente_paladar = 'Não';
          in_array('tosse persistente', $sequelas) ? $tosse_persistente = 'Sim' : $tosse_persistente = 'Não';
          in_array('falta de ar persistente', $sequelas) ? $falta_ar_persistente = 'Sim' : $falta_ar_persistente = 'Não';
          in_array('dor de cabeça persistente', $sequelas) ? $dor_cabeca_persistente = 'Sim' : $dor_cabeca_persistente = 'Não';
          in_array('eventos tromboliticos', $sequelas) ? $eventos_tromboliticos = 'Sim' : $eventos_tromboliticos = 'Não';
          in_array('danos renais', $sequelas) ? $danos_renais = 'Sim' : $danos_renais = 'Não';
          in_array('outros: quais?', $sequelas) ? $sequelas_outros = 'Sim' : $sequelas_outros = 'Não';
        }

        $saude_mental = SaudeMental::where('paciente_id', $paciente->id)->first();

        $internacao = ServicoInternacao::where('paciente_id', $paciente->id)->first();
        $precisou_servico = @unserialize($internacao->precisou_servico);
        if( $precisou_servico === false ){
          $ubs_posto_de_saude = '';
          $upa = '';
          $ama = '';
          $hospital_publico = '';
          $hospital_privado = '';
        } else {
          in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $precisou_servico) ? $ubs_posto_de_saude = 'Sim' : $ubs_posto_de_saude = 'Não';
          in_array('UPA (Unidade de Pronto Atendimento)', $precisou_servico) ? $upa = 'Sim' : $upa = 'Não';
          in_array('ama', $precisou_servico) ? $ama = 'Sim' : $ama = 'Não';
          in_array('Hospital público', $precisou_servico) ? $hospital_publico = 'Sim' : $hospital_publico = 'Não';
          in_array('hospital privado', $precisou_servico) ? $hospital_privado = 'Sim' : $hospital_privado = 'Não';
        }
        $recebeu_medicacao = @unserialize($internacao->recebeu_med_covid);
        if( $recebeu_medicacao === false ){
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
          in_array('Azitromicina', $recebeu_medicacao) ? $azitromicina = 'Sim' : $azitromicina = 'Não' ;
          in_array('outro antibiótico', $recebeu_medicacao) ? $outro_antibiotico = 'Sim' : $outro_antibiotico = 'Não' ;
          in_array('ivermectina', $recebeu_medicacao) ? $ivermectina = 'Sim' : $ivermectina = 'Não' ;
          in_array('cloroquina/hidroxicloroquina', $recebeu_medicacao) ? $cloroquina_hidroxicloroquina = 'Sim' : $cloroquina_hidroxicloroquina = 'Não' ;
          in_array('oseltamivir (tamiflu)', $recebeu_medicacao) ? $oseltamivir = 'Sim' : $oseltamivir = 'Não' ;
          in_array('algum antialérgico', $recebeu_medicacao) ? $algum_antialergico = 'Sim' : $algum_antialergico = 'Não' ;
          in_array('algum corticóide', $recebeu_medicacao) ? $algum_corticoide = 'Sim' : $algum_corticoide = 'Não' ;
          in_array('algum antiinflamatório', $recebeu_medicacao) ? $algum_antiinflamatorio = 'Sim' : $algum_antiinflamatorio = 'Não' ;
          in_array('vitamina D', $recebeu_medicacao) ? $vitamina_d = 'Sim' : $vitamina_d = 'Não' ;
          in_array('zinco', $recebeu_medicacao) ? $zinco = 'Sim' : $zinco = 'Não' ;
          in_array('outro medicamento', $recebeu_medicacao) ? $outro_medicamento = 'Sim' : $outro_medicamento = 'Não' ;
        }
        $problema_internacao = @unserialize($internacao->teve_algum_problema);
        if( $problema_internacao === false ){
          $problema_ubs = '';
          $problema_upa = '';
          $problema_ama = '';
          $problema_hospital_publico = '';
          $problema_hospital_privado = '';
          $problema_outro = '';
        } else {
          in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $problema_internacao) ? $problema_ubs = 'Sim' : $problema_ubs = 'Não';
          in_array('UPA (Unidade de Pronto Atendimento)', $problema_internacao) ? $problema_upa = 'Sim' : $problema_upa = 'Não';
          in_array('ama', $problema_internacao) ? $problema_ama = 'Sim' : $problema_ama = 'Não';
          in_array('Hospital público', $problema_internacao) ? $problema_hospital_publico = 'Sim' : $problema_hospital_publico = 'Não';
          in_array('Hospital privado', $problema_internacao) ? $problema_hospital_privado = 'Sim' : $problema_hospital_privado = 'Não';
          in_array('Outro (qual?)', $problema_internacao) ? $problema_outro = 'Sim' : $problema_outro = 'Não';
        }
        $local_internacao = @unserialize($internacao->local_internacao);
        if( $local_internacao === false ){
          $hospital_publico_referencia = '';
          $hospital_campanha = '';
          $hospital_particular_referencia = '';
          $hospital_ipiranga = '';
          $hospital_financiado_projeto = '';
        } else {
          in_array('Hospital público de referência', $local_internacao) ? $hospital_publico_referencia = 'Sim' : $hospital_publico_referencia = 'Não';
          in_array('Hospital de campanha', $local_internacao) ? $hospital_campanha = 'Sim' : $hospital_campanha = 'Não';
          in_array('Hospital particular de referência', $local_internacao) ? $hospital_particular_referencia = 'Sim' : $hospital_particular_referencia = 'Não';
          in_array('Hospital municipal do Ipiranga (encaminhado pelo projeto)', $local_internacao) ? $hospital_ipiranga = 'Sim' : $hospital_ipiranga = 'Não';
          in_array('Hospital privado financiado pelo projeto', $local_internacao) ? $hospital_financiado_projeto = 'Sim' : $hospital_financiado_projeto = 'Não';
        }
        if( $internacao && $internacao->data_entrada_internacao && $internacao->data_alta_hospitalar ){
          $tempo_internacao = $this->monitoringDays($internacao->data_entrada_internacao, $internacao->data_alta_hospitalar);
        } else {
          $tempo_internacao = 'Dados insuficientes';
        }

        $insumos_oferecidos = InsumosOferecido::where('paciente_id', $paciente->id)->first();
        $precisa_ajuda = @unserialize($insumos_oferecidos->precisa_tipo_ajuda);
        if( $precisa_ajuda === false ){
          $precisa_ajuda === 'Comprar remédios de uso contínuo' ? $remedios_uso_continuo = 'Sim' : $remedios_uso_continuo = 'Não';
          $precisa_ajuda === 'Comprar remédios para o tratamento do quadro atual' ? $remedios_tratamento_quadro_atual = 'Sim' : $remedios_tratamento_quadro_atual = 'Não';
          $precisa_ajuda === 'Comprar alimento ou outro produtos de necessidade básica' ? $produtos_necessidade_basica = 'Sim' : $produtos_necessidade_basica = 'Não';
          $precisa_ajuda === 'Outros' ? $ajuda_outros = 'Sim' : $ajuda_outros = 'Não';
        } else {
          $precisa_ajuda && in_array('Comprar remédios de uso contínuo', $precisa_ajuda) ? $remedios_uso_continuo = 'Sim' : $remedios_uso_continuo = 'Não';
          $precisa_ajuda && in_array('Comprar remédios para o tratamento do quadro atual', $precisa_ajuda) ? $remedios_tratamento_quadro_atual = 'Sim' : $remedios_tratamento_quadro_atual = 'Não';
          $precisa_ajuda && in_array('Comprar alimento ou outro produtos de necessidade básica', $precisa_ajuda) ? $produtos_necessidade_basica = 'Sim' : $produtos_necessidade_basica = 'Não';
          $precisa_ajuda && in_array('Outros', $precisa_ajuda) ? $ajuda_outros = 'Sim' : $ajuda_outros = 'Não';
        }
        $tratamento_financiado = @unserialize($insumos_oferecidos->tratamento_financiado);
        if( $tratamento_financiado === false ){
          $tratamento_financiado === 'Alopático (medicamentos convencionais)' ? $tratamento_financiado_alopatico = 'Sim' : $tratamento_financiado_alopatico = 'Não';
          $tratamento_financiado === 'PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)' ? $tratamento_financiado_pics = 'Sim' : $tratamento_financiado_pics = 'Não';
        } else {
          $tratamento_financiado && in_array('Alopático (medicamentos convencionais)', $tratamento_financiado) ? $tratamento_financiado_alopatico = 'Sim' : $tratamento_financiado_alopatico = 'Não';
          $tratamento_financiado && in_array('PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)', $tratamento_financiado) ? $tratamento_financiado_pics = 'Sim' : $tratamento_financiado_pics = 'Não';
        }
        $material_entregue = @unserialize($insumos_oferecidos->material_entregue);
        if( $material_entregue === false ){
          $material_entregue === 'Cartilha de cuidados' ? $cartilha_cuidados = 'Sim' : $cartilha_cuidados = 'Não';
          $material_entregue === 'Termometro' ? $termometro = 'Sim' : $termometro = 'Não';
          $material_entregue === 'Dipirona' ? $dipirona = 'Sim' : $dipirona = 'Não';
          $material_entregue === 'Paracetamol' ? $paracetamol = 'Sim' : $paracetamol = 'Não';
          $material_entregue === 'Oximetro' ? $oximetro = 'Sim' : $oximetro = 'Não';
          $material_entregue === 'Mascaras de tecido' ? $mascaras_tecido = 'Sim' : $mascaras_tecido = 'Não';
          $material_entregue === 'Material de limpeza' ? $mascaras_limpeza = 'Sim' : $mascaras_limpeza = 'Não';
          $material_entregue === 'Cesta basica' ? $cesta_basica = 'Sim' : $cesta_basica = 'Não';
        } else {
          in_array('Cartilha de cuidados', $material_entregue) ? $cartilha_cuidados = 'Sim' : $cartilha_cuidados = 'Não';
          in_array('Termometro', $material_entregue) ? $termometro = 'Sim' : $termometro = 'Não';
          in_array('Dipirona', $material_entregue) ? $dipirona = 'Sim' : $dipirona = 'Não';
          in_array('Paracetamol', $material_entregue) ? $paracetamol = 'Sim' : $paracetamol = 'Não';
          in_array('Oximetro', $material_entregue) ? $oximetro = 'Sim' : $oximetro = 'Não';
          in_array('Mascaras de tecido', $material_entregue) ? $mascaras_tecido = 'Sim' : $mascaras_tecido = 'Não';
          in_array('Material de limpeza', $material_entregue) ? $mascaras_limpeza = 'Sim' : $mascaras_limpeza = 'Não';
          in_array('Cesta basica', $material_entregue) ? $cesta_basica = 'Sim' : $cesta_basica = 'Não';
        }

        $monitoramentos = $paciente->dados;
        foreach( $monitoramentos as $monitoramento ){
          $monitoramento_id = $monitoramento->id;
        }
        //dd($monitoramentos);
        /*$monitoramentos = EvolucaoSintoma::where('paciente_id', $paciente->id)->get();
        foreach($monitoramentos as $monitoramento){
          $monitoramento_id = $monitoramento->id;
          $monitoramento_data = $monitoramento->created_at;
          $monitoramento_dias = '';
          $monitoramento_horario = $monitoramento->horario_monotiramento;
          $monitoramento_sintomas = @unserialize($monitoramento->sintomas_atuais);
          $monitoramento_temperatura = $monitoramento->temperatura_atual;
          $monitoramento_saturacao = $monitoramento->saturacao_atual;
          $monitoramento_frequencia_respiratoria = $monitoramento->frequencia_respiratoria_atual;
          $monitoramento_frequencia_cardiaca = $monitoramento->frequencia_cardiaca_atual;
          $monitoramento_pressao_arterial = $monitoramento->pressao_arterial_atual;
          $monitoramento_sinal_gravidade = $monitoramento->algum_sinal;
          $monitoramento_equipe_prescreveu_medicamento = $monitoramento->equipe_medica;
          $monitoramento_medicamento_prescrito = $monitoramento->medicamento;
          $monitoramento_fez_pic = $monitoramento->fazendo_uso_pic;
          $monitoramento_fez_escaldapes = $monitoramento->fez_escalapes;
          $monitoramento_melhoras_escaldapes = $monitoramento->melhora_sintoma_escaldapes;
          $monitoramento_inalacao = $monitoramento->fes_inalacao;
          $monitoramento_melhoras_inalacao = $monitoramento->melhoria_sintomas_inalacao;
          if( $monitoramento_sintomas === false ){
            $monitoramento_sintomas_tosse = '';
            $monitoramento_sintomas_falta_de_ar = '';
            $monitoramento_sintomas_febre = '';
            $monitoramento_sintomas_dor_de_cabeca = '';
            $monitoramento_sintomas_perda_de_olfato = '';
            $monitoramento_sintomas_perda_de_paladar = '';
            $monitoramento_sintomas_outros = '';
          } else {
            in_array('tosse', $monitoramento_sintomas) ? $monitoramento_sintomas_tosse = 'Sim' : $monitoramento_sintomas_tosse = 'Não';
            in_array('falta de ar', $monitoramento_sintomas) ? $monitoramento_sintomas_falta_de_ar = 'Sim' : $monitoramento_sintomas_falta_de_ar = 'Não';
            in_array('febre', $monitoramento_sintomas) ? $monitoramento_sintomas_febre = 'Sim' : $monitoramento_sintomas_febre = 'Não';
            in_array('dor de cabeça', $monitoramento_sintomas) ? $monitoramento_sintomas_dor_de_cabeca = 'Sim' : $monitoramento_sintomas_dor_de_cabeca = 'Não';
            in_array('perda de olfato', $monitoramento_sintomas) ? $monitoramento_sintomas_perda_de_olfato = 'Sim' : $monitoramento_sintomas_perda_de_olfato = 'Não';
            in_array('perda do paladar', $monitoramento_sintomas) ? $monitoramento_sintomas_perda_de_paladar = 'Sim' : $monitoramento_sintomas_perda_de_paladar = 'Não';
            in_array('outros', $monitoramento_sintomas) ? $monitoramento_sintomas_outros = 'Sim' : $monitoramento_sintomas_outros = 'Não';
          }
        }*/

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
          'raca_cor' => $raca_cor ? $raca_cor : '',
          'raca_cor_1' => $raca_cor_1 ? $raca_cor_1 : '',
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
          'diagnostico_covid_19' => $paciente->sintomas_iniciais ? $paciente->sintomas_iniciais : '',
          'data_teste_confirmatorio' => $paciente->data_teste_confirmatorio ? $paciente->data_teste_confirmatorio : '',
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

          'tuberculose' => $paciente->tuberculose ? $paciente->tuberculose : '',
          'tabagista' => $paciente->tabagista ? $paciente->tabagista : '',
          'cronico_alcool' => $paciente->cronico_alcool ? $paciente->cronico_alcool : '',
          'outras_drogas' => $paciente->outras_drogas ? $paciente->outras_drogas : '',

          'toma_remedios_uso_continuo' => $paciente->remedios_consumidos ? $paciente->remedios_consumidos : '',

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
          'data_temperatura_maxima' => $quadro ? $quadro->data_temp_max : 'Não Informado',
          'saturacao_baixa' => $quadro ? $quadro->saturacao_baixa : 'Não Informado',
          'data_saturacao_baixa' => $quadro ? $quadro->data_sat_max : 'Não Informado',
          'frequencia_respiratoria' => $quadro ? $quadro->frequencia_max : 'Não Informado',
          'data_frequencia_respiratoria' => $quadro ? $quadro->data_freq_max : 'Não Informado',
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

          'intensifica_medos' => $saude_mental ? $saude_mental->quadro_atual : 'Não Informado',
          'detalhe_medos' => $saude_mental ? $saude_mental->detalhes_medos : 'Não Informado',

          'ubs_posto_de_saude' => $ubs_posto_de_saude,
          'upa' => $upa,
          'ama' => $ama,
          'hospital_publico' => $hospital_publico,
          'hospital_privado' => $hospital_privado,
          'precisou_servico_outro' => $internacao ? $internacao->precisou_servico_outro : '',
          'Quantas idas a serviços de saúde?' => $internacao ? $internacao->quant_ida_servico : '',
          'Data da última ida a serviço de saúde' => $internacao ? $internacao->data_ultima_ida_servico_de_saude : '',
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
          'precisou_internacao_quadro' => $internacao ? $internacao->precisou_internacao : '',
          'precisou_ambulancia' => $internacao ? $internacao->precisou_ambulancia : '',
          'hospital_publico_referencia' => $hospital_publico_referencia,
          'hospital_campanha' => $hospital_campanha,
          'hospital_particular_referencia' => $hospital_particular_referencia,
          'hospital_ipiranga' => $hospital_ipiranga,
          'hospital_financiado_projeto' => $hospital_financiado_projeto,
          'nome_hospital_internacao' => $internacao ? $internacao->nome_hospital : '',
          'data_entrada_internacao' => $internacao ? $internacao->data_entrada_internacao : '',
          'data_alta_hospitalar' => $internacao ? $internacao->data_alta_hospitalar : '',
          'tempo_internacao' => $tempo_internacao,

          'isolamento_residencial' => $insumos_oferecidos ? $insumos_oferecidos->condicao_ficar_isolada : '',
          'alimentacao_disponivel' => $insumos_oferecidos ? $insumos_oferecidos->tem_comida : '',
          'auxilio_terceiros' => $insumos_oferecidos ? $insumos_oferecidos->tem_alguem : '',
          'tarefas_autocuidado' => $insumos_oferecidos ? $insumos_oferecidos->tarefas_autocuidado : '',
          'remedios_uso_continuo' => $remedios_uso_continuo,
          'remedios_tratamento_quadro_atual' => $remedios_tratamento_quadro_atual,
          'produtos_necessidade_basica' => $produtos_necessidade_basica,
          'ajuda_outros' => $ajuda_outros,
          'Tratamento foi prescrito por algum médico do projeto?' => $insumos_oferecidos ? $insumos_oferecidos->tratamento_prescrito : '',
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
          'oximetro_devolvido' => $insumos_oferecidos ? $insumos_oferecidos->oximetro_devolvido : '',

          'monitoramento_id' => $monitoramento_id,
          /*'monitoramento_data' => $monitoramento_data,
          'monitoramento_dias' => $monitoramento_dias,
          'monitoramento_horario' => $monitoramento_horario,
          'Sintomas atuais: Tosse' => $monitoramento_sintomas_tosse,
          'Sintomas atuais: Falta de ar' => $monitoramento_sintomas_falta_de_ar,
          'Sintomas atuais: Febre' => $monitoramento_sintomas_febre,
          'Sintomas atuais: Dor de cabeça' => $monitoramento_sintomas_dor_de_cabeca,
          'Sintomas atuais: Perda de olfato' => $monitoramento_sintomas_perda_de_olfato,
          'Sintomas atuais: Perda de paladar' => $monitoramento_sintomas_perda_de_paladar,
          'Sintomas atuais: outros' => $monitoramento_sintomas_outros,
          'Sintomas atuais: Outros DESCREVA' => $monitoramento ? $monitoramento->sintomas_outro : '',
          'Temperatura atual (em graus)' => $monitoramento_temperatura,
          'Saturação atual (%)' => $monitoramento_saturacao,
          'Frequência respiratória atual' => $monitoramento_frequencia_respiratoria,
          'Frequência cardíaca atual' => $monitoramento_frequencia_cardiaca,
          'Pressão Arterial Atual' => $monitoramento_pressao_arterial,
          'Algum sinal de gravidade nesse monitoramento?' => $monitoramento_sinal_gravidade,
          'Equipe médica do projeto prescreveu algum medicamento?' => $monitoramento_equipe_prescreveu_medicamento,
          'Medicamento prescrito pela equipe médica do projeto' => $monitoramento_medicamento_prescrito,
          'Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?' => $monitoramento_fez_pic,
          'Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)' => $monitoramento_fez_escaldapes,
          'Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)' => $monitoramento_melhoras_escaldapes,
          'Fez inalação ou vaporização?' => $monitoramento_inalacao,
          'Sentiu melhora dos sintomas com inalação ou vaporização' => $monitoramento_melhoras_inalacao,*/

        ]);
      }

      return [$pacientes_array];
    }

}
