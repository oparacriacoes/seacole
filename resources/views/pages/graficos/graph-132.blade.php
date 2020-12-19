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
              <div>RAÇA/COR POR AUXÍLIO EMERGENCIAL</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- RAÇA/COR POR AUXÍLIO EMERGENCIAL - INÍCIO (GRÁFICO 13_2) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      RAÇA/COR POR AUXÍLIO EMERGENCIAL
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="raca_cor_por_auxilio_emergencial"></div>
            </div>
        </div>
    </div>
    <!-- RAÇA/COR POR AUXÍLIO EMERGENCIAL - FIM -->
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

//RAÇA/COR POR AUXÍLIO EMERGENCIAL - INÍCIO
axios.get('/chart/raca_cor_por_auxilio_emergencial')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    var chart = am4core.create("raca_cor_por_auxilio_emergencial", am4charts.XYChart);

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

    createSeries("sim", "sim", true);
    createSeries("nao", "Não", true);
    createSeries("sim_preta", "Preta sim", true);
    createSeries("nao_preta", "Preta não", true);
    createSeries("sim_parda", "Parda sim", true);
    createSeries("nao_parda", "Parda não", true);

    // Add legend
    chart.legend = new am4charts.Legend();
  });
//RAÇA/COR POR AUXÍLIO EMERGENCIAL - FIM
});
</script>
@endsection