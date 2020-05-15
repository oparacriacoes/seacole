@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Psicólogos</h1>
    </div>
  </div>
  <table id="psicologos" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Data Cadastro</th>
      </tr>
    </thead>
    <tbody>
      @foreach($psicologos as $psicologo)
      <tr>
        <td><a href="{{ route('psicologo/edit', $psicologo->id) }}">{{ $psicologo->user->name }}</a></td>
        <td>{{ $psicologo->user->email }}</td>
        <td>@php $data = \Carbon\Carbon::parse($psicologo->created_at); @endphp {{ $data->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
