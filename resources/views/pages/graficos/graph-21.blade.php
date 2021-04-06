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
              <div>TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19)</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - INÍCIO (GRÁFICO 21) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19)
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="total_dias_monitoramento_relacao_covid"></div>
            </div>
        </div>
    </div>
    <!-- TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - FIM -->
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

//TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - INÍCIO
axios.get('/chart/total_dias_monitoramento_relacao_covid')
  .then(response => {
    //console.log(response.data);
    function am4themes_myTheme(target) {
    if (target instanceof am4core.ColorSet) {
      target.list = [
        am4core.color("#000000"),
        am4core.color("#8b4513"),
        am4core.color("#d3d3d3"),
        am4core.color("#ffff00"),
        am4core.color("#ff0000"),
        am4core.color("#0000ff")
      ];
    }
  }
  am4core.useTheme(am4themes_myTheme);
  // Create chart instance
  var chart = am4core.create("total_dias_monitoramento_relacao_covid", am4charts.XYChart3D);

  // Add data
  chart.data = response.data[0];

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "dias";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.title.text = "*Negras e negros (pretos + pardos)";

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.inside = true;
  valueAxis.renderer.labels.template.disabled = true;
  valueAxis.min = 0;

  // Create series
  function createSeries(field, name) {

    // Set up series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.name = name;
    series.dataFields.valueY = field;
    series.dataFields.categoryX = "dias";
    series.sequencedInterpolation = true;

    // Make it stacked
    series.stacked = true;

    // Configure columns
    series.columns.template.width = am4core.percent(60);
    series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

    // Add label
    var labelBullet = series.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.text = "{valueY}";
    labelBullet.locationY = 0.5;
    labelBullet.label.hideOversized = true;

    return series;
  }

  createSeries("preta", "Preta");
  createSeries("parda", "Parda");
  createSeries("branca", "Branca");
  createSeries("amarela", "Amarela");
  createSeries("indigena", "Indígena");
  createSeries("sem_informacao", "Sem informação");

  // Legend
  chart.legend = new am4charts.Legend();
  });
//TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - FIM
});
</script>
@endsection
