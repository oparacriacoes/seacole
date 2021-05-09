<form id="insumo_form" action="{{ route('paciente.vacinacao', $paciente->id) }}" method="post">
    @csrf
    <div class="position-relatives row fdorm-check">
        <div class="col-sm-12 offset-sm-2s pt-3">
            <button class="btn btn-success">Salvar</button>
        </div>
    </div>
</form>
