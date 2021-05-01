<div class="position-relative form-group">
    <label for="doenca_cronica" class="">
        Sintomas manifestados
    </label>
    <br>
    <x-forms.check-group :items="$sintomas_manifestados" property="sintomas_manifestados" :value="$value" />
</div>
