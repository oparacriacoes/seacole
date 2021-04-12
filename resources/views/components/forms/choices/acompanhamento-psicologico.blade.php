<div class="position-relative form-group">
    <label for="acompanhamento_psicologico" class="">
        Acompanhamento psicológico
    </label>
    <br>
    <x-forms.check-group :items="$acompanhamentos_psicologico" property="atendimento_semanal_psicologia" :value="$value" />
</div>
