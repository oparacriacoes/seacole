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
            <div class="page-title-actions">
                <a href="{{route('psicologos.create')}}" role="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary" data-original-title="Adicionar Novo Psicólogo">
                    <i class="fa fa-plus-circle"></i>
                </a>
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

    <div class="row">
        <div class="col">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table id="psicologos" class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Data Cadastro</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($psicologos as $psicologo)
                            <tr>
                                <td><a href="{{ route('psicologos.edit', $psicologo->id) }}">{{ $psicologo->user->name }}</a></td>
                                <td>{{ $psicologo->user->email }}</td>
                                <td>{{ $psicologo->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('psicologos.destroy', $psicologo->id) }}" method="post">
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

@stop

@section('script')
<script>
    $('.info').css('cursor', 'pointer');
    $('.info').click(function() {
        $(this).fadeOut();
    })
</script>
@endsection
