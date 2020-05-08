@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Médicos</h1>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Data Cadastro</th>
      </tr>
    </thead>
    <tbody>
      @foreach($medicos as $medico)
      <tr>
        <td><a href="{{ route('medico/edit', $medico->id) }}">{{ $medico->user->name }}</a></td>
        <td>{{ $medico->user->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($medico->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
