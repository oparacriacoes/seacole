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
                <div>Pacientes
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.
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

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a class="nav-link active" id="tab0" data-toggle="tab" href="#tab-content-0">
                <span>Geral</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#tab-content-1">
                <span>Quadro Atual</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab3" data-toggle="tab" href="#tab-content-2">
                <span>Monitoramento</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab4" data-toggle="tab" href="#tab-content-3">
                <span>Saúde mental</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab5" data-toggle="tab" href="#tab-content-4">
                <span>Serviços de Referência e Internação</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab6" data-toggle="tab" href="#tab-content-5">
                <span>Insumos Oferecidos pelo Projeto</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab6" data-toggle="tab" href="#tab-content-6">
                <span>Prontuário</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            @include('pages.paciente._forms.paciente', [
            'paciente' => $paciente,
            'sistema_saude' => $sistema_saude,
            'cronicas' => $cronicas,
            'resultado_teste' => $resultado_teste,
            'teste_utilizado' => $teste_utilizado
            ])
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            @include('pages.paciente._forms.quadro_atual', [
            'paciente' => $paciente,
            'sintomas_quadro' => $sintomas_quadro,
            'quadro' => $quadro,
            'sequelas' => $sequelas,
            ])
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Monitoramento</h5>
                    @include('pages.paciente._forms.monitoramento', [
                    'paciente' => $paciente,
                    'monitoramento' => $monitoramento,
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Saúde mental</h5>
                    @include('pages.paciente._forms.saude_mental', [
                    'paciente' => $paciente,
                    'saude_mental' => $saude_mental,
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Serviços de Referência e Internação</h5>
                    @include('pages.paciente._forms.servicos_referencia', [
                    'paciente' => $paciente,
                    'internacao_servico' => $internacao_servico,
                    'internacao_remedio' => $internacao_remedio,
                    'internacao_problema' => $internacao_problema,
                    'internacao' => $internacao,
                    'internacao_local' => $internacao_local,
                    ])
                </div>
            </div>
        </div>

        <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Insumos Oferecidos pelo Projeto</h5>
                    @include('pages.paciente._forms.insumos', ['paciente' => $paciente, 'insumos' => $insumos])
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <div class="row">
                        @foreach($prontuarios as $prontuario)
                        <div class="col-4 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data: {{ $prontuario->data_monitoramento }} - Hora: {{ $prontuario->horario_monotiramento }}</h5>
                                    <p class="card-text">
                                        <strong>Sintomas: </strong>
                                        <?php
                                        $sintomas = unserialize($prontuario->sintomas_atuais);
                                        if ($sintomas) {
                                            for ($c = 0; $c < count($sintomas); $c++) {
                                                echo ucfirst($sintomas[$c]) . ', ';
                                            }
                                        }
                                        ?>
                                    </p>
                                    <p class="card-text"><strong>Outros Sintomas: </strong>{{ ucfirst($prontuario->sintomas_outro) }}</p>
                                    <p class="card-text"><strong>Temperatura: </strong>{{ $prontuario->temperatura_atual }}</p>
                                    <p class="card-text"><strong>Frequência Cardíaca: </strong>{{ $prontuario->frequencia_cardiaca_atual }}</p>
                                    <p class="card-text"><strong>Frequência Respiratória: </strong>{{ $prontuario->frequencia_respiratoria_atual }}</p>
                                    <p class="card-text"><strong>Saturação: </strong>{{ $prontuario->saturacao_atual }}</p>
                                    <p class="card-text"><strong>Pressão Arterial: </strong>{{ $prontuario->pressao_arterial_atual }}</p>
                                    <p class="card-text"><strong>Medicamento Prescrito? </strong>{{ ucfirst($prontuario->equipe_medica) }}</p>
                                    @if($prontuario->equipe_medica === 'sim')<p class="card-text"><strong>Qual? </strong>{{ ucfirst($prontuario->medicamento) }}</p>@endif
                                    <p class="card-text"><strong>Sinal de Gravidade: </strong>{{ ucfirst($prontuario->algum_sinal) }}</p>
                                    <p class="card-text"><strong>PIC: </strong>{{ ucfirst($prontuario->fazendo_uso_pic) }}</p>
                                    <p class="card-text"><strong>Escaldapés: </strong>{{ ucfirst($prontuario->fez_escalapes) }}</p>
                                    <p class="card-text"><strong>Sentiu Melhoras com Escaldapés: </strong>{{ ucfirst($prontuario->melhora_sintoma_escaldapes) }}</p>
                                    <p class="card-text"><strong>Inalação/Vaporização: </strong>{{ ucfirst($prontuario->fes_inalacao) }}</p>
                                    <p class="card-text"><strong>Sentiu Melhoras com Inalação/Vaporização: </strong>{{ ucfirst($prontuario->melhoria_sintomas_inalacao) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($prontuarios->isEmpty())
                        <div class="col-12 col-md-12">
                            Sem dados no prontuário.
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://seacole.uneafrobrasil.org/js/jquery.mask.js"></script>
<script>
    $('.temperature').mask('00,0');
    $('.saturation').mask('00');
    $('.hour').mask('00:00', {
        placeholder: '00:00'
    });
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
