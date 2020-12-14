@extends('layouts.app_new')

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
              <div>DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO (GRÁFICO 20) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="dias_sintoma_mais_menos_dez_dias"></div>
            </div>
        </div>
    </div>
    <!-- DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM -->
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

//DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO
axios.get('/chart/dias_sintoma_mais_menos_dez_dias')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    var chart = am4core.create("dias_sintoma_mais_menos_dez_dias", am4charts.XYChart);

    // Add data
    chart.data = response.data[0];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "cor_raca";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.cellStartLocation = 0.1;
    categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;

    // Create series
    function createSeries(field, name, stacked) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "cor_raca";
      series.name = name;
      series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
      series.stacked = stacked;
      series.columns.template.width = am4core.percent(95);
    }

    createSeries("mais_10", "Mais de 10 dias", true);
    createSeries("menos_10", "Menos de 10 dias", true);
    createSeries("mais_10_preta", "Preta Mais de 10 dias", true);
    createSeries("menos_10_preta", "Preta Menos de 10 dias", true);
    createSeries("mais_10_parda", "Parda Mais de 10 dias", true);
    createSeries("menos_10_parda", "Parda Menos de 10 dias", true);

    // Add legend
    chart.legend = new am4charts.Legend();
  });
//DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM
});
</script>
@endsection
