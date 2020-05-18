@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Agentes</h1>
    </div>
  </div>
  <table id="agentes" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Data Cadastro</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($agentes as $agente)
      <tr>
        <td><a href="{{ route('agente/edit', $agente->id) }}">{{ $agente->user->name }}</a></td>
        <td>{{ $agente->user->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($agente->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
        <td><button class="btn btn-sm btn-danger" type="button" name="button" onclick="deleteAgente({{ $agente->id }})">Excluir</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
