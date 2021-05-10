<div class="main-card mb-3 card">
    <div class="card-body">
        @if ($errors->any())
        <div class="row">
            <div class="col">
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{$action_url}}" method="POST">
            @if($vacina->id)
            @method('PUT')
            @endif
            @csrf

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input name="name" type="text" required maxlength="190" class="form-control" id="name" value="{{old('name', $vacina->name)}}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="fabricante">Fabricante</label>
                        <input name="fabricante" type="text" maxlength="190" class="form-control" id="fabricante" value="{{old('fabricante', $vacina->fabricante)}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="doses">Total de Doses</label>
                        <input name="doses" type="number" min="1" max="10" step="1" required class="form-control" id="doses" value="{{old('doses', $vacina->doses)}}">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="intervalo_inicial_proxima_dose">Intervalo inicial da próxima dose (dias)</label>
                        <input type="number" min="1" step="1" class="form-control"
                            name="intervalo_inicial_proxima_dose"
                            id="intervalo_inicial_proxima_dose"
                            value="{{old('intervalo_inicial_proxima_dose', $vacina->intervalo_inicial_proxima_dose)}}">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="intervalo_final_proxima_dose">Intervalo final da próxima dose (dias)</label>
                        <input type="number" min="1" step="1" class="form-control"
                            name="intervalo_final_proxima_dose"
                            id="intervalo_final_proxima_dose"
                            value="{{old('intervalo_final_proxima_dose', $vacina->intervalo_final_proxima_dose)}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    @if($vacina->id)
                    <button type="button" id="btn_delete_vacina" class="btn btn-danger">Excluir</button>
                    @endif
                </div>
            </div>
        </form>
        @if($vacina->id)
            <form id="form_delete_vacina" method="POST" action="{{route('vacinas.destroy', $vacina)}}" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        @endif
    </div>
</div>

@section('script')
@parent
<script>
    $('#doses').blur(e => {
        if (e.currentTarget.value <= 1) {
            $('#intervalo_inicial_proxima_dose').prop('disabled', true).val(null);
            $('#intervalo_final_proxima_dose').prop('disabled', true).val(null);
        } else {
            $('#intervalo_inicial_proxima_dose').prop('disabled', false);
            $('#intervalo_final_proxima_dose').prop('disabled', false);
        }
    });

    $('#btn_delete_vacina').click(e => {
        Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: 'A vacina constará apenas no histórico de consulta, podendo ser restaurada futuramente!',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form_delete_vacina').submit();
            }
        });
    });
</script>
@endsection
