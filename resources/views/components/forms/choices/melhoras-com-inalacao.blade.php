@props([
    'value' => null,
    'items' => [
        'grande alívio' => 'Grande alívio',
        'pouca melhora' => 'Pouca Melhora',
        'não' => 'Não',
    ],
])

<div class="form-group">
    <label for="melhoria_sintomas_inalacao">Fez inalação ou vaporização?</label>
    <x-forms.radio-group :items="$items" property="melhoria_sintomas_inalacao" :value="$value" />
</div>
