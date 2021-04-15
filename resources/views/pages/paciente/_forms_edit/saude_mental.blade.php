<form action="{{ route('paciente.saude-mental', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="quadro_atual">Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?</label>
                <div class="position-relative1 form-check">
                    <label class="form-check-label">
                        <input name="quadro_atual" type="radio" class="form-check-input" value="1" @if($saude_mental->quadro_atual === true) checked @endif>Sim
                    </label>
                </div>
                <div class="position-relative1 form-check">
                    <label class="form-check-label">
                        <input name="quadro_atual" type="radio" class="form-check-input" value="0"  @if($saude_mental->quadro_atual === false) checked @endif> Não
                    </label>
                </div>
            </div>
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
