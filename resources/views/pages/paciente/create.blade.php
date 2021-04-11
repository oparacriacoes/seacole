@extends('layouts.app_new')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>Pacientes
                    <div class="page-title-subheading">Projeto Agentes Populares de Saúde.</div>
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

    <form id="createPacienteForm" method="POST" action="{{ route('pacientes.store') }}">
        @csrf
        @include('pages.paciente._forms_create.situacao_caso', ['paciente' => $paciente])
        @include('pages.paciente._forms_create.paciente', ['paciente' => $paciente])
        @include('pages.paciente._forms_create.diagnostico_covid', ['paciente' => $paciente])
        @include('pages.paciente._forms_create.condicao_saude', ['paciente' => $paciente])
        <div class="row">
            <div class="col-sm-12 offset-sm-2s"><br />
                <button type="submit" id="createPaciente" class="btn btn-secondary">Enviar</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script>
    $('.temperature').mask('00,0');
    $('.saturation').mask('00');
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
