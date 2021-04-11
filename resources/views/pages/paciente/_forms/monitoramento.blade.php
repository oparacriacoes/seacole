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
                <label for="horario_monotiramento">Horário do monitoramento</label>
                <input name="horario_monotiramento" type="text" class=" form-control hour" id="horario_monotiramento" value="@if($monitoramento) {{ $monitoramento->horario_monotiramento }} @endif">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="sintomas_atuais">Sintomas atuais</label><br />
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="tosse" <?php if ($monitoramento_sintomas && in_array('tosse', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="tosse">Tosse</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="falta de ar" <?php if ($monitoramento_sintomas && in_array('falta de ar', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="falta_de_ar">Falta de ar</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="febre" <?php if ($monitoramento_sintomas && in_array('febre', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="febre">Febre</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="dor de cabeça" <?php if ($monitoramento_sintomas && in_array('dor de cabeça', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="perda de olfato" <?php if ($monitoramento_sintomas && in_array('perda de olfato', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Perda do olfato</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="perda do paladar" <?php if ($monitoramento_sintomas && in_array('perda do paladar', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="inlineCheckbox3">Perda do paladar</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="outros" <?php if ($monitoramento_sintomas && in_array('outros', $monitoramento_sintomas)) {
    echo 'checked=checked';
} ?>>
                    <label class="form-check-label" for="outros_monit">Outros</label>
                </div>

                <div class="form-check form-check-inline">
                    <input name="sintomas_outro" class="form-control" type="text" placeholder="Outro (digite)" value="@if($monitoramento) {{ $monitoramento->sintomas_outro }} @endif">
                </div>
            </div>
        </div>
    </div>


    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="temperatura_atual">Temperatura atual (em graus)</label>
                <input name="temperatura_atual" type="text" placeholder="00,0" class=" form-control temperature" id="temperatura_atual" value="@if($monitoramento) {{ $monitoramento->temperatura_atual }} @endif">
            </div>
            <div class="form-group">
                <label for="frequencia_cardiaca_atual">Frequência cardíaca atual</label>
                <input name="frequencia_cardiaca_atual" type="number" max="999" placeholder="-- bpm" class="form-control" id="frequencia_cardiaca_atual" value="@if($monitoramento){{$monitoramento->frequencia_cardiaca_atual}}@endif">
            </div>
            <div class="form-group">
                <label for="algum_sinal">Algum sinal de gravidade nesse monitoramento?</label>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="algum_sinal" type="radio" class="form-check-input" value="sim" <?php if ($monitoramento && $monitoramento->algum_sinal === 'sim') {
    echo 'checked=checked';
} ?>> Sim</label></div>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="algum_sinal" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->algum_sinal === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="saturacao_atual">Saturação atual (%)</label>
                <input name="saturacao_atual" type="text" placeholder="00 %" class=" form-control saturation" id="saturacao_atual" value="@if($monitoramento) {{ $monitoramento->saturacao_atual }} @endif">
            </div>
            <div class="form-group">
                <label for="pressao_arterial_atual">Pressão Arterial Atual</label>
                <input name="pressao_arterial_atual" type="text" placeholder="Ex: 12x8" class=" form-control" id="pressao_arterial_atual" value="@if($monitoramento) {{ $monitoramento->pressao_arterial_atual }} @endif">
            </div>
            <div class="form-group">
                <label for="equipe_medica">Equipe médica do projeto prescreveu algum medicamento?</label>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="equipe_medica" type="radio" class="form-check-input" value="sim" <?php if ($monitoramento && $monitoramento->equipe_medica === 'sim') {
    echo 'checked=checked';
} ?>> Sim</label></div>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="equipe_medica" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->equipe_medica === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="frequencia_respiratoria_atual">Frequência respiratória atual</label>
                <input name="frequencia_respiratoria_atual" type="number" max="99" placeholder="-- rpm" class="form-control" id="frequencia_respiratoria_atual" value="@if($monitoramento){{$monitoramento->frequencia_respiratoria_atual}}@endif">
            </div>
            <div class="form-group">
                <label for="medicamento">Medicamento prescrito pela equipe médica do projeto</label>
                <textarea name="medicamento" id="medicamento" class="form-control">@if($monitoramento) {{ $monitoramento->medicamento }} @endif</textarea>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fazendo_uso_pic">Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?</label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fazendo_uso_pic" type="radio" class="form-check-input" value="sim" <?php if ($monitoramento && $monitoramento->fazendo_uso_pic === 'sim') {
    echo 'checked=checked';
} ?>> Sim</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fazendo_uso_pic" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->fazendo_uso_pic === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fez_escalapes">Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fez_escalapes" type="radio" class="form-check-input" value="sim" <?php if ($monitoramento && $monitoramento->fez_escalapes === 'sim') {
    echo 'checked=checked';
} ?>> Sim</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fez_escalapes" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->fez_escalapes === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="melhora_sintoma_escaldapes">Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="grande alívio" <?php if ($monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'grande alívio') {
    echo 'checked=checked';
} ?>> grande alívio</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="pouca melhora" <?php if ($monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'pouca melhora') {
    echo 'checked=checked';
} ?>> pouca melhora</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fes_inalacao">Fez inalação ou vaporização? </label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="inalação" <?php if ($monitoramento && $monitoramento->fes_inalacao === 'inalação') {
    echo 'checked=checked';
} ?>> Inalação</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="vaporização" <?php if ($monitoramento && $monitoramento->fes_inalacao === 'vaporização') {
    echo 'checked=checked';
} ?>> Vaporização</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->fes_inalacao === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="melhoria_sintomas_inalacao">Sentiu melhora dos sintomas com inalação ou vaporização: </label>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="grande alívio" <?php if ($monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'grande alívio') {
    echo 'checked=checked';
} ?>> grande alívio</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="pouca melhora" <?php if ($monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'pouca melhora') {
    echo 'checked=checked';
} ?>> pouca melhora</label></div>
                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="não" <?php if ($monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'não') {
    echo 'checked=checked';
} ?>> Não</label></div>
                    </div>
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
