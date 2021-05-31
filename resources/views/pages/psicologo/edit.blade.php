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
                <div>Psicólogos
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.
                    </div>
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

            <form method="POST" action="{{ route('psicologos.update', $psicologo->id) }}">
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
                <button type="button" class="btn btn-primary" name="button" id="btn-edit" onclick="editForm()">Editar</button>
                <button id="updatePsicologo" type="submit" class="btn btn-success btn-save" id="" disabled>Salvar</button>
                @endif
            </form>

        </div>
    </div>

</div>
@stop

@section('script')
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
