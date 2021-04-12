<form id="createPacienteForm" method="POST" action="{{ route('pacientes.update', $paciente) }}">
    @csrf
    @method('PUT')

    @include('pages.paciente._forms_paciente.situacao_caso', ['paciente' => $paciente])
</form>
