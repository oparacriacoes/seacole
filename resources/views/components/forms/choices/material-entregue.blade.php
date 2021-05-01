<div class="position-relative form-group">
    <label for="material_entregue" class="">
        <strong>Foi entregue:</strong>
    </label>
    <br>
    <x-forms.check-group-array :items="$materiais_entregues" property="material_entregue" :value="$value" />
</div>
