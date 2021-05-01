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
            $monitoringDays = $date1->diffInDays($date2);
            return $monitoringDays;
        }
        ?>
        @foreach($prontuarios as $prontuario)
        <?php
        if ($prontuario->paciente) {
            if ($prontuario->paciente->data_inicio_sintoma && $prontuario->data_monitoramento) {
                $dias_monitoramento = monitoringDays($prontuario->paciente->data_inicio_sintoma, $prontuario->data_monitoramento);
            } else {
                $dias_monitoramento = 'Dados insuficientes';
            }

            $sintoma = $prontuario->sintomas_atuais;
            if (!$sintoma) {
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
        }
        ?>
        <tr>
            <td>{{ $prontuario->paciente ? $prontuario->paciente->name : '' }}</td>
            <td>{{ $prontuario->data_monitoramento ? $prontuario->data_monitoramento->format('Y-m-d') : '' }}</td>
            <td>{{ $prontuario->paciente ? $dias_monitoramento : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->horario_monotiramento : '' }}</td>
            <td>{{ $prontuario->paciente ? $tosse : '' }}</td>
            <td>{{ $prontuario->paciente ? $falta_de_ar : '' }}</td>
            <td>{{ $prontuario->paciente ? $febre : '' }}</td>
            <td>{{ $prontuario->paciente ? $dor_de_cabeca : '' }}</td>
            <td>{{ $prontuario->paciente ? $perda_de_olfato : '' }}</td>
            <td>{{ $prontuario->paciente ? $perda_de_paladar : '' }}</td>
            <td>{{ $prontuario->paciente ? $outros : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->sintomas_outro : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->temperatura_atual : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->saturacao_atual : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->frequencia_respiratoria_atual : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->frequencia_cardiaca_atual : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->pressao_arterial_atual : '' }}</td>
            <td>{{ $prontuario->paciente ? human_boolean($prontuario->algum_sinal) : '' }}</td>
            <td>{{ $prontuario->paciente ? human_boolean($prontuario->equipe_medica) : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->medicamento : '' }}</td>
            <td>{{ $prontuario->paciente ? human_boolean($prontuario->fazendo_uso_pic) : '' }}</td>
            <td>{{ $prontuario->paciente ? human_boolean($prontuario->fez_escalapes) : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->melhora_sintoma_escaldapes : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->fes_inalacao : '' }}</td>
            <td>{{ $prontuario->paciente ? $prontuario->melhoria_sintomas_inalacao : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
