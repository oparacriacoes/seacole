<form id="insumo_form" action="{{ route('paciente.insumos', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-3">
            <x-forms.choices.yes-or-not :value="$insumos->condicao_ficar_isolada" property="condicao_ficar_isolada">
                Há condição de ficar isolada, sozinha, em um cômodo da casa?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-3">
            <x-forms.choices.yes-or-not :value="$insumos->tem_comida" property="tem_comida">
                Tem comida disponível, sem precisar sair?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-3">
            <x-forms.choices.yes-or-not :value="$insumos->tem_alguem" property="tem_alguem">
                Tem alguém para auxiliá-lo(a)?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-3">
            <x-forms.choices.yes-or-not :value="$insumos->tarefas_autocuidado" property="tarefas_autocuidado">
                Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)
            </x-forms.choices.yes-or-not>
        </div>
    </div>

    <div class="position-relatives row fdorm-check">
        <div class="col-sm-12 offset-sm-2s pt-3">
            <button class="btn btn-success">Salvar</button>
        </div>
    </div>
</form>
