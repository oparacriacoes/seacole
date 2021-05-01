@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph3 text-primary">
                    </i>
                </div>
                <div>Gráficos
                    <div class="page-title-subheading">Veja as informações algum texto aqui depois pois estou sem criatividade //TODO</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <form action="">
                        <div class="form-row">
                            <div class="col-md-7">
                                <div class="position-relative form-group">
                                    <label for="chart" class="">Gráfico</label>
                                    <x-forms.select property="chart" :value="$chart" :items="$charts"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="datefrom" class="">De</label>
                                    <input id="datefrom" name="datefrom" type="date" class="form-control" value="{{$datefrom}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="dateto" class="">Até</label>
                                    <input name="dateto" id="dateto" type="date" class="form-control" value="{{$dateto}}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="periodo_ate" class="">&nbsp;</label>
                                    <button class="btn btn-primary btn-block">
                                        Gerar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mb-3 shadow-sm p-3">
                <canvas id="chartjs" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script>

        <script type="text/javascript">
            Chart.plugins.register(ChartDataLabels);
        </script>

        <x-charts.novos-casos-monitorados :datefrom="$datefrom" :dateto="$dateto"/>
    @endsection

</div>
@endsection
