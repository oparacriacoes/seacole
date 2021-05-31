@extends('layouts.app')
@section('content')
<div class="app-main__inner">
  <div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-user text-primary">
                </i>
            </div>
            <div>Agentes
                <div class="page-title-subheading">Projeto Agentes Populares de Saúde.</div>
            </div>
        </div>
      </div>
  </div>

  @if(!empty($success))
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">
        {{ $success }}
      </div>
    </div>
  </div>
  @endif

  <div class="main-card mb-3 card">
    <div class="card-body">

      <form method="POST" action="{{ route('agentes.store') }}">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="name">Nome completo</label>
              <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{old('name')}}">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{old('email')}}">
            </div>
          </div>
          <input type="hidden" name="role" value="agente">
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_celular_1">Telefone celular 1</label>
              <input name="fone_celular_1" type="text" class="form-control mobile_with_ddd" id="fone_celular_1" value="{{old('fone_celular_1')}}" aria-describedby="fone_celular_1Help">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_celular_2">Telefone celular 2</label>
              <input name="fone_celular_2" type="text" class="form-control mobile_with_ddd" id="fone_celular_2" value="{{old('fone_celular_2')}}" aria-describedby="fone_celular_2Help">
            </div>
          </div>
        </div>
        <button id="createAgente" type="submit" class="btn btn-primary">Cadastrar</button>
      </form>

    </div>
  </div>
</div>

@stop
