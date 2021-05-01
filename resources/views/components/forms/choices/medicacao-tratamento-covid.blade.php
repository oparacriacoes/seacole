<div class="position-relative form-group">
    <label for="resultado_teste" class="">
        <strong>Recebeu medicações para tratar COVID-19?</strong>
    </label>
    <br>
    <x-forms.check-group :items="$medicamentos_tratamento_covid" :value="$value" property="recebeu_med_covid" />
</div>
