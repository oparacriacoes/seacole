@props([
    'items' => [],
    'property' => [],
    'value' => null,
])


@foreach($items as $key => $content)
<div class="custom-checkbox custom-control custom-control-inline">
    <input type="checkbox" name="{{$property.'[]'}}" id="{{$property.'_'.$key}}"  class="custom-control-input" value="{{$key}}" @if(in_array($key, old($property, $value))) checked @endif>
    <label class="custom-control-label"  for="{{$property.'_'.$key}}">
        {{$content}}
    </label>
</div>
@endforeach
