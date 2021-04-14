<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">
                        Nome Completo (obrigatório)
                    </label>
                    <input name="name" id="name" aria-describedby="nameHelp" placeholder="Nome Completo" type="text" class="required form-control" value="{{ old('name', $paciente->name) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">
                        Nome Social
                    </label>
                    <input name="name_social" id="name_social" placeholder="Nome Social" type="text" class="form-control" value="{{ old('name_social', $paciente->name_social) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">
                        Telefone fixo
                    </label>
                    <input name="fone_fixo" id="fone_fixo" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd" value="{{ old('fone_fixo', $paciente->fone_fixo) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">
                        Telefone celular
                    </label>
                    <input name="fone_celular" id="fone_celular" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd" value="{{ old('fone_celular', $paciente->fone_celular) }}">
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
                    <input name="responsavel_residencia" type="text" class=" form-control" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp" value="{{ old('responsavel_residencia', $paciente->responsavel_residencia) }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Email</label>
                    <input name="email" type="email" class=" form-control" id="email" aria-describedby="emailHelp" value="{{ old('email', $paciente->email) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">CEP</label>
                    <input name="endereco_cep" placeholder="Somente números" type="text" class=" form-control cep" id="endereco_cep" value="{{ old('endereco_cep', $paciente->endereco_cep) }}">
                </div>
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Logradouro</label>
                    <input name="endereco_rua" type="text" class=" form-control" id="endereco_rua" value="{{ old('endereco_rua', $paciente->endereco_rua) }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="name">Número</label>
                    <input name="endereco_numero" type="text" class=" form-control" id="endereco_numero" value="{{ old('endereco_numero', $paciente->endereco_numero) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Complemento</label>
                    <input name="endereco_complemento" type="text" class=" form-control" id="endereco_complemento" value="{{ old('endereco_complemento, $paciente->endereco_complemento') }}">
                </div>
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Bairro</label>
                    <input name="endereco_bairro" type="text" class=" form-control" id="endereco_bairro" value="{{ old('endereco_bairro', $paciente->endereco_bairro) }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Cidade</label>
                    <input name="endereco_cidade" type="text" class=" form-control" id="endereco_cidade" value="{{ old('endereco_cidade, $paciente->endereco_cidade') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="name">UF</label>
                    <input name="endereco_uf" type="text" class=" form-control" id="endereco_uf" value="{{ old('endereco_uf', $paciente->endereco_uf) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Ponto de referência</label>
                    <input name="ponto_referencia" type="text" class=" form-control" id="ponto_referencia" value="{{ old('ponto_referencia', $paciente->ponto_referencia) }}">
                </div>
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-4">
                <x-forms.choices.identidade-genero :value="$paciente->identidade_genero" />
            </div>
            <div class="col-md-4">
                <x-forms.choices.orientacao-sexual :value="$paciente->orientacao_sexual" />
            </div>
            <div class="col-md-4">
                <x-forms.choices.raca-cor :value="$paciente->cor_raca" />
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nº Pessoas na Residência</label>
                        <input name="numero_pessoas_residencia" type="number" class=" form-control" id="numero_pessoas_residencia" value="{{ old('numero_pessoas_residencia', $paciente->numero_pessoas_residencia) }}">
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
                        <input name="renda_residencia" type="text" placeholder="0.000,00" class=" form-control money" id="renda_residencia" value="{{ old('renda_residencia', $paciente->renda_residencia) }}">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <x-forms.choices.chegada-projeto :value="$paciente->como_chegou_ao_projeto_outro ?? []" />
                    <input name="como_chegou_ao_projeto_outro" type="text" placeholder="Outro? qual?" class=" form-control" id="como_chegou_ao_projeto_outro" value="{{old('como_chegou_ao_projeto_outro', $paciente->como_chegou_ao_projeto_outro)}}">
                </div>
                <div class="col">
                    <x-forms.choices.nucleo-uneafro :value="$paciente->nucleo_uneafro_qual" />
                </div>
            </div>
        </div>
    </div>
</div>
