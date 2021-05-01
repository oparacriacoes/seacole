<div class="position-relative form-group">
    <label for="identidade_genero">
        Identidade de genero
    </label>
    <x-forms.select property="identidade_genero" :value="$value" :items="$identidades_genero"/>
</div>
