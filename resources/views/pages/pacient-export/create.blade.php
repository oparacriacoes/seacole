@extends('layouts.app')

@section('content')
    <div class="app-main__inner mb-4">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-download text-primary">
                        </i>
                    </div>
                    <div>Exportar Dados
                        <div class="page-title-subheading">Escolha quais informações exportar e tenha o histórico das
                            exportações mais recentes
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        O que você quer exportar sobre os pacientes?
                    </div>
                    <div class="card-body">
                        <form action="{{route('pacientes-export.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="export_pacientes" value="true">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="pacientes" id="export_pacientes" checked>
                                        <label class="form-check-label" for="export_pacientes">
                                            Pacientes
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="quadro_atual" id="export_quadro_atual">
                                        <label class="form-check-label" for="export_quadro_atual">
                                            Quadro Atual
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="monitoramentos" id="export_monitoramentos">
                                        <label class="form-check-label" for="export_monitoramentos">
                                            Monitoramentos
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="saude_mental" id="export_saude_mental">
                                        <label class="form-check-label" for="export_saude_mental">
                                            Saúde Mental
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="servico_referencia" id="export_servico_referencia">
                                        <label class="form-check-label" for="export_servico_referencia">
                                            Serviços de Referência e Internação
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" name="export_models[]" type="checkbox"
                                            value="insumos_oferecidos" id="export_insumos_oferecidos">
                                        <label class="form-check-label" for="export_insumos_oferecidos">
                                            Insumos Oferecidos
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <button class="btn btn-primary">Exportar</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Histórico de Evolução dos Sintomas
                    </div>
                    <div class="card-body">
                        <form action="{{route('pacientes-export.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="export_evolucao_sintomas" value="true">

                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary">Exportar</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
