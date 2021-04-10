<form id="createPacienteForm" method="POST" action="{{ route('pacientes.update', $paciente) }}">
    @csrf
    @method('PUT')
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
                            <option value="1" <?php if ($paciente->situacao === '1') {
                                                    echo 'selected=selected';
                                                } ?>>Caso ativo GRAVE</option>
                            <option value="2" <?php if ($paciente->situacao === '2') {
                                                    echo 'selected=selected';
                                                } ?>>Caso ativo LEVE</option>
                            <option value="3" <?php if ($paciente->situacao === '3') {
                                                    echo 'selected=selected';
                                                } ?>>Contato caso confirmado - ativo</option>
                            <option value="4" <?php if ($paciente->situacao === '4') {
                                                    echo 'selected=selected';
                                                } ?>>Outras situações (sem relação com COVID-19) - ativos</option>
                            <option value="5" <?php if ($paciente->situacao === '5') {
                                                    echo 'selected=selected';
                                                } ?>>Exclusivo psicologia - ativo</option>
                            <option value="6" <?php if ($paciente->situacao === '6') {
                                                    echo 'selected=selected';
                                                } ?>>Monitoramento encerrado GRAVE - segue apenas com psicólogos</option>
                            <option value="7" <?php if ($paciente->situacao === '7') {
                                                    echo 'selected=selected';
                                                } ?>>Monitoramento encerrado LEVE - segue apenas com psicólogos</option>
                            <option value="8" <?php if ($paciente->situacao === '8') {
                                                    echo 'selected=selected';
                                                } ?>>Monitoramento encerrado contato - segue apenas com psicólogos</option>
                            <option value="9" <?php if ($paciente->situacao === '9') {
                                                    echo 'selected=selected';
                                                } ?>>Monitoramento encerrado outros - segue apenas com psicólogos</option>
                            <option value="10" <?php if ($paciente->situacao === '10') {
                                                    echo 'selected=selected';
                                                } ?>>Caso finalizado GRAVE</option>
                            <option value="11" <?php if ($paciente->situacao === '11') {
                                                    echo 'selected=selected';
                                                } ?>>Caso finalizado LEVE</option>
                            <option value="12" <?php if ($paciente->situacao === '12') {
                                                    echo 'selected=selected';
                                                } ?>>Contato com caso confirmado - finalizado</option>
                            <option value="13" <?php if ($paciente->situacao === '13') {
                                                    echo 'selected=selected';
                                                } ?>>Outras situações (sem relação com COVID-19) - finalizado</option>
                            <option value="14" <?php if ($paciente->situacao === '14') {
                                                    echo 'selected=selected';
                                                } ?>>Exclusivo psicologia - finalizado</option>
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
                        <select type="select" name="agente" class="custom-select">
                            <option value="">Selecione</option>
                            @foreach($agentes as $agente)
                            <!--<option value="{{ $agente->id }}" <?php if (\Auth::user()->role === 'agente' && \Auth::user()->agente->id === $agente->id) {
                                                                        echo 'selected=selected';
                                                                    } ?> >{{ $agente->user->name }}</option>-->
                            <option value="{{ $agente->id }}" <?php if ($paciente->agente_id === $agente->id) {
                                                                    echo 'selected=selected';
                                                                } ?>>{{ $agente->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            Médica Responsável
                        </label>
                        <select type="select" name="medico" class="custom-select">
                            <option value="">Selecione</option>
                            @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}" <?php if ($paciente->medico_id === $medico->id) {
                                                                    echo 'selected=selected';
                                                                } ?>>{{ $medico->user->name }}</option>
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
                            <option value="{{ $psicologo->id }}" <?php if ($paciente->psicologo_id === $psicologo->id) {
                                                                        echo 'selected=selected';
                                                                    } ?>>{{ $psicologo->user->name }}</option>
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
                            <option value="{{ $articuladora->id }}" <?php if ($paciente->articuladora_responsavel === $articuladora->id) {
                                                                        echo 'selected=selected';
                                                                    } ?>>{{ $articuladora->name }}</option>
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
                            <input type="checkbox" name="acompanhamento_psicologico[]" id="individual" class="custom-control-input" value="individual" <?php if ($acompanhamento_psicologico && in_array('individual', $acompanhamento_psicologico)) {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } ?>>
                            <label class="custom-control-label" for="individual">
                                Individual
                            </label>
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="acompanhamento_psicologico[]" id="em_grupo" class="custom-control-input" value="em grupo" <?php if ($acompanhamento_psicologico && in_array('em grupo', $acompanhamento_psicologico)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                            <label class="custom-control-label" for="em_grupo">
                                Em grupo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="atendimento_semanal_psicologia">Atendimento semanal psicologia</label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="seg" @if($paciente->atendimento_semanal_psicologia === 'seg'){{ 'checked' }} @endif > Segunda</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="ter" @if($paciente->atendimento_semanal_psicologia === 'ter'){{ 'checked' }} @endif > Terça</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qua" @if($paciente->atendimento_semanal_psicologia === 'qua'){{ 'checked' }} @endif > Quarta</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qui" @if($paciente->atendimento_semanal_psicologia === 'qui'){{ 'checked' }} @endif > Quinta</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="sex" @if($paciente->atendimento_semanal_psicologia === 'sex'){{ 'checked' }} @endif > Sexta</label></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="horario_at_psicologia">Horário at. psicologia</label>
                    <input name="horario_at_psicologia" id="horario_at_psicologia" placeholder="Horário atendimento" type="text" class="form-control hour" value="{{ $paciente->horario_at_psicologia }}">
                </div>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="exampleEmail11" class="">
                            Nome Completo (obrigatório)
                        </label>
                        <input name="name" id="name" aria-describedby="nameHelp" value="{{ $paciente->user->name }}" placeholder="Nome Completo" type="text" class="required form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="exampleEmail11" class="">
                            Nome Social
                        </label>
                        <input name="name_social" id="name_social" placeholder="Nome Social" type="text" class="form-control" value="{{ $paciente->name_social }}">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="exampleEmail11" class="">
                            Telefone fixo
                        </label>
                        <input name="fone_fixo" id="fone_fixo" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd" value="{{ $paciente->fone_fixo }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="exampleEmail11" class="">
                            Telefone celular
                        </label>
                        <input name="fone_celular" id="fone_celular" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd" value="{{ $paciente->fone_celular }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <x-forms.input-date property="data_nascimento" :value="$paciente->data_nascimento">
                        Data de Nascimento
                    </x-forms.input-date>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Responsável</label>
                        <input name="responsavel_residencia" type="text" class=" form-control ddate" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp" value="{{ $paciente->responsavel_residencia }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input name="email" type="email" class=" form-control ddate" id="email" aria-describedby="emailHelp" value="{{ $paciente->user->email }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">CEP</label>
                        <input name="endereco_cep" placeholder="Somente números" type="text" class=" form-control cep" id="endereco_cep" aria-describedby="endereco_cepHelp" value="{{ $paciente->endereco_cep }}">
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Logradouro</label>
                        <input name="endereco_rua" type="text" class=" form-control ddate" id="endereco_rua" aria-describedby="endereco_ruaHelp" value="{{ $paciente->endereco_rua }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="name">Número</label>
                        <input name="endereco_numero" type="text" class=" form-control ddate" id="endereco_numero" aria-describedby="endereco_numeroHelp" value="{{ $paciente->endereco_numero }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Complemento</label>
                        <input name="endereco_complemento" type="text" class=" form-control ddate" id="endereco_complemento" aria-describedby="endereco_complementoHelp" value="{{ $paciente->endereco_complemento }}">
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Bairro</label>
                        <input name="endereco_bairro" type="text" class=" form-control" id="endereco_bairro" value="{{ $paciente->endereco_bairro }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Cidade</label>
                        <input name="endereco_cidade" type="text" class=" form-control" id="endereco_cidade" value="{{ $paciente->endereco_cidade }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="name">UF</label>
                        <input name="endereco_uf" type="text" class=" form-control" id="endereco_uf" value="{{ $paciente->endereco_uf }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Ponto de referência</label>
                        <input name="ponto_referencia" type="text" class=" form-control" id="ponto_referencia" value="{{ $paciente->ponto_referencia }}">
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            Identidade de genero
                        </label>
                        <select type="select" id="identidade_genero" name="identidade_genero" class="custom-select">
                            <option value="">Selecione</option>
                            <option <?php if ($paciente->identidade_genero === 'mulher cis') {
                                        echo 'selected=selected';
                                    } ?>>mulher cis</option>
                            <option <?php if ($paciente->identidade_genero === 'mulher trans') {
                                        echo 'selected=selected';
                                    } ?>>mulher trans</option>
                            <option <?php if ($paciente->identidade_genero === 'homem cis') {
                                        echo 'selected=selected';
                                    } ?>>homem cis</option>
                            <option <?php if ($paciente->identidade_genero === 'homem trans') {
                                        echo 'selected=selected';
                                    } ?>>homem trans</option>
                            <option <?php if ($paciente->identidade_genero === 'não-binário') {
                                        echo 'selected=selected';
                                    } ?>>não-binário</option>
                            <option <?php if ($paciente->identidade_genero === 'outro') {
                                        echo 'selected=selected';
                                    } ?>>outro</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            Orientação sexual
                        </label>
                        <select type="select" id="orientacao_sexual" name="orientacao_sexual" class="custom-select">
                            <option value="">Selecione</option>
                            <option <?php if ($paciente->orientacao_sexual === 'heterossexual') {
                                        echo 'selected=selected';
                                    } ?>>heterossexual</option>
                            <option <?php if ($paciente->orientacao_sexual === 'homossexual') {
                                        echo 'selected=selected';
                                    } ?>>homossexual</option>
                            <option <?php if ($paciente->orientacao_sexual === 'bissexual') {
                                        echo 'selected=selected';
                                    } ?>>bissexual</option>
                            <option <?php if ($paciente->orientacao_sexual === 'outro') {
                                        echo 'selected=selected';
                                    } ?>>outro</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            Raça / Cor
                        </label>
                        <select type="select" id="cor_raca" name="cor_raca" class="custom-select">
                            <option value="">Selecione</option>
                            <option <?php if ($paciente->cor_raca === 'Preta') {
                                        echo 'selected=selected';
                                    } ?>>Preta</option>
                            <option <?php if ($paciente->cor_raca === 'Parda') {
                                        echo 'selected=selected';
                                    } ?>>Parda</option>
                            <option <?php if ($paciente->cor_raca === 'Branca') {
                                        echo 'selected=selected';
                                    } ?>>Branca</option>
                            <option <?php if ($paciente->cor_raca === 'Amarela') {
                                        echo 'selected=selected';
                                    } ?>>Amarela</option>
                            <option <?php if ($paciente->cor_raca === 'Indígena') {
                                        echo 'selected=selected';
                                    } ?>>Indígena</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nº Pessoas na Residência</label>
                            <input name="numero_pessoas_residencia" type="number" class=" form-control" id="numero_pessoas_residencia" value="{{ $paciente->numero_pessoas_residencia }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Recebe auxílio emergencial</label>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="sim" <?php if ($paciente->auxilio_emergencial === 'sim') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Sim</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="não" <?php if ($paciente->auxilio_emergencial === 'não') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Não</label></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Valor exato da renda familiar</label>
                            <input name="renda_residencia" type="text" placeholder="0.000,00" class=" form-control money" id="renda_residencia" value="{{ $paciente->renda_residencia }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="como_chegou_ao_projeto">Como chegou ao projeto?</label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="núcleo da Uneafro" @if($paciente->como_chegou_ao_projeto === 'núcleo da Uneafro'){{ 'checked' }} @endif > núcleo da Uneafro</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="faixa ou cartaz na rua" @if($paciente->como_chegou_ao_projeto === 'faixa ou cartaz na rua'){{ 'checked' }} @endif > faixa ou cartaz na rua</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="carro ou bicicleta de som" @if($paciente->como_chegou_ao_projeto === 'carro ou bicicleta de som'){{ 'checked' }} @endif > carro ou bicicleta de som</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="whatsapp" @if($paciente->como_chegou_ao_projeto === 'whatsapp'){{ 'checked' }} @endif > whatsapp</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="instagram" @if($paciente->como_chegou_ao_projeto === 'instagram'){{ 'checked' }} @endif > instagram</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="facebook" @if($paciente->como_chegou_ao_projeto === 'facebook'){{ 'checked' }} @endif > facebook</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="twitter" @if($paciente->como_chegou_ao_projeto === 'twitter'){{ 'checked' }} @endif > twitter</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="e-mail" @if($paciente->como_chegou_ao_projeto === 'e-mail'){{ 'checked' }} @endif > e-mail</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="indicação de amigo, vizinho ou familiar" @if($paciente->como_chegou_ao_projeto === 'indicação de amigo, vizinho ou familiar'){{ 'checked' }} @endif > indicação de amigo, vizinho ou familiar</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="Outro" @if($paciente->como_chegou_ao_projeto === 'Outro'){{ 'checked' }} @endif > Outro</label></div>
                        <input name="como_chegou_ao_projeto_outro" type="text" placeholder="Outro qual?" class=" form-control" id="como_chegou_ao_projeto_outro" value="{{ $paciente->como_chegou_ao_projeto_outro }}">
                    </div>
                    <div class="col">
                        <label for="nucleo_uneafro_qual">Núcleo da Uneafro: qual?</label>
                        <select type="select" id="nucleo_uneafro_qual" name="nucleo_uneafro_qual" class="custom-select">
                            <option value="">Selecione</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'CONCEIÇÃO EVARISTO'){{ 'selected' }} @endif >CONCEIÇÃO EVARISTO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO YABÁS'){{ 'selected' }} @endif >UNEAFRO YABÁS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'MANDELA'){{ 'selected' }} @endif >MANDELA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'GUERREIROS ALVINÓPOLIS'){{ 'selected' }} @endif >GUERREIROS ALVINÓPOLIS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'MARIELLE FRANCO'){{ 'selected' }} @endif >MARIELLE FRANCO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'KLEBER CRIOULO'){{ 'selected' }} @endif >KLEBER CRIOULO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'VILA FÁTIMA'){{ 'selected' }} @endif >VILA FÁTIMA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MABEL ASSIS'){{ 'selected' }} @endif >UNEAFRO MABEL ASSIS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'BOM PASTOR'){{ 'selected' }} @endif >BOM PASTOR</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO ASSIS'){{ 'selected' }} @endif >UNEAFRO ASSIS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'MARGARIDA ALVES'){{ 'selected' }} @endif >MARGARIDA ALVES</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'DONA NAZINHA'){{ 'selected' }} @endif >DONA NAZINHA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'LUIZA MAHIN'){{ 'selected' }} @endif >LUIZA MAHIN</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'CLEMENTINA DE JESUS'){{ 'selected' }} @endif >CLEMENTINA DE JESUS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'NÚCLEO LÁ DA LESTE'){{ 'selected' }} @endif >NÚCLEO LÁ DA LESTE</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'SÉRGIO LAPALOMA'){{ 'selected' }} @endif >SÉRGIO LAPALOMA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'SUELI CARNEIRO'){{ 'selected' }} @endif >SUELI CARNEIRO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'TIA JURA'){{ 'selected' }} @endif >TIA JURA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'NOVA PALESTINA'){{ 'selected' }} @endif >NOVA PALESTINA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'RAQUEL TRINDADE'){{ 'selected' }} @endif >RAQUEL TRINDADE</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'ASSATA SHAKUR'){{ 'selected' }} @endif >ASSATA SHAKUR</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'ILDA MARTINS'){{ 'selected' }} @endif >ILDA MARTINS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MOGI'){{ 'selected' }} @endif >UNEAFRO MOGI</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'CAROLINA MARIA DE JESUS'){{ 'selected' }} @endif >CAROLINA MARIA DE JESUS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO NA DISCIPLINA'){{ 'selected' }} @endif >UNEAFRO NA DISCIPLINA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO QUILOMBAQUE'){{ 'selected' }} @endif >UNEAFRO QUILOMBAQUE</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'XI DE AGOSTO'){{ 'selected' }} @endif >XI DE AGOSTO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'EDUCAÇÃO LIBERTA'){{ 'selected' }} @endif >EDUCAÇÃO LIBERTA</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'ROSA PARKS'){{ 'selected' }} @endif >ROSA PARKS</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'ANTÔNIO CANDEIA FILHO'){{ 'selected' }} @endif >ANTÔNIO CANDEIA FILHO</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MSTC'){{ 'selected' }} @endif >UNEAFRO MSTC</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO LUZ'){{ 'selected' }} @endif >UNEAFRO LUZ</option>
                            <option @if($paciente->nucleo_uneafro_qual === 'NÚCLEO OBARÁ'){{ 'selected' }} @endif >NÚCLEO OBARÁ</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">
                (Sentinela-Vigilancia) DIAGNÓSTICO DE COVID-19
            </h5>
            <div class="form-row">
                <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            DIAGNÓSTICO DE COVID-19
                        </label>
                        <select type="select" id="sintomas_iniciais" name="sintomas_iniciais" class="custom-select">
                            <option value="">Selecione</option>
                            <option <?php if ($paciente->sintomas_iniciais === 'suspeito') {
                                        echo 'selected=selected';
                                    } ?>>suspeito</option>
                            <option <?php if ($paciente->sintomas_iniciais === 'confirmado') {
                                        echo 'selected=selected';
                                    } ?>>confirmado</option>
                            <option <?php if ($paciente->sintomas_iniciais === 'descartado') {
                                        echo 'selected=selected';
                                    } ?>>descartado</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <x-forms.input-date property="data_teste_confirmatorio" :value="$paciente->data_teste_confirmatorio">
                        Data do teste confirmatório
                    </x-forms.input-date>
                </div>
                <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label class="">
                            Testes realizados?
                        </label>
                        <br>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="teste_utilizado[]" id="pcr" class="custom-control-input" value="PCR" <?php if ($teste_utilizado && is_array($teste_utilizado) && in_array('PCR', $teste_utilizado)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } elseif ($teste_utilizado === 'PCR') {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                            <label class="custom-control-label" for="pcr">
                                PCR
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="teste_utilizado[]" id="sorologias" class="custom-control-input" value="sorologias (IgM/IgG)" <?php if ($teste_utilizado && is_array($teste_utilizado) && in_array('sorologias (IgM/IgG)', $teste_utilizado)) {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } elseif ($teste_utilizado === 'sorologias (IgM/IgG)') {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } ?>>
                            <label class="custom-control-label" for="sorologias">
                                sorologias (IgM/IgG)
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="teste_utilizado[]" id="teste_rapido" class="custom-control-input" value="teste rápido" <?php if ($teste_utilizado && is_array($teste_utilizado) && in_array('teste rápido', $teste_utilizado)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($teste_utilizado === 'teste rápido') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="teste_rapido">
                                Teste Rápido
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="teste_utilizado[]" id="nao_informado" class="custom-control-input" value="não informado" <?php if ($teste_utilizado && is_array($teste_utilizado) && in_array('não informado', $teste_utilizado)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } elseif ($teste_utilizado === 'não informado') {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                            <label class="custom-control-label" for="nao_informado">
                                Não Informado
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label for="exampleCustomSelect" class="">
                            Resultados encontrados
                        </label>
                        <br>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="pcr_positivo" class="custom-control-input" value="PCR positivo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('PCR positivo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'PCR positivo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="pcr_positivo">
                                PCR positivo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="pcr_negativo" class="custom-control-input" value="PCR negativo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('PCR negativo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'PCR negativo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="pcr_negativo">
                                PCR negativo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="igm_positivo" class="custom-control-input" value="IgM positivo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('IgM positivo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'IgM positivo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="igm_positivo">
                                IgM positivo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="igm_negativo" class="custom-control-input" value="IgM negativo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('IgM negativo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'IgM negativo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="igm_negativo">
                                IgM negativo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="igg_positivo" class="custom-control-input" value="IgG positivo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('IgG positivo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'IgG positivo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="igg_positivo">
                                IgG positivo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="resultado_teste[]" id="igg_negativo" class="custom-control-input" value="IgG negativo" <?php if ($resultado_teste && is_array($resultado_teste) && in_array('IgG negativo', $resultado_teste)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } elseif ($resultado_teste === 'IgG negativo') {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="custom-control-label" for="igg_negativo">
                                IgG negativo
                            </label>
                        </div>
                        <!--<select type="select" id="resultado_teste" name="resultado_teste" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option <?php if ($paciente->resultado_teste === 'PCR positivo') {
                                                        echo 'selected=selected';
                                                    } ?> >PCR positivo</option>
                                            <option <?php if ($paciente->resultado_teste === 'PCR negativo') {
                                                        echo 'selected=selected';
                                                    } ?> >PCR negativo</option>
                                            <option <?php if ($paciente->resultado_teste === 'IgM positivo') {
                                                        echo 'selected=selected';
                                                    } ?> >IgM positivo</option>
                                            <option <?php if ($paciente->resultado_teste === 'IgM negativo') {
                                                        echo 'selected=selected';
                                                    } ?> >IgM negativo</option>
                                            <option <?php if ($paciente->resultado_teste === 'IgG positivo') {
                                                        echo 'selected=selected';
                                                    } ?> >IgG positivo</option>
                                            <option <?php if ($paciente->resultado_teste === 'IgG negativo') {
                                                        echo 'selected=selected';
                                                    } ?> >IgG negativo</option>
                                        </select>-->
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Outras informações sobre teste</label>
                        <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control">{{ $paciente->outras_informacao }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">CONDIÇÕES DE SAÚDE</h5>
            <div class="position-relative form-group">
                <label for="exampleCustomSelect" class="">
                    Condições gerais de saúde
                </label>

                <div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="hipertensao_arterial_sistemica" class="custom-control-input" value="1" <?php if ($cronicas && in_array('1', $cronicas)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="hipertensao_arterial_sistemica">
                            Hipertensão arterial sistêmica (HAS)
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="diabetes_mellitus" class="custom-control-input" value="2" <?php if ($cronicas && in_array('2', $cronicas)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                        <label class="custom-control-label" for="diabetes_mellitus">
                            Diabetes Mellitus (DM)
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="dislipidemia" class="custom-control-input" value="3" <?php if ($cronicas && in_array('3', $cronicas)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                        <label class="custom-control-label" for="dislipidemia">
                            Dislipidemia
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="asma_bronquite" class="custom-control-input" value="4" <?php if ($cronicas && in_array('4', $cronicas)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="asma_bronquite">
                            Asma / Bronquite
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="tuberculose_ativa" class="custom-control-input" value="5" <?php if ($cronicas && in_array('5', $cronicas)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                        <label class="custom-control-label" for="tuberculose_ativa">
                            Tuberculose ativa
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="cardiopatias_cardiovasculares" class="custom-control-input" value="6" <?php if ($cronicas && in_array('6', $cronicas)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="cardiopatias_cardiovasculares">
                            Cardiopatias e outras doenças cardiovasculares
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="outras_respiratorias" class="custom-control-input" value="7" <?php if ($cronicas && in_array('7', $cronicas)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                        <label class="custom-control-label" for="outras_respiratorias">
                            Outras doenças Respiratórias
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="artrite_artrose_reumatismo" class="custom-control-input" value="8" <?php if ($cronicas && in_array('8', $cronicas)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                        <label class="custom-control-label" for="artrite_artrose_reumatismo">
                            Artrite/Artrose/Reumatismo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="doenca_autoimune" class="custom-control-input" value="9" <?php if ($cronicas && in_array('9', $cronicas)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="doenca_autoimune">
                            Doença autoimune
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="doenca_renal" class="custom-control-input" value="10" <?php if ($cronicas && in_array('10', $cronicas)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="doenca_renal">
                            Doença renal
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="doenca_neurologica" class="custom-control-input" value="11" <?php if ($cronicas && in_array('11', $cronicas)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                        <label class="custom-control-label" for="doenca_neurologica">
                            Doença neurológica
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="cancer" class="custom-control-input" value="12" <?php if ($cronicas && in_array('12', $cronicas)) {
                                                                                                                                echo 'checked=checked';
                                                                                                                            } ?>>
                        <label class="custom-control-label" for="cancer">
                            Câncer
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="ansiedade" class="custom-control-input" value="13" <?php if ($cronicas && in_array('13', $cronicas)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                        <label class="custom-control-label" for="ansiedade">
                            Ansiedade
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="depressao" class="custom-control-input" value="14" <?php if ($cronicas && in_array('14', $cronicas)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                        <label class="custom-control-label" for="depressao">
                            Depressão
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="demencia" class="custom-control-input" value="15" <?php if ($cronicas && in_array('15', $cronicas)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                        <label class="custom-control-label" for="demencia">
                            Demência
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="doenca_cronica[]" id="outras_questoes_mental" class="custom-control-input" value="16" <?php if ($cronicas && in_array('16', $cronicas)) {
                                                                                                                                                echo 'checked=checked';
                                                                                                                                            } ?>>
                        <label class="custom-control-label" for="outras_questoes_mental">
                            Outras questões de saúde mental
                        </label>
                    </div>
                </div>
            </div>

            <div class="position-relative form-group">
                <label for="exampleCustomSelect" class="">
                    Descreva as doenças assinaladas
                </label>

                <div class="position-relative row form-group">
                    <div class="col-sm-10">
                        <textarea name="descreve_doencas" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="descreve_doencas" class="form-control">{{ $paciente->descreve_doencas }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Já teve tuberculose?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="sim" <?php if ($paciente->tuberculose === 'sim') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="não" <?php if ($paciente->tuberculose === 'não') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">É tabagista?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="sim" <?php if ($paciente->tabagista === 'sim') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="não" <?php if ($paciente->tabagista === 'não') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Faz uso crônico de alcool?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="sim" <?php if ($paciente->cronico_alcool === 'sim') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="não" <?php if ($paciente->cronico_alcool === 'não') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Faz uso crônico de outras drogas?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="sim" <?php if ($paciente->outras_drogas === 'sim') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="não" <?php if ($paciente->outras_drogas === 'não') {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Toma remédio(s) de uso contínuo? Qual(is)?
                            </label>
                            <input name="remedios_consumidos" id="remedios_consumidos" placeholder="Qual(is)?" type="text" class="form-control" value="{{ $paciente->remedios_consumidos }}">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Está gestante?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="sim" <?php if ($paciente->gestante === 'sim') {
                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                    } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="não" <?php if ($paciente->gestante === 'não') {
                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                    } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Amamenta?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="sim" <?php if ($paciente->amamenta === 'sim') {
                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                    } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="não" <?php if ($paciente->amamenta === 'não') {
                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                    } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Gestação é ou foi de alto risco?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="sim" <?php if ($paciente->gestacao_alto_risco === 'sim') {
                                                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                                                } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="não" <?php if ($paciente->gestacao_alto_risco === 'não') {
                                                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                                                } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Está no pós-parto (40 dias após o parto)?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="sim" <?php if ($paciente->pos_parto === 'sim') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="não" <?php if ($paciente->pos_parto === 'não') {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <x-forms.input-date property="data_parto" :value="$paciente->data_parto">
                            Data do teste confirmatório
                        </x-forms.input-date>
                    </div>

                    <div class="col-md-3">
                        <x-forms.input-date property="data_ultima_mestrucao" :value="$paciente->data_ultima_mestrucao">
                            Data da última menstruação (DUM)
                        </x-forms.input-date>
                    </div>

                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="exampleCustomSelect" class="">
                                Trimestre da gestação no início do monitoramento
                            </label>
                            <select type="select" id="trimestre_gestacao" name="trimestre_gestacao" class="custom-select">
                                <option value="">Selecione</option>
                                <option <?php if ($paciente->trimestre_gestacao === '1o trimestre') {
                                            echo 'selected=selected';
                                        } ?>>1o trimestre</option>
                                <option <?php if ($paciente->trimestre_gestacao === '2o trimestre') {
                                            echo 'selected=selected';
                                        } ?>>2o trimestre</option>
                                <option <?php if ($paciente->trimestre_gestacao === '3o trimestre') {
                                            echo 'selected=selected';
                                        } ?>>3o trimestre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Motivo do risco elevado na gravidez
                            </label>
                            <input name="motivo_risco_gravidez" id="motivo_risco_gravidez" placeholder="Qual(is)?" type="text" class="form-control" value="{{ $paciente->motivo_risco_gravidez }}">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Tem algum acompanhamento médico contínuo?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="sim" <?php if ($paciente->acompanhamento_medico === 'sim') {
                                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                                    } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="não" <?php if ($paciente->acompanhamento_medico === 'não') {
                                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                                    } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-forms.input-date property="data_ultima_consulta" :value="$paciente->data_ultima_consulta">
                            Qual a data da última consulta médica?
                        </x-forms.input-date>
                    </div>

                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">
                                Onde/como acessa o sistema de saúde?
                            </label>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="sistema_saude[]" id="sus" class="custom-control-input" value="É usuária/o do SUS (público)" <?php if ($sistema_saude && in_array('É usuária/o do SUS (público)', $sistema_saude)) {
                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                            } ?>>
                                <label class="custom-control-label" for="sus">
                                    É usuária/o do SUS (público)
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="sistema_saude[]" id="convenio" class="custom-control-input" value="Tem convênio/plano de saúde" <?php if ($sistema_saude && in_array('Tem convênio/plano de saúde', $sistema_saude)) {
                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                } ?>>
                                <label class="custom-control-label" for="convenio">
                                    Tem convênio/plano de saúde
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="sistema_saude[]" id="pagos_populares" class="custom-control-input" value="Usuária/o de serviços pagos 'populares' (Ex: Dr Consulta)" <?php if ($sistema_saude && in_array("Usuária/o de serviços pagos 'populares' (Ex: Dr Consulta)", $sistema_saude)) {
                                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                                    } ?>>
                                <label class="custom-control-label" for="pagos_populares">
                                    Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="sistema_saude[]" id="particulares" class="custom-control-input" value="Usuária/o de serviços particulares não cobertos por convênios" <?php if ($sistema_saude && in_array('Usuária/o de serviços particulares não cobertos por convênios', $sistema_saude)) {
                                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                                    } ?>>
                                <label class="custom-control-label" for="particulares">
                                    Usuária/o de serviços particulares não cobertos por convênios
                                </label>
                            </div>
                            <!--<select multiple="" type="select" id="sistema_saude" name="sistema_saude[]" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option <?php if ($sistema_saude && in_array('É usuária/o do SUS (público)', $sistema_saude)) {
                                                            echo 'selected=selected';
                                                        } ?> >É usuária/o do SUS (público)</option>
                                                <option <?php if ($sistema_saude && in_array('Tem convênio/plano de saúde', $sistema_saude)) {
                                                            echo 'selected=selected';
                                                        } ?> >Tem convênio/plano de saúde</option>
                                                <option <?php if ($sistema_saude && in_array('Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)', $sistema_saude)) {
                                                            echo 'selected=selected';
                                                        } ?> >Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)</option>
                                                <option <?php if ($sistema_saude && in_array('Usuária/o de serviços particulares não cobertos por convênios', $sistema_saude)) {
                                                            echo 'selected=selected';
                                                        } ?> >Usuária/o de serviços particulares não cobertos por convênios</option>
                                            </select>
                                            <small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <div class="form-group">
                                <label for="name">Tem acompanhamento médico na Unidade Básica de Saúde (UBS - posto) de referência?</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="sim" <?php if ($paciente->acompanhamento_ubs === 'sim') {
                                                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                                                } ?>> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="não" <?php if ($paciente->acompanhamento_ubs === 'não') {
                                                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                                                } ?>> Não</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="position-relatives row fdorm-check">
                <div class="col-sm-12 offset-sm-2s"><br />
                    <button type="submit" id="createPaciente" class="btn btn-secondary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</form>
