<form id="internacao_form" action="{{ route('paciente.internacao', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="precisou_servico">A pessoa precisou ir a algum serviço de saúde?</label><br />
                <div class="form-check form-check-inline">
                    <input name="precisou_servico[]" class="form-check-input" id="ubs" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)" <?php if ($internacao_servico && in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $internacao_servico)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="ubs">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisou_servico[]" class="form-check-input" id="upa" type="checkbox" value="UPA (Unidade de Pronto Atendimento)" <?php if ($internacao_servico && in_array('UPA (Unidade de Pronto Atendimento)', $internacao_servico)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="upa">UPA (Unidade de Pronto Atendimento)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisou_servico[]" class="form-check-input" id="ama" type="checkbox" value="ama" <?php if ($internacao_servico && in_array('ama', $internacao_servico)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="ama">AMA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisou_servico[]" class="form-check-input" id="hospital_publico" type="checkbox" value="Hospital público" <?php if ($internacao_servico && in_array('Hospital público', $internacao_servico)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_publico">Hospital público</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisou_servico[]" class="form-check-input" id="hospital_privado" type="checkbox" value="hospital privado" <?php if ($internacao_servico && in_array('hospital privado', $internacao_servico)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_privado">Hospital privado</label>
                </div>
                <br>
                <div class="form-check form-check-inline">
                    <input name="precisou_servico_outro" class="form-control" type="text" placeholder="Outro" value="{{ old('precisou_servico_outro', $servico_internacao->precisou_servico_outro) }}">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="quant_ida_servico">Idas aos serviços de saúde</label>
                <input name="quant_ida_servico" type="number" min="0" class="form-control" id="quant_ida_servico" value="{{ old('quant_ida_servico', $servico_internacao->quant_ida_servico) }}">
            </div>
        </div>
        <div class="col-md-3">
            <x-forms.input-date property="data_ultima_ida_servico_de_saude" :value="$servico_internacao->data_ultima_ida_servico_de_saude">
                Última ida a serviço de saúde
            </x-forms.input-date>
        </div>
    </div>

    <div class="divider">
    </div>


    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="recebeu_med_covid"><strong>Recebeu medicações para tratar COVID-19?</strong></label><br />
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" id="azitromicina" type="checkbox" value="Azitromicina" <?php if ($internacao_remedio && in_array('Azitromicina', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="azitromicina">Azitromicina</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" id="outro_antibiotico" type="checkbox" value="outro antibiótico" <?php if ($internacao_remedio && in_array('outro antibiótico', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="outro_antibiotico">Outro antibiótico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" id="ivermectina" type="checkbox" value="ivermectina" <?php if ($internacao_remedio && in_array('ivermectina', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="ivermectina">Ivermectina</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="cloroquina/hidroxicloroquina" <?php if ($internacao_remedio && in_array('cloroquina/hidroxicloroquina', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Cloroquina/Hidroxicloroquina</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="oseltamivir (tamiflu)" <?php if ($internacao_remedio && in_array('oseltamivir (tamiflu)', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Oseltamivir (Tamiflu)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum antialérgico" <?php if ($internacao_remedio && in_array('algum antialérgico', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Algum antialérgico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum corticóide" <?php if ($internacao_remedio && in_array('algum corticóide', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Algum corticóide</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum antiinflamatório" <?php if ($internacao_remedio && in_array('algum antiinflamatório', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Algum antiinflamatório</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="vitamina D" <?php if ($internacao_remedio && in_array('vitamina D', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Vitamina D</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="zinco" <?php if ($internacao_remedio && in_array('zinco', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Zinco</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="outro medicamento" <?php if ($internacao_remedio && in_array('outro medicamento', $internacao_remedio)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Outro medicamento</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome_medicamento">Escreva o nome do medicamento prescrito</label>
                <textarea name="nome_medicamento" id="nome_medicamento" class="form-control">{{ old('nome_medicamento', $servico_internacao->nome_medicamento) }}</textarea>
            </div>
        </div>
    </div>

    <div class="divider">
    </div>


    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="teve_algum_problema"><strong>A pessoa teve algum problema com serviços de referência?</strong></label><br />
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" id="ubs2" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)" <?php if ($internacao_problema && in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="ubs2">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" id="upa2" type="checkbox" value="UPA (Unidade de Pronto Atendimento)" <?php if ($internacao_problema && in_array('UPA (Unidade de Pronto Atendimento)', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="upa2">UPA (Unidade de Pronto Atendimento)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" id="ama2" type="checkbox" value="ama" <?php if ($internacao_problema && in_array('ama', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="ama2">AMA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" id="hospital_publico_2" type="checkbox" value="Hospital público" <?php if ($internacao_problema && in_array('Hospital público', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_publico_2">Hospital público</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" id="hospital_privado_2" type="checkbox" value="Hospital privado" <?php if ($internacao_problema && in_array('Hospital privado', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_privado_2">Hospital privado</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="teve_algum_problema[]" class="form-check-input" type="checkbox" value="Outro (qual?)" <?php if ($internacao_problema && in_array('Outro (qual?)', $internacao_problema)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="teve_algum_problema[]">Outro (qual?)</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="descreva_problema">Descreva o problema</label>
                <textarea name="descreva_problema" id="descreva_problema" class="form-control">{{ old('descreva_problema', $servico_internacao->descreva_problema) }}</textarea>
            </div>
        </div>
    </div>

    <div class="divider">
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <x-forms.choices.yes-or-not :value="$servico_internacao->precisou_internacao" propery="precisou_internacao">
                Precisou de internação pelo quadro (suspeito ou confirmado)?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-6">
            <x-forms.choices.yes-or-not :value="$servico_internacao->precisou_ambulancia" propery="precisou_ambulancia">
                Precisou de ambulância financiada pelo projeto?
            </x-forms.choices.yes-or-not>
        </div>
    </div>

    <div class="divider">
    </div>

    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome_hospital">Nome do Hospital de internação</label>
                <input name="nome_hospital" id="nome_hospital" type="text" class="form-control" value="{{ old('nome_hospital', $servico_internacao->nome_hospital) }}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="tempo_internacao">Tempo de internação</label>
                <input name="tempo_internacao" id="tempo_internacao" placeholder="Em dias" type="number" class="form-control" value="old('tempo_internacao', $servico_internacao->tempo_internacao)">
            </div>
        </div>
        <div class="col-md-3">
            <x-forms.input-date property="data_entrada_internacao" :value="$servico_internacao->data_entrada_internacao">
                Entrada da internação
            </x-forms.input-date>
        </div>
        <div class="col-md-3">
            <x-forms.input-date property="data_alta_hospitalar" :value="$servico_internacao->data_alta_hospitalar">
                Início monitoramento Agentes
            </x-forms.input-date>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="local_internacao"><strong>Local de internação</strong></label><br />
                <div class="form-check form-check-inline">
                    <input name="local_internacao[]" class="form-check-input" id="hospital_publico_referencia" type="checkbox" value="Hospital público de referência" <?php if ($internacao_local && in_array('Hospital público de referência', $internacao_local)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_publico_referencia">Hospital público de referência</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="local_internacao[]" class="form-check-input" id="hospital_campanha" type="checkbox" value="Hospital de campanha" <?php if ($internacao_local && in_array('Hospital de campanha', $internacao_local)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="hospital_campanha">Hospital de campanha</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="local_internacao[]" class="form-check-input" id="hospital_particular_referencia" type="checkbox" value="Hospital particular de referência" <?php if ($internacao_local && in_array('Hospital particular de referência', $internacao_local)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="febre">Hospital particular de referência</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="local_internacao[]" class="form-check-input" type="checkbox" value="Hospital municipal do Ipiranga (encaminhado pelo projeto)" <?php if ($internacao_local && in_array('Hospital municipal do Ipiranga (encaminhado pelo projeto)', $internacao_local)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Hospital municipal do Ipiranga (encaminhado pelo projeto)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="local_internacao[]" class="form-check-input" type="checkbox" value="Hospital privado financiado pelo projeto" <?php if ($internacao_local && in_array('Hospital privado financiado pelo projeto', $internacao_local)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Hospital privado financiado pelo projeto</label>
                </div>
            </div>
        </div>
    </div>


    <div class="position-relatives row form-check">
        <div class="col-sm-12 pt-2">
            <button class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
