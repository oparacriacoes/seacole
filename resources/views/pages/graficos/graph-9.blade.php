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
              <div>FAIXA ETÁRIA POR GÊNERO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- FAIXA ETÁRIA POR GÊNERO 2 - INÍCIO (GRÁFICO 9) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      FAIXA ETÁRIA POR GÊNERO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="faixa_etaria_genero_2"></div>
            </div>
        </div>
    </div>
    <!-- FAIXA ETÁRIA POR GÊNERO 2 - FIM -->
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

//FAIXA ETÁRIA POR GÊNERO 2 - INÍCIO
axios.get('/chart/faixa_etaria_genero_2')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    var chart = am4core.create("faixa_etaria_genero_2", am4charts.XYChart3D);

    // Add data
    chart.data = response.data[0];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "idade";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;

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
      series.dataFields.categoryX = "idade";
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

    createSeries("homens", "Homens");
    createSeries("mulheres", "Mulheres");
    createSeries("sem_informacao", "Sem informação");

    // Legend
    chart.legend = new am4charts.Legend();
  });
//FAIXA ETÁRIA POR GÊNERO 2 - FIM
});
</script>
@endsection
