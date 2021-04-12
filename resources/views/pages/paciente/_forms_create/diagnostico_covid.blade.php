<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">
            (Sentinela-Vigilancia) DIAGNÓSTICO DE COVID-19
        </h5>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class="">
                        DIAGNÓSTICO DE COVID-19
                    </label>
                    <select type="select" id="sintomas_iniciais" name="sintomas_iniciais" class="custom-select">
                        <option value="">Selecione</option>
                        <option @if(old('sintomas_iniciais')==='suspeito' ){{ 'selected' }} @endif>suspeito</option>
                        <option @if(old('sintomas_iniciais')==='confirmado' ){{ 'selected' }} @endif>confirmado</option>
                        <option @if(old('sintomas_iniciais')==='descartado' ){{ 'selected' }} @endif>descartado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <x-forms.input-date property="data_teste_confirmatorio" :value="$paciente->data_teste_confirmatorio">
                    Data do teste confirmatório
                </x-forms.input-date>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">
                        Testes realizados?
                    </label>
                    <br>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="teste_utilizado[]" id="pcr" class="custom-control-input" value="PCR" @if(old('teste_utilizado')==='PCR' ){{ 'checked' }} @endif>
                        <label class="custom-control-label" for="pcr">
                            PCR
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="teste_utilizado[]" id="sorologias" class="custom-control-input" value="sorologias (IgM/IgG)" @if(old('teste_utilizado')==='sorologias (IgM/IgG)' ){{ 'checked' }} @endif>
                        <label class="custom-control-label" for="sorologias">
                            sorologias (IgM/IgG)
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="teste_utilizado[]" id="teste_rapido" class="custom-control-input" value="teste rápido" @if(old('teste_utilizado')==='teste rápido' ){{ 'checked' }} @endif>
                        <label class="custom-control-label" for="teste_rapido">
                            Teste Rápido
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="teste_utilizado[]" id="nao_informado" class="custom-control-input" value="não informado" @if(old('teste_utilizado')==='não informado' ){{ 'checked' }} @endif>
                        <label class="custom-control-label" for="nao_informado">
                            Não Informado
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label for="resultado_teste" class="">
                        Resultados encontrados
                    </label>
                    <br>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="pcr_positivo" class="custom-control-input" value="PCR positivo">
                        <label class="custom-control-label" for="pcr_positivo">
                            PCR positivo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="pcr_negativo" class="custom-control-input" value="PCR negativo">
                        <label class="custom-control-label" for="pcr_negativo">
                            PCR negativo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="igm_positivo" class="custom-control-input" value="IgM positivo">
                        <label class="custom-control-label" for="igm_positivo">
                            IgM positivo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="igm_negativo" class="custom-control-input" value="IgM negativo">
                        <label class="custom-control-label" for="igm_negativo">
                            IgM negativo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="igg_positivo" class="custom-control-input" value="IgG positivo">
                        <label class="custom-control-label" for="igg_positivo">
                            IgG positivo
                        </label>
                    </div>
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input type="checkbox" name="resultado_teste[]" id="igg_negativo" class="custom-control-input" value="IgG negativo">
                        <label class="custom-control-label" for="igg_negativo">
                            IgG negativo
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Outras informações sobre teste</label>
                    <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control">{{ old('outras_informacao') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
