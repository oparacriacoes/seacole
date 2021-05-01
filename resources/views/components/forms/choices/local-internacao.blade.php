<div class="position-relative form-group">
    <label for="resultado_teste" class="">
        <strong>Local de internação</strong>
    </label>
    <br>
    <x-forms.check-group :items="$locais_internacao" :value="$value" property="local_internacao" />
</div>
