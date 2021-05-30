<div class="position-relative form-group">
    <label for="precisa_tipo_ajuda" class="">
        <strong>Precisa de algum tipo de ajuda?</strong>
    </label>
    <br>
    <x-forms.check-group :items="$tipos_ajuda" property="precisa_tipo_ajuda" :value="$value" />
</div>
