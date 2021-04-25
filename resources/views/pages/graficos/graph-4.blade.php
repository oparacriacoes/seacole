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
              <div>SITUAÇÃO TOTAL DE CASOS MONITORADOS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS 1 - INÍCIO (GRÁFICO 4) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      SITUAÇÃO TOTAL DE CASOS MONITORADOS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="situacao_total_casos_monitorados_1"></div>
            </div>
        </div>
    </div>
    <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS 1 - FIM -->
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

//SITUAÇÃO TOTAL DE CASOS MONITORADOS - INÍCIO
axios.get('/admin/chart/situacao_total_casos_monitorados_1')
  .then(response => {
    console.log(response.data);
    // Create chart instance
    var chart = am4core.create("situacao_total_casos_monitorados_1", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = response.data;

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "situacao";

    let label = categoryAxis.renderer.labels.template;
    label.wrap = true;
    label.maxWidth = 120;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "quantidade";
    series.dataFields.categoryX = "situacao";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();
  });
//SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM
});
</script>
@endsection
