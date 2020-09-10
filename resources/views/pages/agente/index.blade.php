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
            <div>Agentes
                <div class="page-title-subheading">Todas os conteúdos são somente teste.
                </div>
            </div>
        </div>
      </div>
  </div>

  <!-- ALERTS DE RETORNO DO BACKEND -->
  @if(session('success'))
  <div class="row">
    <div class="col">
      <div class="alert alert-success info" role="alert">
        {{ session('success') }}
      </div>
    </div>
  </div>
  @endif
  @if(session('error'))
  <div class="row">
    <div class="col">
      <div class="alert alert-danger info" role="alert">
        {{ session('error') }}
      </div>
    </div>
  </div>
  @endif

  <div class="row">
    <div class="col-lg-12">
      <div class="main-card mb-3 card">
        <div class="card-body">
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
      </div>
    </div>
  </div>
</div>

@stop

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$('.info').css('cursor', 'pointer');
$('.info').click(function(){
  $(this).fadeOut();
})
</script>
@endsection
