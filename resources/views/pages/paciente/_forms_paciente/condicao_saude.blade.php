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
                        Data do parto
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
