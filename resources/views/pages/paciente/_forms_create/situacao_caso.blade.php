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
                        <option value="1" @if(old('situacao')==='1' ){{ 'selected' }} @endif>Caso ativo GRAVE</option>
                        <option value="2" @if(old('situacao')==='2' ){{ 'selected' }} @endif>Caso ativo LEVE</option>
                        <option value="3" @if(old('situacao')==='3' ){{ 'selected' }} @endif>Contato caso confirmado - ativo</option>
                        <option value="4" @if(old('situacao')==='4' ){{ 'selected' }} @endif>Outras situações (sem relação com COVID-19) - ativos</option>
                        <option value="5" @if(old('situacao')==='5' ){{ 'selected' }} @endif>Exclusivo psicologia - ativo</option>
                        <option value="6" @if(old('situacao')==='6' ){{ 'selected' }} @endif>Monitoramento encerrado GRAVE - segue apenas com psicólogos</option>
                        <option value="7" @if(old('situacao')==='7' ){{ 'selected' }} @endif>Monitoramento encerrado LEVE - segue apenas com psicólogos</option>
                        <option value="8" @if(old('situacao')==='8' ){{ 'selected' }} @endif>Monitoramento encerrado contato - segue apenas com psicólogos</option>
                        <option value="9" @if(old('situacao')==='9' ){{ 'selected' }} @endif>Monitoramento encerrado outros - segue apenas com psicólogos</option>
                        <option value="10" @if(old('situacao')==='10' ){{ 'selected' }} @endif>Caso finalizado GRAVE</option>
                        <option value="11" @if(old('situacao')==='11' ){{ 'selected' }} @endif>Caso finalizado LEVE</option>
                        <option value="12" @if(old('situacao')==='12' ){{ 'selected' }} @endif>Contato com caso confirmado - finalizado</option>
                        <option value="13" @if(old('situacao')==='13' ){{ 'selected' }} @endif>Outras situações (sem relação com COVID-19) - finalizado</option>
                        <option value="14" @if(old('situacao')==='14' ){{ 'selected' }} @endif>Exclusivo psicologia - finalizado</option>
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
                        <option value="{{ $agente->id }}">{{ $agente->user->name }}</option>
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
                        <option value="{{ $medico->id }}">{{ $medico->user->name }}</option>
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
                        <option value="{{ $psicologo->id }}">{{ $psicologo->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        Articuladora Responsável
                    </label>
                    <select type="select" name="articuladora_responsavel_id" class="custom-select">
                        <option value="">Selecione</option>
                        @foreach($articuladoras as $articuladora)
                        <option value="{{ $articuladora->id }}">{{ $articuladora->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="acompanhamento_psicologico" class="">
                        Acompanhamento psicológico
                    </label>
                    <br>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="acompanhamento_psicologico[]" id="individual" class="custom-control-input" value="individual">
                        <label class="custom-control-label" for="individual">
                            Individual
                        </label>
                    </div>
                </div>
                <div class="position-relative form-group">
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="acompanhamento_psicologico[]" id="em_grupo" class="custom-control-input" value="em grupo">
                        <label class="custom-control-label" for="em_grupo">
                            Em grupo
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="atendimento_semanal_psicologia">Atendimento semanal psicologia</label>
                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="seg"> Segunda</label></div>
                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="ter"> Terça</label></div>
                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qua"> Quarta</label></div>
                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qui"> Quinta</label></div>
                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="sex"> Sexta</label></div>
                </div>
            </div>
            <div class="col-md-3">
                <label for="horario_at_psicologia">Horário at. psicologia</label>
                <input name="horario_at_psicologia" id="horario_at_psicologia" placeholder="Horário atendimento" type="time" class="form-control">
            </div>
        </div>
    </div>
</div>
