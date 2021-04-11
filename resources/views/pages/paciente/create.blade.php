@extends('layouts.app_new')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>Pacientes
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ALERTS DE RETORNO DO BACKEND -->
    @if(session('success'))
    <div class="row">
        <div class="col">
            <div class="alert alert-success info" role="alert">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="row">
        <div class="col">
            <div class="alert alert-danger info" role="alert">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <form id="createPacienteForm" method="POST" action="{{ route('pacientes.store') }}">
        @csrf
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">SITUAÇÃO DO CASO</h5>
                {{-- <form class=""> --}}
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
                            <select type="select" name="agente" class="custom-select">
                                <option value="">Selecione</option>
                                @foreach($agentes as $agente)
                                <!--<option value="{{ $agente->id }}" <?php if (\Auth::user()->role === 'agente' && \Auth::user()->agente->id === $agente->id) {
    echo 'selected=selected';
} ?> >{{ $agente->user->name }}</option>-->
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
                            <select type="select" name="medico" class="custom-select">
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
                            <select type="select" name="articuladora_responsavel" class="custom-select">
                                <option value="">Selecione</option>
                                @foreach($articuladoras as $articuladora)
                                <option value="{{ $articuladora->id }}">{{ $articuladora->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                                      <div class="position-relative form-group">
                                        <label for="saude_mental" class="">
                                            Saúde Mental
                                        </label>
                                        <select type="select" name="saude_mental" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option value="ativo">Exclusivo psicologia ativo</option>
                                            <option value="encerrado">Exclusivo psicologia encerrado</option>
                                        </select>
                                      </div>
                                    </div>-->
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
                        <input name="horario_at_psicologia" id="horario_at_psicologia" placeholder="Horário atendimento" type="text" class="form-control hour">
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>
                {{-- <form class=""> --}}

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Nome Completo (obrigatório)
                            </label>
                            <input name="name" id="name" aria-describedby="nameHelp" placeholder="Nome Completo" type="text" class="required form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Nome Social
                            </label>
                            <input name="name_social" id="name_social" placeholder="Nome Social" type="text" class="form-control" value="{{ old('name_social') }}">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Telefone fixo
                            </label>
                            <input name="fone_fixo" id="fone_fixo" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd" value="{{ old('fone_fixo') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="exampleEmail11" class="">
                                Telefone celular
                            </label>
                            <input name="fone_celular" id="fone_celular" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd" value="{{ old('fone_celular') }}">
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
                            <input name="responsavel_residencia" type="text" class=" form-control" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp" value="{{ old('responsavel_residencia') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input name="email" type="email" class=" form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">CEP</label>
                            <input name="endereco_cep" placeholder="Somente números" type="text" class=" form-control cep" id="endereco_cep" value="{{ old('endereco_cep') }}">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Logradouro</label>
                            <input name="endereco_rua" type="text" class=" form-control" id="endereco_rua" value="{{ old('endereco_rua') }}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="name">Número</label>
                            <input name="endereco_numero" type="text" class=" form-control" id="endereco_numero" value="{{ old('endereco_numero') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Complemento</label>
                            <input name="endereco_complemento" type="text" class=" form-control" id="endereco_complemento" value="{{ old('endereco_complemento') }}">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Bairro</label>
                            <input name="endereco_bairro" type="text" class=" form-control" id="endereco_bairro" value="{{ old('endereco_bairro') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Cidade</label>
                            <input name="endereco_cidade" type="text" class=" form-control" id="endereco_cidade" value="{{ old('endereco_cidade') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="name">UF</label>
                            <input name="endereco_uf" type="text" class=" form-control" id="endereco_uf" value="{{ old('endereco_uf') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Ponto de referência</label>
                            <input name="ponto_referencia" type="text" class=" form-control" id="ponto_referencia" value="{{ old('ponto_referencia') }}">
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
                                <option @if(old('identidade_genero')==='mulher cis' ){{ 'selected' }} @endif>mulher cis</option>
                                <option @if(old('identidade_genero')==='mulher trans' ){{ 'selected' }} @endif>mulher trans</option>
                                <option @if(old('identidade_genero')==='homem cis' ){{ 'selected' }} @endif>homem cis</option>
                                <option @if(old('identidade_genero')==='homem trans' ){{ 'selected' }} @endif>homem trans</option>
                                <option @if(old('identidade_genero')==='não-binário' ){{ 'selected' }} @endif>não-binário</option>
                                <option @if(old('identidade_genero')==='outro' ){{ 'selected' }} @endif>outro</option>
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
                                <option @if(old('orientacao_sexual')==='heterossexual' ){{ 'selected' }} @endif>heterossexual</option>
                                <option @if(old('orientacao_sexual')==='homossexual' ){{ 'selected' }} @endif>homossexual</option>
                                <option @if(old('orientacao_sexual')==='bissexual' ){{ 'selected' }} @endif>bissexual</option>
                                <option @if(old('orientacao_sexual')==='outro' ){{ 'selected' }} @endif>outro</option>
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
                                <option @if(old('cor_raca')==='Preta' ){{ 'selected' }} @endif>Preta</option>
                                <option @if(old('cor_raca')==='Parda' ){{ 'selected' }} @endif>Parda</option>
                                <option @if(old('cor_raca')==='Branca' ){{ 'selected' }} @endif>Branca</option>
                                <option @if(old('cor_raca')==='Amarela' ){{ 'selected' }} @endif>Amarela</option>
                                <option @if(old('cor_raca')==='Indígena' ){{ 'selected' }} @endif>Indígena</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Nº Pessoas na Residência</label>
                                <input name="numero_pessoas_residencia" type="number" class=" form-control" id="numero_pessoas_residencia" value="{{ old('numero_pessoas_residencia') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Recebe auxílio emergencial</label>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="sim" @if(old('auxilio_emergencial')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="não" @if(old('auxilio_emergencial')==='não' ){{ 'checked' }} @endif> Não</label></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="renda_residencia">Valor exato da renda familiar</label>
                                <input name="renda_residencia" type="text" placeholder="0.000,00" class=" form-control money" id="renda_residencia" value="{{ old('renda_residencia') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="como_chegou_ao_projeto">Como chegou ao projeto?</label>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="núcleo da Uneafro"> núcleo da Uneafro</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="faixa ou cartaz na rua"> faixa ou cartaz na rua</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="carro ou bicicleta de som"> carro ou bicicleta de som</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="whatsapp"> whatsapp</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="instagram"> instagram</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="facebook"> facebook</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="twitter"> twitter</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="e-mail"> e-mail</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="indicação de amigo, vizinho ou familiar"> indicação de amigo, vizinho ou familiar</label></div>
                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="Outro"> Outro</label></div>
                            <input name="como_chegou_ao_projeto_outro" type="text" placeholder="Outro qual?" class=" form-control" id="como_chegou_ao_projeto_outro">
                        </div>
                        <div class="col">
                            <label for="nucleo_uneafro_qual">Núcleo da Uneafro: qual?</label>
                            <select type="select" id="nucleo_uneafro_qual" name="nucleo_uneafro_qual" class="custom-select">
                                <option value="">Selecione</option>
                                <option>CONCEIÇÃO EVARISTO</option>
                                <option>UNEAFRO YABÁS</option>
                                <option>MANDELA</option>
                                <option>GUERREIROS ALVINÓPOLIS</option>
                                <option>MARIELLE FRANCO</option>
                                <option>KLEBER CRIOULO</option>
                                <option>VILA FÁTIMA</option>
                                <option>UNEAFRO MABEL ASSIS</option>
                                <option>BOM PASTOR</option>
                                <option>UNEAFRO ASSIS</option>
                                <option>MARGARIDA ALVES</option>
                                <option>DONA NAZINHA</option>
                                <option>LUIZA MAHIN</option>
                                <option>CLEMENTINA DE JESUS</option>
                                <option>NÚCLEO LÁ DA LESTE</option>
                                <option>SÉRGIO LAPALOMA</option>
                                <option>SUELI CARNEIRO</option>
                                <option>TIA JURA</option>
                                <option>NOVA PALESTINA</option>
                                <option>RAQUEL TRINDADE</option>
                                <option>ASSATA SHAKUR</option>
                                <option>ILDA MARTINS</option>
                                <option>UNEAFRO MOGI</option>
                                <option>CAROLINA MARIA DE JESUS</option>
                                <option>UNEAFRO NA DISCIPLINA</option>
                                <option>UNEAFRO QUILOMBAQUE</option>
                                <option>XI DE AGOSTO</option>
                                <option>EDUCAÇÃO LIBERTA</option>
                                <option>ROSA PARKS</option>
                                <option>ANTÔNIO CANDEIA FILHO</option>
                                <option>UNEAFRO MSTC</option>
                                <option>UNEAFRO LUZ</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}
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
                                <option @if(old('sintomas_iniciais')==='suspeito' ){{ 'selected' }} @endif>suspeito</option>
                                <option @if(old('sintomas_iniciais')==='confirmado' ){{ 'selected' }} @endif>confirmado</option>
                                <option @if(old('sintomas_iniciais')==='descartado' ){{ 'selected' }} @endif>descartado</option>
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
                                <input type="checkbox" name="teste_utilizado[]" id="pcr" class="custom-control-input" value="PCR" @if(old('teste_utilizado')==='PCR' ){{ 'checked' }} @endif>
                                <label class="custom-control-label" for="pcr">
                                    PCR
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="teste_utilizado[]" id="sorologias" class="custom-control-input" value="sorologias (IgM/IgG)" @if(old('teste_utilizado')==='sorologias (IgM/IgG)' ){{ 'checked' }} @endif>
                                <label class="custom-control-label" for="sorologias">
                                    sorologias (IgM/IgG)
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="teste_utilizado[]" id="teste_rapido" class="custom-control-input" value="teste rápido" @if(old('teste_utilizado')==='teste rápido' ){{ 'checked' }} @endif>
                                <label class="custom-control-label" for="teste_rapido">
                                    Teste Rápido
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="teste_utilizado[]" id="nao_informado" class="custom-control-input" value="não informado" @if(old('teste_utilizado')==='não informado' ){{ 'checked' }} @endif>
                                <label class="custom-control-label" for="nao_informado">
                                    Não Informado
                                </label>
                            </div>
                            <!--<select multiple="" type="select" id="teste_utilizado" name="teste_utilizado[]" class="custom-select">
                                      <option value="">Selecione</option>
                                      <option @if(old('teste_utilizado') === 'PCR' ){{ 'selected' }} @endif>PCR</option>
                                      <option @if(old('teste_utilizado') === 'sorologias (IgM/IgG)' ){{ 'selected' }} @endif>sorologias (IgM/IgG)</option>
                                      <option @if(old('teste_utilizado') === 'teste rápido' ){{ 'selected' }} @endif>teste rápido</option>
                                      <option @if(old('teste_utilizado') === 'não informado' ){{ 'selected' }} @endif>não informado</option>
                                  </select>-->
                            <!--<small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>-->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label for="resultado_teste" class="">
                                Resultados encontrados
                            </label>
                            <br>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="pcr_positivo" class="custom-control-input" value="PCR positivo">
                                <label class="custom-control-label" for="pcr_positivo">
                                    PCR positivo
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="pcr_negativo" class="custom-control-input" value="PCR negativo">
                                <label class="custom-control-label" for="pcr_negativo">
                                    PCR negativo
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="igm_positivo" class="custom-control-input" value="IgM positivo">
                                <label class="custom-control-label" for="igm_positivo">
                                    IgM positivo
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="igm_negativo" class="custom-control-input" value="IgM negativo">
                                <label class="custom-control-label" for="igm_negativo">
                                    IgM negativo
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="igg_positivo" class="custom-control-input" value="IgG positivo">
                                <label class="custom-control-label" for="igg_positivo">
                                    IgG positivo
                                </label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" name="resultado_teste[]" id="igg_negativo" class="custom-control-input" value="IgG negativo">
                                <label class="custom-control-label" for="igg_negativo">
                                    IgG negativo
                                </label>
                            </div>
                            <!--<select type="select" id="resultado_teste" name="resultado_teste" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option @if(old('resultado_teste') === 'PCR positivo' ){{ 'selected' }} @endif>PCR positivo</option>
                                            <option @if(old('resultado_teste') === 'PCR negativo' ){{ 'selected' }} @endif>PCR negativo</option>
                                            <option @if(old('resultado_teste') === 'IgM positivo' ){{ 'selected' }} @endif>IgM positivo</option>
                                            <option @if(old('resultado_teste') === 'IgM negativo' ){{ 'selected' }} @endif>IgM negativo</option>
                                            <option @if(old('resultado_teste') === 'IgG positivo' ){{ 'selected' }} @endif>IgG positivo</option>
                                            <option @if(old('resultado_teste') === 'IgG negativo' ){{ 'selected' }} @endif>IgG negativo</option>
                                        </select>-->
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Outras informações sobre teste</label>
                            <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control">{{ old('outras_informacao') }}</textarea>
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
                            <input type="checkbox" name="doenca_cronica[]" id="hipertensao_arterial_sistemica" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="hipertensao_arterial_sistemica">
                                Hipertensão arterial sistêmica (HAS)
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="diabetes_mellitus" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="diabetes_mellitus">
                                Diabetes Mellitus (DM)
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="dislipidemia" class="custom-control-input" value="3">
                            <label class="custom-control-label" for="dislipidemia">
                                Dislipidemia
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="asma_bronquite" class="custom-control-input" value="4">
                            <label class="custom-control-label" for="asma_bronquite">
                                Asma / Bronquite
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="tuberculose_ativa" class="custom-control-input" value="5">
                            <label class="custom-control-label" for="tuberculose_ativa">
                                Tuberculose ativa
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="cardiopatias_cardiovasculares" class="custom-control-input" value="6">
                            <label class="custom-control-label" for="cardiopatias_cardiovasculares">
                                Cardiopatias e outras doenças cardiovasculares
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="outras_respiratorias" class="custom-control-input" value="7">
                            <label class="custom-control-label" for="outras_respiratorias">
                                Outras doenças Respiratórias
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="artrite_artrose_reumatismo" class="custom-control-input" value="8">
                            <label class="custom-control-label" for="artrite_artrose_reumatismo">
                                Artrite/Artrose/Reumatismo
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="doenca_autoimune" class="custom-control-input" value="9">
                            <label class="custom-control-label" for="doenca_autoimune">
                                Doença autoimune
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="doenca_renal" class="custom-control-input" value="10">
                            <label class="custom-control-label" for="doenca_renal">
                                Doença renal
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="doenca_neurologica" class="custom-control-input" value="11">
                            <label class="custom-control-label" for="doenca_neurologica">
                                Doença neurológica
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="cancer" class="custom-control-input" value="12">
                            <label class="custom-control-label" for="cancer">
                                Câncer
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="ansiedade" class="custom-control-input" value="13">
                            <label class="custom-control-label" for="ansiedade">
                                Ansiedade
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="depressao" class="custom-control-input" value="14">
                            <label class="custom-control-label" for="depressao">
                                Depressão
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="demencia" class="custom-control-input" value="15">
                            <label class="custom-control-label" for="demencia">
                                Demência
                            </label>
                        </div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input type="checkbox" name="doenca_cronica[]" id="outras_questoes_mental" class="custom-control-input" value="16">
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
                            <textarea name="descreve_doencas" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="descreve_doencas" class="form-control">{{ old('descreve_doencas') }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Já teve tuberculose?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="sim" @if(old('tuberculose')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="não" @if(old('tuberculose')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">É tabagista?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="sim" @if(old('tabagista')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="não" @if(old('tabagista')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Faz uso crônico de alcool?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="sim" @if(old('cronico_alcool')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="não" @if(old('cronico_alcool')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Faz uso crônico de outras drogas?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="sim" @if(old('outras_drogas')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="não" @if(old('outras_drogas')==='não' ){{ 'checked' }} @endif> Não</label></div>
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
                                <input name="remedios_consumidos" id="remedios_consumidos" placeholder="Qual(is)?" type="text" class="form-control" value="{{ old('remedios_consumidos') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Está gestante?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="sim" @if(old('gestante')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="não" @if(old('gestante')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Amamenta?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="sim" @if(old('amamenta')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="não" @if(old('amamenta')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Gestação é ou foi de alto risco?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="sim" @if(old('gestacao_alto_risco')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="não" @if(old('gestacao_alto_risco')==='não' ){{ 'checked' }} @endif> Não</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Está no pós-parto (40 dias após o parto)?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="sim" @if(old('pos_parto')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="não" @if(old('pos_parto')==='não' ){{ 'checked' }} @endif> Não</label></div>
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
                                    <option @if(old('trimestre_gestacao')==='1o trimestre' ){{ 'selected' }} @endif>1o trimestre</option>
                                    <option @if(old('trimestre_gestacao')==='2o trimestre' ){{ 'selected' }} @endif>2o trimestre</option>
                                    <option @if(old('trimestre_gestacao')==='3o trimestre' ){{ 'selected' }} @endif>3o trimestre</option>
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
                                <input name="motivo_risco_gravidez" id="motivo_risco_gravidez" placeholder="Qual(is)?" type="text" class="form-control" value="{{ old('motivo_risco_gravidez') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Tem algum acompanhamento médico contínuo?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="sim" @if(old('acompanhamento_medico')==='sim' ){{ 'checked' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="não" @if(old('acompanhamento_medico')==='não' ){{ 'checked' }} @endif> Não</label></div>
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
                                    <input type="checkbox" name="sistema_saude[]" id="sus" class="custom-control-input" value="É usuária/o do SUS (público)" @if(old('sistema_saude')==='É usuária/o do SUS (público)' ){{ 'checked' }} @endif>
                                    <label class="custom-control-label" for="sus">
                                        É usuária/o do SUS (público)
                                    </label>
                                </div>
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input type="checkbox" name="sistema_saude[]" id="convenio" class="custom-control-input" value="Tem convênio/plano de saúde" @if(old('sistema_saude')==='Tem convênio/plano de saúde' ){{ 'checked' }} @endif>
                                    <label class="custom-control-label" for="convenio">
                                        Tem convênio/plano de saúde
                                    </label>
                                </div>
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input type="checkbox" name="sistema_saude[]" id="pagos_populares" class="custom-control-input" value="Usuária/o de serviços pagos " populares" (Ex: Dr Consulta)" @if(old('sistema_saude')==='Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)' ){{ 'checked' }} @endif>
                                    <label class="custom-control-label" for="pagos_populares">
                                        Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)
                                    </label>
                                </div>
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input type="checkbox" name="sistema_saude[]" id="particulares" class="custom-control-input" value="Usuária/o de serviços particulares não cobertos por convênios" @if(old('sistema_saude')==='Usuária/o de serviços particulares não cobertos por convênios' ){{ 'checked' }} @endif>
                                    <label class="custom-control-label" for="particulares">
                                        Usuária/o de serviços particulares não cobertos por convênios
                                    </label>
                                </div>
                                <!--<select multiple="" type="select" id="sistema_saude" name="sistema_saude[]" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option @if(old('sistema_saude') === 'É usuária/o do SUS (público)'){{ 'selected' }} @endif>É usuária/o do SUS (público)</option>
                                                <option @if(old('sistema_saude') === 'Tem convênio/plano de saúde'){{ 'selected' }} @endif>Tem convênio/plano de saúde</option>
                                                <option @if(old('sistema_saude') === 'Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)'){{ 'selected' }} @endif>Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)</option>
                                                <option @if(old('sistema_saude') === 'Usuária/o de serviços particulares não cobertos por convênios'){{ 'selected' }} @endif>Usuária/o de serviços particulares não cobertos por convênios</option>
                                            </select>
                                            <small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>-->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div class="form-group">
                                    <label for="name">Tem acompanhamento médico na Unidade Básica de Saúde (UBS - posto) de referência?</label>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="sim" @if(old('acompanhamento_ubs')==='sim' ){{ 'selected' }} @endif> Sim</label></div>
                                    <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="não" @if(old('acompanhamento_ubs')==='não' ){{ 'selected' }} @endif> Não</label></div>
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
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script>
    $('.temperature').mask('00,0');
    $('.saturation').mask('00');
    $('.hour').mask('00:00');
    $('.info').css('cursor', 'pointer');
    $('.info').click(function() {
        $(this).fadeOut();
    })

    //VIACEP
    function limpa_formulário_cep() {
        $("#address_street").val("");
        $("#address_neighborhood").val("");
        $("#address_city").val("");
        $("#address_state").val("");
    }

    $("#endereco_cep").blur(function() {
        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $("#endereco_rua").val("...");
                $("#endereco_bairro").val("...");
                $("#endereco_cidade").val("...");
                $("#endereco_uf").val("...");

                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        $("#endereco_rua").val(dados.logradouro);
                        $("#endereco_bairro").val(dados.bairro);
                        $("#endereco_cidade").val(dados.localidade);
                        $("#endereco_uf").val(dados.uf);
                    } else {
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    });
    //VIACEP FIM
</script>
@endsection
