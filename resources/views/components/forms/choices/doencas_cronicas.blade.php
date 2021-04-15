<div class="position-relative form-group">
    <label for="doenca_cronica" class="">
        Condições gerais de saúde
    </label>
    <br>
    <x-forms.check-group :items="$doencas_cronicas" property="doenca_cronica" :value="$value" />
</div>
