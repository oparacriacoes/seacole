<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>
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
    </div>
</div>
