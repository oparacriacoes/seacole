@extends('layouts.app')

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
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.
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
                            <td>
                                {{ $paciente->situacao_caso }}
                            </td>
                            <td>
                                <a href="{{ route('pacientes.edit', $paciente) }}">
                                    {{ $paciente->name }}
                                </a>
                            </td>
                            <td>
                                @if($paciente->agente)
                                <a href="{{ route('agentes.edit', $paciente->agente->id) }}">
                                    {{ $paciente->agente->user->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($paciente->medico)
                                <a href="{{ route('medicos.edit', $paciente->medico->id) }}">
                                    {{ $paciente->medico->user->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($paciente->psicologo)
                                <a href="{{ route('psicologos.edit', $paciente->psicologo->id) }}">
                                    {{ $paciente->psicologo->user->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                              <form action="{{ route('pacientes.destroy', $paciente) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger" type="submit" name="button">Excluir</button>
                              </form>
                            </td>
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
