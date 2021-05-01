@props([
    'items' => [],
    'property' => [],
    'value' => null,
])

<select type="select" id="{{$property}}" name="{{$property}}" class="custom-select">
    <option value="">Selecione</option>
    @foreach($items as $key => $content)
        <option value="{{$key}}" @if($key == old($property, $value)) selected @endif>{{$content}}</option>
    @endforeach
</select>
