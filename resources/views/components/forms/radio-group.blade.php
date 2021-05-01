@props([
    'items' => [],
    'property' => [],
    'value' => null,
])

@foreach($items as $key => $content)
<div class="position-relative1 form-check">
    <label class="form-check-label">
        <input name="{{$property}}" type="radio" id="{{$property.'_'.$key}}" class="form-check-input" value="{{$key}}" @if($key == old($property, $value)) checked @endif> {{$content}}
    </label>
</div>
@endforeach
