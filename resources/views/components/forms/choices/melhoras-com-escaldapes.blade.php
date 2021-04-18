@props([
    'value' => null,
    'items' => [
        'grande alívio' => 'Grande alívio',
        'pouca melhora' => 'Pouca Melhora',
        'não' => 'Não',
    ],
])

<div class="form-group">
    <label for="melhora_sintoma_escaldapes">Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
    <x-forms.radio-group :items="$items" property="melhora_sintoma_escaldapes" :value="$value" />
</div>
