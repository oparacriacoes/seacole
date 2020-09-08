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
            <div>Psicólogos
                <div class="page-title-subheading">Todas os conteúdos são somente teste.
                </div>
            </div>
        </div>
      </div>
  </div>

  <div class="main-card mb-3 card">
    <div class="card-body">

      <form method="POST" action="{{ route('psicologo.update', $psicologo->id) }}">
        <input id="id" type="hidden" name="" value="{{ $psicologo->id }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="name">Nome completo</label>
              <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ $psicologo->user->name }}" readonly>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="mailto:{{ $psicologo->email }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-envelope" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $psicologo->user->email }}" readonly>
              </div>
            </div>
          </div>
          <input type="hidden" name="role" value="psicologo">
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_fixo">Telefone celular 1</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $psicologo->fone_fixo }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_celular_1" type="text" class="form-control mobile_with_ddd" id="fone_fixo" aria-describedby="fone_fixoHelp" value="{{ $psicologo->fone_celular_1 }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_celular">Telefone celular 2</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $psicologo->fone_celular }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_celular_2" type="text" class="form-control mobile_with_ddd" id="fone_celular" aria-describedby="fone_celularHelp" value="{{ $psicologo->fone_celular_2 }}" readonly>
              </div>
            </div>
          </div>
        </div>
        @if( \Auth::user()->role === 'administrador' || isset(\Auth::user()->psicologo->id) && \Auth::user()->psicologo->id === $psicologo->id )
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="password">Nova senha</label>
              <input id="password_1" name="password" type="password" class="form-control" aria-describedby="passwordHelp" readonly>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="password_confirm">Confirma nova senha</label>
              <input id="password_2" name="password_confirm" type="password" class="form-control" aria-describedby="password_confirmHelp" readonly>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-danger" name="button" id="btn-edit" onclick="editForm()">Editar</button>
        <button id="updatePsicologo" type="submit" class="btn btn-primary btn-save" id="" disabled>Salvar</button>
        @endif
      </form>

    </div>
  </div>

</div>
@stop
