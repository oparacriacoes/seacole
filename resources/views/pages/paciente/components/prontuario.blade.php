<div class="row">
    @forelse($prontuarios as $prontuario)
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Data: {{ $prontuario->data_monitoramento ? $prontuario->data_monitoramento->format('d/m/Y') : 'Data não definida' }} - Hora: {{ $prontuario->horario_monitoramento }}</h5>
                <p class="card-text">
                    <strong>Sintomas: </strong>
                    {{ implode(", ", $prontuario->sintomas_atuais ?? []) }}
                </p>
                <p class="card-text">
                    <strong>Outros Sintomas: </strong>{{ ucfirst($prontuario->sintomas_outro) }}
                </p>
                <p class="card-text">
                    <strong>Temperatura: </strong>{{ $prontuario->temperatura_atual }}
                </p>
                <p class="card-text">
                    <strong>Frequência Cardíaca: </strong>{{ $prontuario->frequencia_cardiaca_atual }}
                </p>
                <p class="card-text">
                    <strong>Frequência Respiratória: </strong>{{ $prontuario->frequencia_respiratoria_atual }}
                </p>
                <p class="card-text">
                    <strong>Saturação: </strong>{{ $prontuario->saturacao_atual }}
                </p>
                <p class="card-text">
                    <strong>Pressão Arterial: </strong>{{ $prontuario->pressao_arterial_atual }}
                </p>
                <p class="card-text">
                    <strong>Medicamento Prescrito? </strong>{{ human_boolean($prontuario->equipe_medica) }}
                </p>
                @if($prontuario->equipe_medica)
                <p class="card-text">
                    <strong>Qual? </strong>{{ ucfirst($prontuario->medicamento) }}
                </p>
                @endif
                <p class="card-text">
                    <strong>Sinal de Gravidade: </strong>{{ human_boolean($prontuario->algum_sinal) }}
                </p>
                <p class="card-text">
                    <strong>PIC: </strong>{{ human_boolean($prontuario->fazendo_uso_pic) }}
                </p>
                <p class="card-text">
                    <strong>Escaldapés: </strong>{{ human_boolean($prontuario->fez_escalapes) }}
                </p>
                <p class="card-text">
                    <strong>Sentiu Melhoras com Escaldapés: </strong>{{ ucfirst($prontuario->melhora_sintoma_escaldapes) }}
                </p>
                <p class="card-text">
                    <strong>Inalação/Vaporização: </strong>{{ ucfirst($prontuario->fes_inalacao) }}
                </p>
                <p class="card-text">
                    <strong>Sentiu Melhoras com Inalação/Vaporização: </strong>{{ ucfirst($prontuario->melhoria_sintomas_inalacao) }}
                </p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 col-md-12">
        Sem dados no prontuário.
    </div>
    @endforelse
</div>
