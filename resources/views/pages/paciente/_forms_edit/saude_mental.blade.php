<form action="{{ route('paciente.saude-mental', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-12">
            <x-forms.choices.yes-or-not :value="$saude_mental->quadro_atual" property="quadro_atual">
                Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?
            </x-forms.choices.yes-or-not>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="detalhes_medos">Escreva sobre o estado emocional e detalhe os medos</label>
                <textarea name="detalhes_medos" id="detalhes_medos" class="form-control">{{old('detalhes_medos', $saude_mental->detalhes_medos)}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-sm-2s pt-2">
            <button class="btn btn-success">Salvar</button>
        </div>
    </div>
</form>
