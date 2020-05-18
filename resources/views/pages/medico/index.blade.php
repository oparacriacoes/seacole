@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Médicos</h1>
    </div>
  </div>
  <table id="medicos" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Data Cadastro</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($medicos as $medico)
      <tr>
        <td><a href="{{ route('medico/edit', $medico->id) }}">{{ $medico->user->name }}</a></td>
        <td>{{ $medico->user->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($medico->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
        <td><button class="btn btn-sm btn-danger" type="button" name="button" onclick="deleteMedico({{ $medico->id }})">Excluir</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
