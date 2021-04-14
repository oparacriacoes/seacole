<div class="position-relative form-group">
    <label for="orientacao_sexual">
        Orientação sexual
    </label>
    <x-forms.select property="orientacao_sexual" :value="$value" :items="$orientacoes_sexuais"/>
</div>
