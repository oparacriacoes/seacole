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
                    <x-forms.choices.yes-or-not :value="$paciente->tuberculose" property="tuberculose">
                        Já teve tuberculose?
                    </x-forms.choices.yes-or-not>
                </div>
                <div class="col-md-3">
                    <x-forms.choices.yes-or-not :value="$paciente->tabagista" property="tabagista">
                        É tabagista?
                    </x-forms.choices.yes-or-not>
                </div>
                <div class="col-md-3">
                    <x-forms.choices.yes-or-not :value="$paciente->cronico_alcool" property="cronico_alcool">
                        Faz uso crônico de alcool?
                    </x-forms.choices.yes-or-not>
                </div>
                <div class="col-md-3">
                    <x-forms.choices.yes-or-not :value="$paciente->outras_drogas" property="outras_drogas">
                        Faz uso crônico de outras drogas?
                    </x-forms.choices.yes-or-not>
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
                    <x-forms.choices.yes-or-not :value="$paciente->gestante" property="gestante">
                        Está gestante?
                    </x-forms.choices.yes-or-not>
                </div>

                <div class="col-md-2">
                    <x-forms.choices.yes-or-not :value="$paciente->amamenta" property="amamenta">
                        Amamenta?
                    </x-forms.choices.yes-or-not>
                </div>

                <div class="col-md-3">
                    <x-forms.choices.yes-or-not :value="$paciente->gestacao_alto_risco" property="gestacao_alto_risco">
                        Gestação é ou foi de alto risco?
                    </x-forms.choices.yes-or-not>
                </div>
                <div class="col-md-4">
                    <x-forms.choices.yes-or-not :value="$paciente->pos_parto" property="pos_parto">
                        Está no pós-parto (40 dias após o parto)?
                    </x-forms.choices.yes-or-not>
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
                    <x-forms.choices.yes-or-not :value="$paciente->acompanhamento_medico" property="acompanhamento_medico">
                        Tem algum acompanhamento médico contínuo?
                    </x-forms.choices.yes-or-not>
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
                    <x-forms.choices.yes-or-not :value="$paciente->acompanhamento_ubs" property="acompanhamento_ubs">
                        Tem acompanhamento médico na Unidade Básica de Saúde (UBS - posto) de referência?
                    </x-forms.choices.yes-or-not>
                </div>
            </div>
        </div>

        <div class="position-relatives row fdorm-check">
            <div class="col-sm-12 offset-sm-2s"><br />
                <button type="submit" class="btn btn-primary">Salva</button>
            </div>
        </div>
    </div>
</div>
