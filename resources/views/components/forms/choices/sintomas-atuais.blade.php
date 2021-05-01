<div class="position-relative form-group">
    <label for="sintomas_atuais" class="">
        Sintomas atuais
    </label>
    <br>
    <x-forms.check-group :items="$sintomas_atuais" property="sintomas_atuais" :value="$value" />
</div>
