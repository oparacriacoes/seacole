@extends('layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success">
                    </i>
                </div>
                <div>
                    {{ $paciente->name }} - {{ $paciente->age }} anos
                    <div class="page-title-subheading">
                        Diagnóstico de Covid-19 - {{$paciente->sintomas_iniciais}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ALERTS DE RETORNO DO BACKEND -->
    @if ($errors->any())
        <div class="row">
            <div class="col">
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

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

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a class="nav-link @if(!session('tab')) active @endif" id="tab0" data-toggle="tab" href="#tab-content-0">
                <span>Geral</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'quadro_atual') active @endif" id="tab2" data-toggle="tab" href="#tab-content-1">
                <span>Quadro Atual</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'monitoramento') active @endif" id="tab3" data-toggle="tab" href="#tab-content-2">
                <span>Monitoramento</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'saude_mental') active @endif" id="tab4" data-toggle="tab" href="#tab-content-3">
                <span>Saúde mental</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'servicos_internacao') active @endif" id="tab5" data-toggle="tab" href="#tab-content-4">
                <span>Serviços de Referência e Internação</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'insumos_oferecidos') active @endif" id="tab6" data-toggle="tab" href="#tab-content-5">
                <span>Insumos Oferecidos pelo Projeto</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tab') == 'vacinacao') active @endif" id="tab6" data-toggle="tab" href="#tab-vacinacao">
                <span>Vacinação</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab6" data-toggle="tab" href="#tab-content-6">
                <span>Prontuário</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade @if(!session('tab')) show active @endif" id="tab-content-0" role="tabpanel">
            @include('pages.paciente._forms_edit.paciente', [
                'paciente' => $paciente,
            ])
        </div>

        <div class="tab-pane tabs-animation fade @if(session('tab') == 'quadro_atual') show active @endif" id="tab-content-1" role="tabpanel">
            @include('pages.paciente._forms_edit.quadro_atual', [
                'paciente' => $paciente,
                'quadro_atual' => $paciente->quadro_atual,
            ])
        </div>

        <div class="tab-pane tabs-animation fade @if(session('tab') == 'monitoramento') show active @endif" id="tab-content-2" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Monitoramento</h5>
                    @include('pages.paciente._forms_edit.monitoramento', [
                        'paciente' => $paciente,
                        'monitoramento' => $paciente->monitoramento,
                        'monitoramento_sintomas' => []
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade @if(session('tab') == 'saude_mental') show active @endif" id="tab-content-3" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Saúde mental</h5>
                    @include('pages.paciente._forms_edit.saude_mental', [
                        'paciente' => $paciente,
                        'saude_mental' => $paciente->saude_mental,
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade @if(session('tab') == 'servicos_internacao') show active @endif" id="tab-content-4" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Serviços de Referência e Internação</h5>
                    @include('pages.paciente._forms_edit.servicos_referencia', [
                        'paciente' => $paciente,
                        'servico_internacao' => $paciente->servico_internacao,
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade @if(session('tab') == 'insumos_oferecidos') show active @endif" id="tab-content-5" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Insumos Oferecidos pelo Projeto</h5>
                    @include('pages.paciente._forms_edit.insumos', ['paciente' => $paciente, 'insumos' => $paciente->insumos_oferecidos])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @include('pages.paciente.components.prontuario', ['paciente' => $paciente, 'prontuarios' => $paciente->prontuarios])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-vacinacao" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @include('pages.paciente._forms_edit.vacinacao', ['paciente' => $paciente])
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $('#pressao_arterial_atual').mask('#00x00', {
        reverse: true
    })

    $('.info').css('cursor', 'pointer');
    $('.info').click(function() {
        $(this).fadeOut();
    })

    //VIACEP
    function limpa_formulário_cep() {
        $("#address_street").val("");
        $("#address_neighborhood").val("");
        $("#address_city").val("");
        $("#address_state").val("");
    }

    $("#endereco_cep").blur(function() {
        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $("#endereco_rua").val("...");
                $("#endereco_bairro").val("...");
                $("#endereco_cidade").val("...");
                $("#endereco_uf").val("...");

                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        $("#endereco_rua").val(dados.logradouro);
                        $("#endereco_bairro").val(dados.bairro);
                        $("#endereco_cidade").val(dados.localidade);
                        $("#endereco_uf").val(dados.uf);
                    } else {
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    });
    //VIACEP FIM
</script>
@endsection
