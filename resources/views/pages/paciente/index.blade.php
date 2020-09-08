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
                <div>Pacientes
                    <div class="page-title-subheading">Todas os conteúdos são somente teste.
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <div class="main-card mb-3 card">
                  <div class="card-body">
                      <table id="pacientes" class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Situação</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Agente Responsável</th>
                            <th scope="col">Médico Responsável</th>
                            <th scope="col">Psicólogo</th>
                            <th scope="col">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($pacientes as $paciente)
                          <tr>
                            <td>{{ $paciente->situacao }}</td>
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
                            @if($paciente->psicologo)
                            <td><a href="{{ route('psicologo/edit', $paciente->psicologo->id) }}">{{ $paciente->psicologo->user->name }}</a></td>
                            @else
                            <td></td>
                            @endif
                            <td><button class="btn btn-sm btn-danger" type="button" name="button" onclick="deletePaciente({{ $paciente->id }})">Excluir</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
