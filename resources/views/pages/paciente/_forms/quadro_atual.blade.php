<form id="createPacienteQAForm" method="POST" action="{{ route('paciente.quadro-atual') }}">
    @csrf
    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Quadro atual</h5>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="primeira_sintoma">Primeiros sintomas</label>
                        <textarea name="primeira_sintoma" placeholder="descreva a evolução dos sintomas do início do quadro até o primeiro registro" id="primeira_sintoma" class="form-control">@if($quadro) {{ $quadro->primeira_sintoma }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sintomas_manifestados">Sintomas manifestados</label><br />
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="tosse" type="checkbox" value="tosse" <?php if ($sintomas_quadro && in_array('tosse', $sintomas_quadro)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="tosse">Tosse</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar" <?php if ($sintomas_quadro && in_array('falta de ar', $sintomas_quadro)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="form-check-label" for="febre">Falta de ar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="febre" type="checkbox" value="febre" <?php if ($sintomas_quadro && in_array('febre', $sintomas_quadro)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="febre">Febre</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="dor de cabeça" <?php if ($sintomas_quadro && in_array('dor de cabeça', $sintomas_quadro)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="perda de olfato" <?php if ($sintomas_quadro && in_array('perda de olfato', $sintomas_quadro)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="inlineCheckbox3">Perda do olfato</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="perda do paladar" <?php if ($sintomas_quadro && in_array('perda do paladar', $sintomas_quadro)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="inlineCheckbox3">Perda do paladar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="enjoo" <?php if ($sintomas_quadro && in_array('enjoo', $sintomas_quadro)) {
                                                                                                                                echo 'checked=checked';
                                                                                                                            } ?>>
                            <label class="form-check-label" for="inlineCheckbox3">Enjoo ou vômitos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="diarreia" type="checkbox" value="diarreia" <?php if ($sintomas_quadro && in_array('diarreia', $sintomas_quadro)) {
                                                                                                                                                echo 'checked=checked';
                                                                                                                                            } ?>>
                            <label class="form-check-label" for="diarreia">Diarréia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="aumento_da_pressao" type="checkbox" value="aumento da pressão" <?php if ($sintomas_quadro && in_array('aumento da pressão', $sintomas_quadro)) {
                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                } ?>>
                            <label class="form-check-label" for="aumento_da_pressao">Aumento da pressão</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="queda_brusca_de_pressao" type="checkbox" value="queda brusca de Pressão" <?php if ($sintomas_quadro && in_array('queda brusca de Pressão', $sintomas_quadro)) {
                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                        } ?>>
                            <label class="form-check-label" for="sonolencia">Queda brusca de Pressão</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa" <?php if ($sintomas_quadro && in_array('pressão baixa', $sintomas_quadro)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                            <label class="form-check-label" for="pressao_baixa">Dor torácica (dor no peito) </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="sonolência_cansaco_importantes" type="checkbox" value="sonolência ou cansaço importantes" <?php if ($sintomas_quadro && in_array('sonolência ou cansaço importantes', $sintomas_quadro)) {
                                                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                                                            } ?>>
                            <label class="form-check-label" for="sonolência_cansaco_importantes">Sonolência ou cansaço importantes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="confusao_mental" type="checkbox" value="confusão mental" <?php if ($sintomas_quadro && in_array('confusão mental', $sintomas_quadro)) {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } ?>>
                            <label class="form-check-label" for="confusao_mental">Confusão mental</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="desmaio" type="checkbox" value="desmaio" <?php if ($sintomas_quadro && in_array('desmaio', $sintomas_quadro)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                            <label class="form-check-label" for="desmaio">Desmaio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="convulsao" type="checkbox" value="convulsao" <?php if ($sintomas_quadro && in_array('convulsao', $sintomas_quadro)) {
                                                                                                                                                echo 'checked=checked';
                                                                                                                                            } ?>>
                            <label class="form-check-label" for="convulsao">Convulsão</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sintomas_manifestados[]" class="form-check-input" id="outros" type="checkbox" value="outros" <?php if ($sintomas_quadro && in_array('outros', $sintomas_quadro)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                            <label class="form-check-label" for="outros">Outros</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="temperatura_max">Temperatura máxima (em graus)</label>
                        <input name="temperatura_max" type="text" placeholder="00,0" class="form-control temperature" id="temperatura_max" value="@if($quadro) {{ $quadro->temperatura_max }} @endif">
                    </div>
                    <x-forms.input-date property="data_temp_max" :value="$quadro->data_temp_max">
                        Data temperatura máxima
                    </x-forms.input-date>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="saturacao_baixa">Saturação mais baixa registrada (%)</label>
                        <input name="saturacao_baixa" type="text" placeholder="00 %" class=" form-control saturation" id="saturacao_baixa" value="@if($quadro) {{ $quadro->saturacao_baixa }} @endif">
                    </div>
                    <x-forms.input-date property="data_sat_max" :value="$quadro->data_sat_max">
                        Data da saturação mais baixa
                    </x-forms.input-date>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="frequencia_max">Frequência respiratória máxima</label>
                        <input name="frequencia_max" type="text" placeholder="respirações por minuto - rpm" class=" form-control" id="frequencia_max" value="@if($quadro) {{ $quadro->frequencia_max }} @endif">
                    </div>
                    <x-forms.input-date property="data_freq_max" :value="$quadro->data_freq_max">
                        Data da Frequência respiratória máxima
                    </x-forms.input-date>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12 col-md-4">
                    <div class="position-relative form-group">
                        <label for="desfecho" class="">
                            Desfecho
                        </label>
                        <select type="select" name="desfecho" class="custom-select">
                            <option value="">Selecione</option>
                            <option value="Completamente recuperado" <?php if ($quadro && $quadro->desfecho === 'Completamente recuperado') {
                                                                            echo "selected=selected";
                                                                        } ?>>Completamente recuperado</option>
                            <option value="Com sequelas não-limitantes (ex: não recuperou olfato)" <?php if ($quadro && $quadro->desfecho === 'Com sequelas não-limitantes (ex: não recuperou olfato)') {
                                                                                                        echo "selected=selected";
                                                                                                    } ?>>Com sequelas não-limitantes (ex: não recuperou olfato)</option>
                            <option value="Com sequelas incapacitantes (ex: não recuperou capacidade pulmonar)" <?php if ($quadro && $quadro->desfecho === 'Com sequelas incapacitantes (ex: não recuperou capacidade pulmonar)') {
                                                                                                                    echo "selected=selected";
                                                                                                                } ?>>Com sequelas incapacitantes (ex: não recuperou capacidade pulmonar)</option>
                            <option value="Óbito por covid como principal causa" <?php if ($quadro && $quadro->desfecho === 'Óbito por covid como principal causa') {
                                                                                        echo "selected=selected";
                                                                                    } ?>>Óbito por covid como principal causa</option>
                            <option value="Óbito por outras causas" <?php if ($quadro && $quadro->desfecho === 'Óbito por outras causas') {
                                                                        echo "selected=selected";
                                                                    } ?>>Óbito por outras causas</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="sintomas_manifestados">Sequelas</label><br />
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="perda_olfato" type="checkbox" value="perda persistente de olfato" <?php if ($sequelas && in_array('perda persistente de olfato', $sequelas)) {
                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                    } ?>>
                            <label class="form-check-label" for="perda_olfato">Perda persistente de olfato</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="perda_paladar" type="checkbox" value="perda persistente de paladar" <?php if ($sequelas && in_array('perda persistente de paladar', $sequelas)) {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } ?>>
                            <label class="form-check-label" for="perda_paladar">Perda persistente de paladar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="tosse_persistente" type="checkbox" value="tosse persistente" <?php if ($sequelas && in_array('tosse persistente', $sequelas)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                            <label class="form-check-label" for="tosse_persistente">Tosse persistente</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="falta_de_ar_persistente" type="checkbox" value="falta de ar persistente" <?php if ($sequelas && in_array('falta de ar persistente', $sequelas)) {
                                                                                                                                                                echo 'checked=checked';
                                                                                                                                                            } ?>>
                            <label class="form-check-label" for="falta_de_ar_persistente">Falta de ar persistente</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="dor_de_cabeca_persistente" type="checkbox" value="dor de cabeça persistente" <?php if ($sequelas && in_array('dor de cabeça persistente', $sequelas)) {
                                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                                } ?>>
                            <label class="form-check-label" for="dor_de_cabeca_persistente">Dor de cabeça persistente</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="eventos_tromboliticos" type="checkbox" value="eventos tromboliticos" <?php if ($sequelas && in_array('eventos tromboliticos', $sequelas)) {
                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                        } ?>>
                            <label class="form-check-label" for="eventos_tromboliticos">Eventos tromboliticos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="danos_renais" type="checkbox" value="danos renais" <?php if ($sequelas && in_array('danos renais', $sequelas)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                            <label class="form-check-label" for="danos_renais">Danos renais</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="sequelas[]" class="form-check-input" id="outras_sequelas" type="checkbox" value="outros: quais?" <?php if ($sequelas && in_array('outros: quais?', $sequelas)) {
                                                                                                                                                echo 'checked=checked';
                                                                                                                                            } ?>>
                            <label class="form-check-label" for="outras_sequelas">Outros</label>
                        </div>
                        <input name="outra_sequela_qual" type="text" placeholder="Outros: quais?" class=" form-control" id="outra_sequela_qual" value="@if($quadro) {{ $quadro->outra_sequela_qual }} @endif">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="algo_mais_sobre_caso">Algo mais que queira descrever sobre o caso? </label>
                        <textarea name="algo_mais_sobre_caso" id="algo_mais_sobre_caso" class="form-control">@if($quadro) {{ $quadro->algo_mais_sobre_caso }}  @endif</textarea>
                    </div>
                </div>
            </div>

            <div class="pos2ition-relative row form-chec2k">
                <div class="col-sm-12 2offset-sm-2">
                    <button type="submit" id="createPacienteQA" class="btn btn-secondary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>
