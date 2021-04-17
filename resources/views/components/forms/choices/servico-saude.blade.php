<div class="position-relative form-group">
    <label for="resultado_teste" class="">
        A pessoa precisou ir a algum serviço de saúde?
    </label>
    <br>
    <x-forms.check-group :items="$servicos_saude" :property="$property" :value="$value" />
</div>
