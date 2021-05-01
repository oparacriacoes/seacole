@props([
    'property' => 'input_date',
    'value' => null
])

<div class="form-group">
    <label for="$property">{{$slot}}</label>
    <input name="{{$property}}" type="date" class="form-control" id="{{$property}}" aria-describedby="{{$property.'Help'}}" value="{{old($property, $value ? $value->format('Y-m-d') : '')}}">
</div>
