@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-syringe text-primary">
                    </i>
                </div>
                <div>Cadastro de nova vacina</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('pages.gerenciamento.vacinas._form', ['vacina' => $vacina, 'action_url' => route('vacinas.store')])
        </div>
    </div>
</div>
@endsection
