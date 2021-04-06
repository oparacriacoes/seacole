<label class="form-check-label">
    <input {{ $attributes }} name="{{$property}}" type="radio" class="form-check-input" value="{{$value}}" @if($checked) checked @endif/> {{$slot}}
</label>

