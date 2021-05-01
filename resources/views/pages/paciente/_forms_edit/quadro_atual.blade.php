<form id="createPacienteQAForm" method="POST" action="{{ route('paciente.quadro-atual', $paciente) }}">
    @csrf
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Quadro atual</h5>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="primeira_sintoma">Primeiros sintomas</label>
                        <textarea name="primeira_sintoma" placeholder="Descreva a evolução dos sintomas do início do quadro até o primeiro registro" id="primeira_sintoma" class="form-control">{{ old('primeiro_sintoma', $quadro_atual->primeira_sintoma) }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <x-forms.choices.sintomas-manifestado :value="$quadro_atual->sintomas_manifestados ?? []" />
                </div>
            </div>

            <div class="divider"></div>

            <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="temperatura_max">Temperatura máxima (em graus)</label>
                        <input name="temperatura_max" type="number" placeholder="00.00" min="0.00" max="999.99" step="0.01" class="form-control temperature" id="temperatura_max" value="{{ old('temperatura_max', $quadro_atual->temperatura_max) }}">
                    </div>
                    <x-forms.input-date property="data_temp_max" :value="$quadro_atual->data_temp_max">
                        Data temperatura máxima
                    </x-forms.input-date>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="saturacao_baixa">Saturação mais baixa registrada (%)</label>
                        <input name="saturacao_baixa" type="number" min="0" max="999" placeholder="0" class=" form-control saturation" id="saturacao_baixa" value="{{ old('saturacao_baixa', $quadro_atual->saturacao_baixa) }}">
                    </div>
                    <x-forms.input-date property="data_sat_max" :value="$quadro_atual->data_sat_max">
                        Data da saturação mais baixa
                    </x-forms.input-date>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="frequencia_max">Frequência respiratória máxima</label>
                        <input name="frequencia_max" type="number" min="0" max="999" class=" form-control" id="frequencia_max" value="{{ old('frequencia_max', $quadro_atual->frequencia_max) }}">
                    </div>
                    <x-forms.input-date property="data_freq_max" :value="$quadro_atual->data_freq_max">
                        Data da Frequência respiratória máxima
                    </x-forms.input-date>
                </div>
            </div>

            <div class="divider"></div>

            <div class="form-row">
                <div class="col-12 col-md-4">
                    <x-forms.choices.desfecho :value="$quadro_atual->desfecho ?? []" />
                </div>
                <div class="col-12 col-md-8">
                    <x-forms.choices.sequela :value="$quadro_atual->sequelas ?? []" />
                    <input name="outra_sequela_qual" type="text" placeholder="Outros: quais?" class=" form-control" id="outra_sequela_qual" value="{{ old('outra_sequela_qual', $quadro_atual->outra_sequela_qual) }}">
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="algo_mais_sobre_caso">Algo mais que queira descrever sobre o caso? </label>
                        <textarea name="algo_mais_sobre_caso" id="algo_mais_sobre_caso" class="form-control">{{ old('algo_mais_sobre_caso', $quadro_atual->algo_mais_sobre_caso) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="position-relative row">
                <div class="col-sm-12 mt-2">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>

    </div>
</form>
