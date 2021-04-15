<div class="position-relative form-group">
    <label for="teste_utilizado" class="">
        Testes realizados?
    </label>
    <br>
    <x-forms.check-group :items="$testes_realizados" property="teste_utilizado" :value="$value" />
</div>
