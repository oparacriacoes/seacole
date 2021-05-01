@props([
    'property' => 'input_date',
    'value' => null
])

<div class="form-group">
    <label for="$property">{{$slot}}</label>
    <input name="{{$property}}" type="date" class="form-control @error($property) is-invalid @enderror" id="{{$property}}" aria-describedby="{{$property.'Help'}}" value="{{old($property, $value ? $value->format('Y-m-d') : '')}}">
</div>

@error($property)
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
