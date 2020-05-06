@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Dados do Agente</h1>
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
  <div class="row pb-4">
    <div class="col">
      <form method="POST" action="{{ route('agente.update', $agente->id) }}">
        <input id="id" type="hidden" name="" value="{{ $agente->id }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="name">Nome completo</label>
              <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ $agente->name }}" readonly>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="mailto:{{ $agente->email }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-envelope" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $agente->email }}" readonly>
              </div>
            </div>
          </div>
          <input type="hidden" name="role" value="agente">
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_fixo">Telefone fixo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $dados->fone_fixo }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-phone-square-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_fixo" type="text" class="form-control phone_with_ddd" id="fone_fixo" aria-describedby="fone_fixoHelp" value="{{ $dados->fone_fixo }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fone_celular">Telefone celular</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $dados->fone_celular }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_celular" type="text" class="form-control mobile_with_ddd" id="fone_celular" aria-describedby="fone_celularHelp" value="{{ $dados->fone_celular }}" readonly>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-danger" name="button" id="btn-edit" onclick="editForm()">Editar</button>
        <button type="submit" class="btn btn-primary btn-save" id="updateAgente" disabled>Salvar</button>
      </form>
    </div>
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
@stop
