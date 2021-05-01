@props([
    'value' => null,
    'items' => [
        'inalação' => 'Inalação',
        'vaporização' => 'Vaporização',
        'não' => 'Não',
    ],
])

<div class="form-group">
    <label for="fes_inalacao">Fez inalação ou vaporização?</label>
    <x-forms.radio-group :items="$items" property="fes_inalacao" :value="$value" />
</div>
