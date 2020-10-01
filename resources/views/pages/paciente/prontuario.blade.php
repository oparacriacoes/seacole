<table>
    <thead>
    <tr>
      <th>PACIENTE</th>
      <th>Data do monitoramento</th>
      <th>QUANTOS DIAS DE SINTOMAS?</th>
      <th>Horário do monitoramento</th>
      <th>Sintomas atuais: Tosse</th>
      <th>Sintomas atuais: Falta de ar</th>
      <th>Sintomas atuais: Febre</th>
      <th>Sintomas atuais: Dor de cabeça</th>
      <th>Sintomas atuais: Perda de olfato</th>
      <th>Sintomas atuais: Perda de paladar</th>
      <th>Sintomas atuais: outros</th>
      <th>Sintomas atuais: Outros DESCREVA</th>
      <th>Temperatura atual (em graus)</th>
      <th>Saturação atual (%)</th>
      <th>Frequência respiratória atual</th>
      <th>Frequência cardíaca atual</th>
      <th>Pressão Arterial Atual</th>
      <th>Algum sinal de gravidade nesse monitoramento?</th>
      <th>Equipe médica do projeto prescreveu algum medicamento?</th>
      <th>Medicamento prescrito pela equipe médica do projeto</th>
      <th>Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?</th>
      <th>Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)</th>
      <th>Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)</th>
      <th>Fez inalação ou vaporização?</th>
      <th>Sentiu melhora dos sintomas com inalação ou vaporização</th>
    </tr>
    </thead>
    <tbody>
      <?php
      function monitoringDays($date1, $date2)
      {
        $date1_replace = str_replace('/', '-', $date1);
        $date2_replace = str_replace('/', '-', $date2);
        $date1_time = strtotime($date1_replace);
        $date2_time = strtotime($date2_replace);
        $from_date = date('Y-m-d', $date1_time);
        $to_date = date('Y-m-d', $date2_time);
        $from_parse = Carbon\Carbon::parse($from_date);
        $to_parse = Carbon\Carbon::parse($to_date);
        $monitoringDays = $from_parse->diffInDays($to_parse);

        return $monitoringDays;
      }
      ?>
      @foreach($prontuarios as $prontuario)
      <?php
      if( $prontuario->paciente->data_inicio_sintoma && $prontuario->data_monitoramento ){
        $dias_monitoramento = monitoringDays($prontuario->paciente->data_inicio_sintoma, $prontuario->data_monitoramento);
      } else {
        $dias_monitoramento = 'Dados insuficientes';
      }

      $sintoma = @unserialize($prontuario->sintomas_atuais);
      if($sintoma === false){
        $tosse = '';
        $falta_de_ar = '';
        $febre = '';
        $dor_de_cabeca = '';
        $perda_de_olfato = '';
        $perda_de_paladar = '';
        $outros = '';
      } else {
        in_array('tosse', $sintoma) ? $tosse = 'Sim' : $tosse = 'Não';
        in_array('falta de ar', $sintoma) ? $falta_de_ar = 'Sim' : $falta_de_ar = 'Não';
        in_array('febre', $sintoma) ? $febre = 'Sim' : $febre = 'Não';
        in_array('dor de cabeça', $sintoma) ? $dor_de_cabeca = 'Sim' : $dor_de_cabeca = 'Não';
        in_array('perda de olfato', $sintoma) ? $perda_de_olfato = 'Sim' : $perda_de_olfato = 'Não';
        in_array('perda do paladar', $sintoma) ? $perda_de_paladar = 'Sim' : $perda_de_paladar = 'Não';
        in_array('outros', $sintoma) ? $outros = 'Sim' : $outros = 'Não';
      }
      ?>
        <tr>
          <td>{{ $prontuario->paciente->user->name }}</td>
          <td>{{ $prontuario->data_monitoramento }}</td>
          <td>{{ $dias_monitoramento }}</td>
          <td>{{ $prontuario->horario_monotiramento }}</td>
          <td>{{ $tosse }}</td>
          <td>{{ $falta_de_ar }}</td>
          <td>{{ $febre }}</td>
          <td>{{ $dor_de_cabeca }}</td>
          <td>{{ $perda_de_olfato }}</td>
          <td>{{ $perda_de_paladar }}</td>
          <td>{{ $outros }}</td>
          <td>{{ $prontuario->sintomas_outro }}</td>
          <td>{{ $prontuario->temperatura_atual }}</td>
          <td>{{ $prontuario->saturacao_atual }}</td>
          <td>{{ $prontuario->frequencia_respiratoria_atual }}</td>
          <td>{{ $prontuario->frequencia_cardiaca_atual }}</td>
          <td>{{ $prontuario->pressao_arterial_atual }}</td>
          <td>{{ $prontuario->algum_sinal }}</td>
          <td>{{ $prontuario->equipe_medica }}</td>
          <td>{{ $prontuario->medicamento }}</td>
          <td>{{ $prontuario->fazendo_uso_pic }}</td>
          <td>{{ $prontuario->fez_escalapes }}</td>
          <td>{{ $prontuario->melhora_sintoma_escaldapes }}</td>
          <td>{{ $prontuario->fes_inalacao }}</td>
          <td>{{ $prontuario->melhoria_sintomas_inalacao }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
