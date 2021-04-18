<form id="monitoramento_form" action="{{ route('paciente.monitoramento', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-6">
            <x-forms.input-date property="data_monitoramento" :value="$monitoramento->data_monitoramento">
                Data do monitoramento
            </x-forms.input-date>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="horario_monitoramento">Horário do monitoramento</label>
                <input name="horario_monitoramento" type="time" class="form-control" id="horario_monitoramento" value="{{ old('horario_monotiramento', $monitoramento->horario_monitoramento) }}">
            </div>
        </div>
        <div class="col-md-12">
            <x-forms.choices.sintomas-atuais :value="$monitoramento->sintomas_atuais" />
            <div class="form-group">
                <input name="sintomas_outro" class="form-control" type="text" maxlength="190" placeholder="Outro (digite)" value="{{ old('sintomas_outro', $monitoramento->sintomas_outro) }}">
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="temperatura_atual">Temperatura atual (em graus)</label>
                <input name="temperatura_atual" type="number" placeholder="00,0" step="00.1" max="999.9" min="0" class=" form-control" id="temperatura_atual" value="{{ old('temperatura_atual', $monitoramento->temperatura_atual) }}">
            </div>
            <div class="form-group">
                <label for="frequencia_cardiaca_atual">Frequência cardíaca atual</label>
                <input name="frequencia_cardiaca_atual" type="number" max="999" min="0" placeholder="-- bpm" class="form-control" id="frequencia_cardiaca_atual" value="{{ old('temperatura_atual', $monitoramento->frequencia_cardiaca_atual) }}">
            </div>
            <x-forms.choices.yes-or-not :value="$monitoramento->algum_sinal" property="algum_sinal">
                Algum sinal de gravidade nesse monitoramento?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="saturacao_atual">Saturação atual (%)</label>
                <input name="saturacao_atual" type="number" min="0" max="100" placeholder="00%" class=" form-control" id="saturacao_atual" value="{{ old('saturacao_atual', $monitoramento->saturacao_atual) }}">
            </div>
            <div class="form-group">
                <label for="pressao_arterial_atual">Pressão Arterial Atual</label>
                <input name="pressao_arterial_atual" type="text" placeholder="Ex: 12x8" class=" form-control" id="pressao_arterial_atual" value="{{ old('pressao_arterial_atual', $monitoramento->pressao_arterial_atual) }}">
            </div>
            <x-forms.choices.yes-or-not :value="$monitoramento->equipe_medica" property="equipe_medica">
                Equipe médica do projeto prescreveu algum medicamento?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="frequencia_respiratoria_atual">Frequência respiratória atual</label>
                <input name="frequencia_respiratoria_atual" type="number" max="99" placeholder="-- rpm" class="form-control" id="frequencia_respiratoria_atual" value="{{old('frequencia_respiratoria_atual', $monitoramento->frequencia_respiratoria_atual) }}">
            </div>
            <div class="form-group">
                <label for="medicamento">Medicamento prescrito pela equipe médica do projeto</label>
                <textarea name="medicamento" id="medicamento" class="form-control">{{old('medicamento', $monitoramento->medicamento) }}</textarea>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-6">
                    <x-forms.choices.yes-or-not :value="$monitoramento->fazendo_uso_pic" property="fazendo_uso_pic">
                    Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?
                    </x-forms.choices.yes-or-not>
                </div>
                <div class="col-md-6">
                    <x-forms.choices.yes-or-not :value="$monitoramento->fez_escalapes" property="fez_escalapes">
                        Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)
                    </x-forms.choices.yes-or-not>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <x-forms.choices.melhoras-com-escaldapes :value="$monitoramento->melhora_sintoma_escaldapes" />
                </div>
                <div class="col-md-3">
                    <x-forms.choices.fez-inalacao :value="$monitoramento->fes_inalacao" />
                </div>
                <div class="col-md-3">
                    <x-forms.choices.melhoras-com-inalacao :value="$monitoramento->melhoria_sintomas_inalacao" />
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    *Consideramos um caso grave quando a pessoa reportar DESCONFORTO RESPIRATÓRIO IMPORTANTE, DOR TORÁCICA (DOR NO PEITO), CANSAÇO OU SONOLÊNCIA IMPORTANTES, QUEDA BRUSCA DE PRESSÃO, QUEDA DA SATURAÇÃO ABAIXO DE 93%, FREQUÊNCIA RESPIRATÓRIA ACIMA DE 24rpm (respirações por minuto), CONFUSÃO MENTAL, DESMAIO, CONVULSÕES. No caso de novo sinal de gravidade: assinalar no início do prontuário "Caso Ativo Grave".
                </div>
            </div>

            <div class="position-relatives row fdorm-check">
                <div class="col-sm-12 offset-sm-2s"><br />
                    <button class="btn btn-secondary">Enviar</button>
                </div>
            </div>
</form>
