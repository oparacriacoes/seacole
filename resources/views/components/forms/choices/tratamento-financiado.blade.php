@props([
    'items' => ['alopaticos' => 'Alopático (medicamentos convencionais)', 'pics' => 'PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)'],
    'value' => []
])

<div class="position-relative form-group">
    <label for="precisa_tipo_ajuda" class="">
        <strong>Tratamento financiado</strong>
    </label>
    <br>
    <x-forms.check-group :items="$items" property="tratamento_financiado" :value="$value"/>
</div>
