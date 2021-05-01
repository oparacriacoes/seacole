<form id="internacao_form" action="{{ route('paciente.internacao', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-6">
            <x-forms.choices.servico-saude :value="$servico_internacao->precisou_servico ?? []" property="precisou_servico"/>
            <div class="form-check form-check-inline">
                <input name="precisou_servico_outro" class="form-control" type="text" placeholder="Outro" value="{{ old('precisou_servico_outro', $servico_internacao->precisou_servico_outro) }}">
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
            <x-forms.choices.medicacao-tratamento-covid :value="$servico_internacao->recebeu_med_covid ?? []"/>
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
            <x-forms.choices.servico-saude :value="$servico_internacao->teve_algum_problema ?? []" property="teve_algum_problema"/>
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
            <x-forms.choices.yes-or-not :value="$servico_internacao->precisou_internacao" property="precisou_internacao">
                Precisou de internação pelo quadro (suspeito ou confirmado)?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-6">
            <x-forms.choices.yes-or-not :value="$servico_internacao->precisou_ambulancia" property="precisou_ambulancia">
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
                <input name="tempo_internacao" id="tempo_internacao" placeholder="Em dias" type="number" class="form-control" value="{{ old('tempo_internacao', $servico_internacao->tempo_internacao) }}">
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
            <x-forms.choices.local-internacao :value="$servico_internacao->local_internacao ?? []" />
        </div>
    </div>


    <div class="position-relatives row">
        <div class="col-sm-12 pt-2">
            <button class="btn btn-success">Salvar</button>
        </div>
    </div>
</form>
