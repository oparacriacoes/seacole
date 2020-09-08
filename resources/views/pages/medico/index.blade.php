@extends('layouts.app_new')
@section('content')
<div class="app-main__inner">
  <div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-graph text-success">
                </i>
            </div>
            <div>Médicos
                <div class="page-title-subheading">Todas os conteúdos são somente teste.
                </div>
            </div>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="main-card mb-3 card">
        <div class="card-body">
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
      </div>
    </div>
  </div>
</div>

@stop
