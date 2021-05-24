<div class="main-card mb-3 card">
    <div class="card-body">
        <form id="vacinacao_form" action="{{ route('paciente.vacinacao', $paciente->id) }}" method="post">
            @csrf

            <div class="form-row">
                <x-forms.choices.vacinas />
                <div class="form-group col-md-3">
                    <label for="dose">Dose</label>
                    <input type="number" min="1" max="1" class="form-control" id="dose" name="dose" value="{{old('dose', 1)}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="data_vacinacao">Data Vacinação</label>
                    <input required type="date" class="form-control" id="data_vacinacao" name="data_vacinacao" placeholder="Vacina" value="{{old('data_vacinacao')}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-auto">
                    <button class="btn btn-success">Adicionar</button>
                </div>
                <div class="form-group pt-1 pl-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="reforco" id="reforco" @if(old('data_vacinacao')) checked @endif>
                        <label class="form-check-label" for="reforco">
                            Dose de Reforço
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Histórico Vacinação</h5>

        <table class="mb-0 table table-borderless table-hover">
            <thead>
                <tr>
                    <th>Vacina</th>
                    <th>Dose</th>
                    <th>Data Aplicação</th>
                    <th>Dose de Reforço</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vacinacao as $aplicacao)
                <tr>
                    <td>{{$aplicacao->vacina->name}}</td>
                    <td>{{$aplicacao->dose}}ª dose</td>
                    <td>{{$aplicacao->data_vacinacao->format('d/m/Y')}}</td>
                    <th>{{$aplicacao->reforco ? 'Sim' : '-'}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@section('script')
@parent
<script>
    $('#vacina_id').change(e => {
        let optionSelected = $(e.currentTarget).find(":selected")[0]
        $('#dose').attr('max', optionSelected.dataset['dose'])
    });

    let optionSelected = $('#vacina_id').find(":selected")[0]
    $('#dose').attr('max', optionSelected.dataset['dose'])
</script>
@endsection
