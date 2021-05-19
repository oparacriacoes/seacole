@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="row">
        @if($vacina->doses == 1)
        <div class="col">
            <div class="card mb-3 widget-content bg-primary">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Pacientes Vacinados</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$pacientes_vacinados}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($vacina->doses > 1)
        <div class="col">
            <div class="card mb-3 widget-content bg-primary">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Pacientes Vacinados</div>
                        <div class="widget-subheading">Receberam todas doses</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$pacientes_vacinados}}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-3 widget-content bg-info">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Parcialmente Vacinados</div>
                        <div class="widget-subheading">Receberam ao menos uma dose</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$pacientes_parcialmente_vacinados}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 p-3 font-weight-bold">
                            Nome
                        </div>
                        <div class="col-md-8 p-3">
                            {{$vacina->name}}
                        </div>
                    </div>
                    <div class="row bg-light">
                        <div class="col-md-4 p-3 font-weight-bold">
                            Está disponível
                        </div>
                        <div class="col-md-8 p-3">
                            {{$vacina->is_active ? 'Sim' : 'Não'}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 p-3 font-weight-bold">
                            Número de doses
                        </div>
                        <div class="col-md-8 p-3">
                            {{$vacina->doses}}
                        </div>
                    </div>

                    <div class="row bg-light">
                        <div class="col-md-4 p-3 font-weight-bold">
                            Intervalo de dias entre doses
                        </div>
                        <div class="col-md-8 p-3">
                            @if($vacina->doses == 1)
                                Vacina de dose única
                            @else
                                Entre {{$vacina->intervalo_inicial_proxima_dose}} e {{$vacina->intervalo_final_proxima_dose}} dias
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-info mr-1" href="{{route('vacinas.edit', $vacina)}}">Alterar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
