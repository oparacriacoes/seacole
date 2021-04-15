<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">CONDIÇÕES DE SAÚDE</h5>
        <x-forms.choices.doencas-cronicas :value="$paciente->doenca_cronica ?? []" />

        <div class="position-relative form-group">
            <label for="exampleCustomSelect" class="">
                Descreva as doenças assinaladas
            </label>

            <div class="position-relative row form-group">
                <div class="col-sm-10">
                    <textarea name="descreve_doencas" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="descreve_doencas" class="form-control">{{ old('descreve_doencas', $paciente->descreve_doencas) }}</textarea>
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
                        <input name="remedios_consumidos" id="remedios_consumidos" placeholder="Qual(is)?" type="text" class="form-control" value="{{ old('remedios_consumidos', $paciente->remedios_consumidos) }}">
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
                        Data do parto
                    </x-forms.input-date>
                </div>

                <div class="col-md-3">
                    <x-forms.input-date property="data_ultima_mestrucao" :value="$paciente->data_ultima_mestrucao">
                        Data da última menstruação (DUM)
                    </x-forms.input-date>
                </div>

                <div class="col-md-4">
                    <x-forms.choices.trimestre-gestacao :value="$paciente->trimestre_gestacao" />
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group">
                        <label for="exampleEmail11" class="">
                            Motivo do risco elevado na gravidez
                        </label>
                        <input name="motivo_risco_gravidez" id="motivo_risco_gravidez" placeholder="Qual(is)?" type="text" class="form-control" value="{{ old('motivo_risco_gravidez', $paciente->motivo_risco_gravidez) }}">
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
                    <x-forms.choices.acesso-sistema-saude :value="$paciente->sistema_saude ?? []" />
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
