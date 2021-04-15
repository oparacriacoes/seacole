@props([
    'label' => '',
    'property' => '',
    'value' => null,
])

<div class="form-group">
    <label for="quadro_atual">{{$slot}} - {{old($property)}}</label>
    <div class="position-relative1 form-check">
        <label class="form-check-label">
            <input name="{{$property}}" type="radio" class="form-check-input" value="1" @if(old($property, $value)) checked @endif>Sim
        </label>
    </div>
    <div class="position-relative1 form-check">
        <label class="form-check-label">
            <input name="{{$property}}" type="radio" class="form-check-input" value="0" @if(old($property) == '0' || $value === false) checked @endif>Não
        </label>
    </div>
</div>
