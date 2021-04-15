<form id="createPacienteForm" method="POST" action="{{ route('pacientes.update', $paciente) }}">
    @csrf
    @method('PUT')

    @include('pages.paciente._forms_paciente.situacao_caso', ['paciente' => $paciente])
    @include('pages.paciente._forms_paciente.paciente', ['paciente' => $paciente])
    @include('pages.paciente._forms_paciente.diagnostico_covid', ['paciente' => $paciente])
    @include('pages.paciente._forms_paciente.condicao_saude', ['paciente' => $paciente])
</form>
