<div class="position-relative form-group">
    <label for="teste_utilizado" class="">
        Onde/como acessa o sistema de saúde?
    </label>
    <br>
    <x-forms.check-group :items="$acessos_ss" property="sistema_saude" :value="$value" />
</div>
