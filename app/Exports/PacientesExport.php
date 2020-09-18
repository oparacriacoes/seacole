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
          'Identidade gênero',
          'Orientação sexual',
          'Agente',
          'Médico',
          'Articuladora',
          'At. semanal psicol.',
          'Acompanhamento psicol.',
          'Hor. at. psicol.',
          'Como chegou ao projeto',
          'Núcleo UNEAFRO qual?',
          'Como chegou ao projeto outro',
          'Psicólogo',
          'Situação',
          'Data nascimento',
          'Idade',
          'Cor/Raça',
          'CEP',
          'Rua',
          'Número',
          'Bairro',
          'Cidade',
          'UF',
          'Ponto referência',
          'Complemento',
          'Tel. fixo',
          'Tel. celular',
          'Nº pessoas residência',
          'Responsável residência',
          'Renda residência',
          'Classe Social',
          'Renda per capta',
          'Doença crônica',
          'Descrição doenças crônicas',
          'Remédios consumidos',
          'Acompanhamento médico',
          'Isolamento residencial',
          'Alimentacao disponível',
          'Auxílio terceiros',
          'Tarefas autocuidado',
          'Teste utilizado',
          'Resultado teste',
          'Outras inf. sobre o teste',
          'Data teste confirmatório',
          'Data início sintoma',
          'Data início monitoramento',
          'Data início ac. psicológico',
          'Data encerramento ac. psicológico',
          'Data finalização caso',
          'Auxílio emergencial',
          'Descrição doenças',
          'Tuberculose',
          'Tabagista',
          'Alcool crônico',
          'Outras drogas',
          'Gestante',
          'Amamenta',
          'Gestação alto risco',
          'Pós parto',
          'Data parto',
          'Data última mestruação',
          'Trimestre gestacao',
          'Motivo risco gravidez',
          'Data última consulta',
          'Sistema saúde',
          'Acompanhamento UBS',
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

    public function array(): array
    {
      $pacientes = Paciente::get();
      $pacientes_array = [];

      foreach($pacientes as $paciente){

        $resultado_teste = @implode(', ', unserialize($paciente->resultado_teste));
        if( $resultado_teste === false ){
          $resultado_teste = $paciente->resultado_teste;
        }

        $teste_utilizado = @implode(', ', unserialize($paciente->teste_utilizado));
        if( $teste_utilizado === false ){
          $teste_utilizado = $paciente->teste_utilizado;
        }

        $doenca_cronica = [];
        $doenca = $paciente->doenca_cronica ? unserialize($paciente->doenca_cronica) : [];
        if(in_array('1', $doenca)){
          array_push($doenca_cronica, 'Hipertensão arterial sistêmica (HAS)');
        }
        if(in_array('2', $doenca)){
          array_push($doenca_cronica, 'Diabetes Mellitus (DM)');
        }
        if(in_array('3', $doenca)){
          array_push($doenca_cronica, 'Dislipidemia');
        }
        if(in_array('4', $doenca)){
          array_push($doenca_cronica, 'Asma / Bronquite');
        }
        if(in_array('5', $doenca)){
          array_push($doenca_cronica, 'Tuberculose ativa');
        }
        if(in_array('6', $doenca)){
          array_push($doenca_cronica, 'Cardiopatias e outras doenças cardiovasculares');
        }
        if(in_array('7', $doenca)){
          array_push($doenca_cronica, 'Outras doenças Respiratórias');
        }
        if(in_array('8', $doenca)){
          array_push($doenca_cronica, 'Artrite/Artrose/Reumatismo');
        }
        if(in_array('9', $doenca)){
          array_push($doenca_cronica, 'Doença autoimune');
        }
        if(in_array('10', $doenca)){
          array_push($doenca_cronica, 'Doença renal');
        }
        if(in_array('11', $doenca)){
          array_push($doenca_cronica, 'Doença neurológica');
        }
        if(in_array('12', $doenca)){
          array_push($doenca_cronica, 'Câncer');
        }
        if(in_array('13', $doenca)){
          array_push($doenca_cronica, 'Ansiedade');
        }
        if(in_array('14', $doenca)){
          array_push($doenca_cronica, 'Depressão');
        }
        if(in_array('15', $doenca)){
          array_push($doenca_cronica, 'Demência');
        }
        if(in_array('16', $doenca)){
          array_push($doenca_cronica, 'Outras questões de saúde mental');
        }

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

        array_push($pacientes_array, [
          'Nome' => $paciente->user->name,
          'Nome social' => $paciente->name_social ? $paciente->name_social : '',
          'Identidade gênero' => $paciente->identidade_genero ? $paciente->identidade_genero : '',
          'Orientação sexual' => $paciente->orientacao_sexual ? $paciente->orientacao_sexual : '',
          'Agente' => $paciente->agente ? $paciente->agente->user->name : '',
          'Médico' => $paciente->medico ? $paciente->medico->user->name : '',
          'Articuladora' => $paciente->articuladora_responsavel ? Articuladora::where('id', $paciente->articuladora_responsavel)->first()->name : '',
          'At. semanal psicol.' => $paciente->atendimento_semanal_psicologia ? $paciente->atendimento_semanal_psicologia : '',
          'Acompanhamento psicol.' => $paciente->acompanhamento_psicologico ? implode(', ', unserialize($paciente->acompanhamento_psicologico)) : '',
          'Hor. at. psicol.' => $paciente->horario_at_psicologia ? $paciente->horario_at_psicologia : '',
          'Como chegou ao projeto' => $paciente->como_chegou_ao_projeto ? $paciente->como_chegou_ao_projeto : '',
          'Núcleo UNEAFRO qual?' => $paciente->nucleo_uneafro_qual ? $paciente->nucleo_uneafro_qual : '',
          'Como chegou ao projeto outro' => $paciente->como_chegou_ao_projeto_outro ? $paciente->como_chegou_ao_projeto_outro : '',
          'Psicólogo' => $paciente->psicologo ? $paciente->psicologo->user->name : '',
          'Situação' => implode(', ', $situacao_array),
          'Data nascimento' => $paciente->data_nascimento ? $paciente->data_nascimento : '',
          'Idade' => $age,
          'Cor/Raça' => $paciente->cor_raca ? $paciente->cor_raca : '',
          'CEP' => $paciente->endereco_cep ? $paciente->endereco_cep : '',
          'Rua' => $paciente->endereco_rua ? $paciente->endereco_rua : '',
          'Número' => $paciente->endereco_numero ? $paciente->endereco_numero : '',
          'Bairro' => $paciente->endereco_bairro ? $paciente->endereco_bairro : '',
          'Cidade' => $paciente->endereco_cidade ? $paciente->endereco_cidade : '',
          'UF' => $paciente->endereco_uf ? $paciente->endereco_uf : '',
          'Ponto referência' => $paciente->ponto_referencia ? $paciente->ponto_referencia : '',
          'Complemento' => $paciente->endereco_complemento ? $paciente->endereco_complemento : '',
          'Tel. fixo' => $paciente->fone_fixo ? $paciente->fone_fixo : '',
          'Tel. celular' => $paciente->fone_celular ? $paciente->fone_celular : '',
          'Nº pessoas residência' => $paciente->numero_pessoas_residencia ? $paciente->numero_pessoas_residencia : '',
          'Responsável residência' => $paciente->responsavel_residencia ? $paciente->responsavel_residencia : '',
          'Renda residência' => $paciente->renda_residencia ? $paciente->renda_residencia : '',
          'Classe Social' => $classe,
          'Renda per capta' => $perCapta,
          'Doença crônica' => implode(', ', $doenca_cronica),
          'Descrição doenças crônicas' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',
          'Remédios consumidos' => $paciente->remedios_consumidos ? $paciente->remedios_consumidos : '',
          'Acompanhamento médico' => $paciente->acompanhamento_medico ? $paciente->acompanhamento_medico : '',
          'Isolamento residencial' => $paciente->isolamento_residencial ? $paciente->isolamento_residencial : '',
          'Alimentacao disponível' => $paciente->alimentacao_disponivel ? $paciente->alimentacao_disponivel : '',
          'Auxílio terceiros' => $paciente->auxilio_terceiros ? $paciente->auxilio_terceiros : '',
          'Tarefas autocuidado' => $paciente->tarefas_autocuidado ? $paciente->tarefas_autocuidado : '',
          'Teste utilizado' => $teste_utilizado,
          'Resultado teste' => $resultado_teste ? $resultado_teste : '',
          'Outras inf. sobre o teste' => $paciente->outras_informacao ? $paciente->outras_informacao : '',
          'Data teste confirmatório' => $paciente->data_teste_confirmatorio ? $paciente->data_teste_confirmatorio : '',
          'Data início sintoma' => $paciente->data_inicio_sintoma ? $paciente->data_inicio_sintoma : '',
          'Data início monitoramento' => $paciente->data_inicio_monitoramento ? $paciente->data_inicio_monitoramento : '',
          'Data início ac. psicológico' => $paciente->data_inicio_ac_psicologico ? $paciente->data_inicio_ac_psicologico : '',
          'Data encerramento ac. psicológico' => $paciente->data_encerramento_ac_psicologico ? $paciente->data_encerramento_ac_psicologico : '',
          'Data finalização caso' => $paciente->data_finalizacao_caso ? $paciente->data_finalizacao_caso : '',
          'Auxílio emergencial' => $paciente->auxilio_emergencial ? $paciente->auxilio_emergencial : '',
          'Descrição doenças' => $paciente->descreve_doencas ? $paciente->descreve_doencas : '',
          'Tuberculose' => $paciente->tuberculose ? $paciente->tuberculose : '',
          'Tabagista' => $paciente->tabagista ? $paciente->tabagista : '',
          'Alcool crônico' => $paciente->cronico_alcool ? $paciente->cronico_alcool : '',
          'Outras drogas' => $paciente->outras_drogas ? $paciente->outras_drogas : '',
          'Gestante' => $paciente->gestante ? $paciente->gestante : '',
          'Amamenta' => $paciente->amamenta ? $paciente->amamenta : '',
          'Gestação alto risco' => $paciente->gestacao_alto_risco ? $paciente->gestacao_alto_risco : '',
          'Pós parto' => $paciente->pos_parto ? $paciente->pos_parto : '',
          'Data parto' => $paciente->data_parto ? $paciente->data_parto : '',
          'Data última mestruação' => $paciente->data_ultima_mestrucao ? $paciente->data_ultima_mestrucao : '',
          'Trimestre gestacao' => $paciente->trimestre_gestacao ? $paciente->trimestre_gestacao : '',
          'Motivo risco gravidez' => $paciente->motivo_risco_gravidez ? $paciente->motivo_risco_gravidez : '',
          'Data última consulta' => $paciente->data_ultima_consulta ? $paciente->data_ultima_consulta : '',
          'Sistema saúde'  => $paciente->sistema_saude ? implode(', ', unserialize($paciente->sistema_saude)) : '',
          'Acompanhamento UBS' => $paciente->acompanhamento_ubs ? $paciente->acompanhamento_ubs : '',
        ]);
      }

      return [$pacientes_array];
    }

}
