@extends('layouts.app')

@section('content')
<div class="app-main__inner mb-4">
    <div class="row">
        <div class="col-md-4">
            <h4 class="font-weight-bolder">Perfil</h4>
            <p>
                Informações básicas sobre seu perfil
            </p>
        </div>
        <div class="col-md-8">
            @if(session('status-profile') == 'success')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{route('profile.update')}}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="form-group col-md-7">
                                <label for="name">Nome</label>
                                <input name="name" required class="form-control @error('name') is-invalid @enderror" type="text" value="{{old('name', $user->name)}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-7">
                                <label for="email">Email</label>
                                <input name="email" class="form-control" type="email" value="{{$user->email}}">
                            </div>
                        </div>

                        @unless($user->is_admin)

                        <div class="row mt-2">
                            <div class="form-group col-md-7">
                                <label for="">Telefone 1</label>
                                <input name="fone_celular_1" required class="form-control mobile_with_ddd @error('fone_celular_1') is-invalid @enderror" type="phone" value="{{old('fone_celular_1', $user->professional->fone_celular_1)}}">
                                @error('fone_celular_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-7">
                                <label for="">Telefone 2</label>
                                <input name="fone_celular_2" required class="form-control mobile_with_ddd @error('fone_celular_2') is-invalid @enderror" type="phone" value="{{old('fone_celular_2', $user->professional->fone_celular_2)}}">
                                @error('fone_celular_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @endif

                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="">Perfil de Acesso</label>
                                <input readonly class="form-control" type="text" value="{{ucfirst($user->role)}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-right">
                                <button class="btn btn-success shadow-sm">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="row" id="section-password">
        <div class="col-md-4">
            <h4 class="font-weight-bolder">Alteração de Senha</h4>
            <p>
                Garanta que sua conta está usando uma boa senha para nos manter seguros
            </p>
        </div>
        <div class="col-md-8">
            @if(session('status-password') == 'success')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{route('profile.update-password')}}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="form-group col-md-7">
                                <label for="password_current">Senha Atual</label>
                                <input name="password_current" id="password_current" class="form-control @error('password_current') is-invalid @enderror" type="password" required>
                                @error('password_current')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-7">
                                <label for="password">Nova Senha</label>
                                <input name="password" id="password" required class="form-control @error('password') is-invalid @enderror" type="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-7">
                                <label for="password_confirmation">Confirme a Senha</label>
                                <input name="password_confirmation" id="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror" type="password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-right">
                                <button class="btn btn-success shadow-sm">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
