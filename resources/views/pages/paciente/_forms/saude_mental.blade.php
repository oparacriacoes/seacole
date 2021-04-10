<form action="{{ route('paciente.saude-mental', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="quadro_atual">Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?</label>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="quadro_atual" type="radio" class="form-check-input" value="sim" <?php if ($saude_mental && $saude_mental->quadro_atual === 'sim') {
                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                        } ?>> Sim</label></div>
                <div class="position-relative1 form-check"><label class="form-check-label"><input name="quadro_atual" type="radio" class="form-check-input" value="não" <?php if ($saude_mental && $saude_mental->quadro_atual === 'não') {
                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                        } ?>> Não</label></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="detalhes_medos">Escreva sobre o estado emocional e detalhe os medos</label>
                <textarea name="detalhes_medos" id="detalhes_medos" class="form-control">@if($saude_mental) {{ $saude_mental->detalhes_medos }} @endif</textarea>
            </div>
        </div>
    </div>
    <div class="position-relatives row fdorm-check">
        <div class="col-sm-12 offset-sm-2s"><br />
            <button class="btn btn-secondary">Enviar</button>
        </div>
    </div>
</form>
