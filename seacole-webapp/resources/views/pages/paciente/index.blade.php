@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Pacientes</h1>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Agente Responsável</th>
        <th scope="col">Médico Responsável</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pacientes as $paciente)
      <tr>
        <td><a href="{{ route('paciente/edit', $paciente->id) }}">{{ $paciente->user->name }}</a></td>
        @if($paciente->agente)
        <td><a href="{{ route('agente/edit', $paciente->agente->id) }}">{{ $paciente->agente->user->name }}</a></td>
        @else
        <td></td>
        @endif
        @if($paciente->medico)
        <td><a href="{{ route('medico/edit', $paciente->medico->id) }}">{{ $paciente->medico->user->name }}</a></td>
        @else
        <td></td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
