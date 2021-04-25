@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/graphs.css') }}">
@endsection

@section('content')
<div class="app-main__inner">
  <div class="app-page-title">
      <div class="page-title-wrapper">
          <div class="page-title-heading">
              <div class="page-title-icon">
                  <i class="pe-7s-car icon-gradient bg-mean-fruit">
                  </i>
              </div>
              <div>SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO - INÍCIO (GRÁFICO 49) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="servicos_referencia_internacao"></div>
            </div>
        </div>
    </div>
    <!-- SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO - FIM -->
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>
<script src="{{ asset('js/charts.js') }}"></script>
<script src="{{ asset('js/animated.js') }}"></script>
<script src="{{ asset('js/pt_BR.js') }}"></script>
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

//SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO - INÍCIO
axios.get('/admin/chart/servicos_referencia_internacao')
  .then(response => {
    console.log(response.data);

    // Create chart instance
    var chart = am4core.create("servicos_referencia_internacao", am4charts.XYChart3D);

    // Add data
    chart.data = response.data;
    /*chart.data = [{
      "idas_servico_saude": 0,
      "pacientes": 254
    }, {
      "idas_servico_saude": 1,
      "pacientes": 96
    }, {
      "idas_servico_saude": 2,
      "pacientes": 32
    }, {
      "idas_servico_saude": 3,
      "pacientes": 12
    }, {
      "idas_servico_saude": 4,
      "pacientes": 3
    }, {
      "idas_servico_saude": 5,
      "pacientes": 2
    }, {
      "idas_servico_saude": 8,
      "pacientes": 1
    }];*/

    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "idas_servico_saude";
    categoryAxis.numberFormatter.numberFormat = "#";
    categoryAxis.renderer.inversed = false;

    var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.dataFields.valueX = "pacientes";
    series.dataFields.categoryY = "idas_servico_saude";
    series.name = "pacientes";
    series.columns.template.propertyFields.fill = "color";
    series.columns.template.tooltipText = "Número de idas ao serviço de saúde: {valueX}";
    series.columns.template.column3D.stroke = am4core.color("#fff");
    series.columns.template.column3D.strokeOpacity = 0.2;
  });
//SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO - FIM
});
</script>
@endsection
