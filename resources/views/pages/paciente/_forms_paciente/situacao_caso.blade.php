<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">SITUAÇÃO DO CASO</h5>
        <div class="form-row">
            <div class="col-12 col-md-4">
                <x-forms.input-date property="data_inicio_sintoma" :value="$paciente->data_inicio_sintoma">
                    Data início sintomas de COVID-19
                </x-forms.input-date>
            </div>
            <div class="col-12 col-md-4">
                <x-forms.input-date property="data_inicio_monitoramento" :value="$paciente->data_inicio_monitoramento">
                    Data início monitoramento Agentes
                </x-forms.input-date>
            </div>
            <div class="col-12 col-md-4">
                <x-forms.input-date property="data_finalizacao_caso" :value="$paciente->data_finalizacao_caso">
                    Data finalização do monitoramento Agentes (alta)
                </x-forms.input-date>
            </div>
            <div class="col-12 col-md-4">
                <x-forms.input-date property="data_inicio_ac_psicologico" :value="$paciente->data_inicio_ac_psicologico">
                    Data início ac Psicológico
                </x-forms.input-date>
            </div>
            <div class="col-12 col-md-4">
                <x-forms.input-date property="data_encerramento_ac_psicologico" :value="$paciente->data_encerramento_ac_psicologico">
                    Data encerramento ac Psicológico
                </x-forms.input-date>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        SITUAÇÃO
                    </label>
                    <select type="select" id="situacao" aria-describedby="situacaoHelp" name="situacao" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($situacoes as $key => $value)
                            <option value="{{$key}}" @if(old('situacao', $paciente->situacao) == $key ) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        Agente Responsável
                    </label>
                    <select type="select" name="agente_id" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($agentes as $agente)
                        <option value="{{ $agente->id }}" @if(old('agente_id', $paciente->agente_id) == $agente->id) selected @endif>
                            {{ $agente->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        Médica Responsável
                    </label>
                    <select type="select" name="medico_id" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($medicos as $medico)
                        <option value="{{ $medico->id }}" @if(old('medico_id', $paciente->medico_id) == $medico->id) selected @endif>
                            {{ $medico->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        Psicóloga Responsável
                    </label>
                    <select type="select" name="psicologo_id" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($psicologos as $psicologo)
                        <option value="{{ $psicologo->id }}" @if(old('psicologo_id', $paciente->psicologo_id) == $psicologo->id) selected @endif>
                            {{ $psicologo->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        Articuladora Responsável
                    </label>
                    <select type="select" name="articuladora_responsavel" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($articuladoras as $articuladora)
                        <option value="{{ $articuladora->id }}" @if(old('articuladora_responsavel', $paciente->articuladora_responsavel) == $articuladora->id) selected @endif>
                            {{ $articuladora->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <x-forms.choices.acompanhamento-psicologico :value="$paciente->acompanhamento_pisocologico ?? []" />
            </div>
            <div class="col-md-3">
                <x-forms.choices.dia-semana :value="$paciente->atendimento_semanal_psicologia" />
            </div>
            <div class="col-md-3">
                <label for="horario_at_psicologia">Horário at. psicologia</label>
                <input name="horario_at_psicologia" id="horario_at_psicologia" placeholder="Horário atendimento" type="time" class="form-control" value="{{ old('horario_at_psicologia', $paciente->horario_at_psicologia) }}">
            </div>
        </div>
    </div>
</div>
