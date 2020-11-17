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
                              <?php
                              switch ($paciente->situacao) {
                                case '1':
                                  echo 'Caso ativo GRAVE';
                                  break;

                                case '2':
                                  echo 'Caso ativo LEVE';
                                  break;

                                case '3':
                                  echo 'Contato caso confirmado - ativo';
                                  break;

                                case '4':
                                  echo 'Outras situações (sem relação com COVID-19) - ativos';
                                  break;

                                case '5':
                                  echo 'Exclusivo psicologia - ativo';
                                  break;

                                case '6':
                                  echo 'Monitoramento encerrado GRAVE - segue apenas com psicólogos';
                                  break;

                                case '7':
                                  echo 'Monitoramento encerrado LEVE - segue apenas com psicólogos';
                                  break;

                                case '8':
                                  echo 'Monitoramento encerrado contato - segue apenas com psicólogos';
                                  break;

                                case '9':
                                  echo 'Monitoramento encerrado outros - segue apenas com psicólogos';
                                  break;

                                case '10':
                                  echo 'Caso finalizado GRAVE';
                                  break;

                                case '11':
                                  echo 'Caso finalizado LEVE';
                                  break;

                                case '12':
                                  echo 'Contato com caso confirmado - finalizado';
                                  break;

                                case '13';
                                  echo 'Outras situações (sem relação com COVID-19) - finalizado';
                                  break;

                                case '14':
                                  echo 'Exclusivo psicologia - finalizado';
                                  break;

                                default:
                                  echo 'Não Informado';
                                  break;
                              }
                              ?>
                            </td>
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
                            <td>
                              <form action="{{ route('paciente.destroy', $paciente->id) }}" method="post">
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

@section('script')
<script>
$(document).ready( function () {
    $('#pacientes').DataTable({
      "language": {
          "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
      },
    });
} );
</script>
@endsection
