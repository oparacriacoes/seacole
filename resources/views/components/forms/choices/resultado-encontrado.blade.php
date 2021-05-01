<div class="position-relative form-group">
    <label for="resultado_teste" class="">
        Resultados encontrados
    </label>
    <br>
    <x-forms.check-group :items="$resultados_encontrados" property="resultado_teste" :value="$value" />
</div>
