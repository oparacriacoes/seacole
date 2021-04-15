<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">
            (Sentinela-Vigilancia) DIAGNÓSTICO DE COVID-19
        </h5>
        <div class="form-row">
            <div class="col-md-3">
                <x-forms.choices.sintoma-inicial :value="$paciente->sintomas_iniciais" />
            </div>
            <div class="col-md-3">
                <x-forms.input-date property="data_teste_confirmatorio" :value="$paciente->data_teste_confirmatorio">
                    Data do teste confirmatório
                </x-forms.input-date>
            </div>
            <div class="col-md-3">
                <x-forms.choices.teste-realizado :value="$paciente->teste_utilizado ?? []" />
            </div>

            <div class="col-md-3">
                <x-forms.choices.resultado-encontrado :value="$paciente->resultado_teste ?? []" />
            </div>


        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Outras informações sobre teste</label>
                    <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control">{{ old('outras_informacao', $paciente->outras_informacao) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
