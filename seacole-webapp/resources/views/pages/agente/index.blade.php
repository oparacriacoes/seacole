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
      @foreach($agentes as $agente)
      <tr>
        <td><a href="{{ route('agente/edit', $agente->id) }}">{{ $agente->name }}</a></td>
        <td>{{ $agente->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($agente->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
