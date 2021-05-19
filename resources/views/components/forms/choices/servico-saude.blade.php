<div class="position-relative form-group">
    <label for="resultado_teste" class="">
        {{ $slot }}
    </label>
    <br>
    <x-forms.check-group :items="$servicos_saude" :property="$property" :value="$value" />
</div>
