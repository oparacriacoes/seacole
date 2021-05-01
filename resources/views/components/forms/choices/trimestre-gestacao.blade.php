<div class="position-relative form-group">
    <label for="trimestre_gestacao">
        Trimestre da gestação no início do monitoramento
    </label>
    <x-forms.select property="trimestre_gestacao" :value="$value" :items="$trimestres"/>
</div>
