<div class="form-group col-md-6">
    <label for="vacina_id">
        Vacina
    </label>

    <select required type="select" id="vacina_id" name="vacina_id" class="custom-select">
        @foreach($vacinas as $vacina)
            <option
                value="{{$vacina->id}}"
                data-dose="{{$vacina->doses}}"
                data-intervaloinicial="{{$vacina->intervalo_inicial_proxima_dose}}"
                data-intervalofinal="{{$vacina->intervalo_final_proxima_dose}}"
                @if($vacina->id == old('vacina_id', 1)) selected @endif>{{$vacina->name}}</option>
        @endforeach
    </select>
</div>

