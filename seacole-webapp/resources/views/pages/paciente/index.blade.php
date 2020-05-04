@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Data Cadastro</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pacientes as $paciente)
      <tr>
        <td><a href="{{ route('paciente/edit', $paciente->id) }}">{{ $paciente->name }}</a></td>
        <td>{{ $paciente->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($paciente->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
