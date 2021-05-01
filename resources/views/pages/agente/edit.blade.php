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
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.</div>
                </div>
            </div>
        </div>
    </div>


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

    <div class="main-card mb-3 card">
        <div class="card-body">

            <form method="POST" action="{{ route('agentes.update', $agente->id) }}">
                <input id="id" type="hidden" name="" value="{{ $agente->id }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Nome completo</label>
                            <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ $agente->user->name }}" readonly>
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
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $agente->user->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="role" value="agente">
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fone_celular_1">Telefone celular 1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <a href="tel:{{ $agente->fone_celular_1 }}">
                                        <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                                    </a>
                                </div>
                                <input name="fone_celular_1" type="text" class="form-control mobile_with_ddd" id="fone_celular_1" aria-describedby="fone_celular_1Help" value="{{ $agente->fone_celular_1 }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fone_celular_2">Telefone celular 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <a href="tel:{{ $agente->fone_celular_2 }}">
                                        <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                                    </a>
                                </div>
                                <input name="fone_celular_2" type="text" class="form-control mobile_with_ddd" id="fone_celular_2" aria-describedby="fone_celular_2Help" value="{{ $agente->fone_celular_2 }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                @if( \Auth::user()->role === 'administrador' || isset(\Auth::user()->agente->id) && \Auth::user()->agente->id === $agente->id )
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Nova senha</label>
                            <input id="password_1" name="password" type="password" class="form-control" aria-describedby="passwordHelp" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirma nova senha</label>
                            <input id="password_2" name="password_confirmation" type="password" class="form-control" aria-describedby="password_confirmationHelp" readonly>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" name="button" id="btn-edit" onclick="editForm()">Editar</button>
                <button type="submit" class="btn btn-success btn-save" id="updateAgente" disabled>Salvar</button>
                @endif
            </form>

        </div>
    </div>

</div>
@stop

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function editForm() {
        $('.btn-save').attr('disabled', false);
        $('.form-control').attr('readonly', false);
        $('textarea[name="sintomas_iniciais"]').attr('readonly', true);
        $('.form-control').attr('disabled', false);
        $('.form-check-input').attr('disabled', false);
        $('#btn-edit').removeClass("btn-primary");
        $('#btn-edit').addClass("btn-secondary");
        $('#btn-edit').text('Cancelar');
        $("#btn-edit").attr("onclick", "cancelEdit()");
    }

    function cancelEdit() {
        $('.form-control').attr('readonly', true);
        $('.form-control').attr('disabled', true);
        $('.btn-save').attr('disabled', true);
        $('.form-check-input').attr('disabled', true);
        $('#btn-edit').removeClass("btn-secondary");
        $('#btn-edit').addClass("btn-primary");
        $('#btn-edit').text('Editar');
        $("#btn-edit").attr("onclick", "editForm()");
    }
</script>
@stop
