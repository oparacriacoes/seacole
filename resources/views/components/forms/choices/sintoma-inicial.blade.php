<div class="position-relative form-group">
    <label for="sintomas_iniciais">
        DIAGNÓSTICO DE COVID-19
    </label>
    <x-forms.select property="sintomas_iniciais" :value="$value" :items="$sintomas_iniciais"/>
</div>
