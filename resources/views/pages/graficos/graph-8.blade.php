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
    <!-- FAIXA ETÁRIA POR GÊNERO - INÍCIO (GRÁFICO 8) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      FAIXA ETÁRIA POR GÊNERO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="faixa_etaria_genero"></div>
            </div>
        </div>
    </div>
    <!-- FAIXA ETÁRIA POR GÊNERO - FIM -->
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

//FAIXA ETÁRIA POR GÊNERO - INÍCIO
axios.get('/admin/chart/faixa_etaria_genero')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    var chart = am4core.create("faixa_etaria_genero", am4charts.XYChart);

    // Add data
    chart.data = response.data;

    // Use only absolute numbers
    chart.numberFormatter.numberFormat = "#.#s";

    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "idade";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.inversed = true;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.extraMin = 0.1;
    valueAxis.extraMax = 0.1;
    valueAxis.renderer.minGridDistance = 40;
    valueAxis.renderer.ticks.template.length = 5;
    valueAxis.renderer.ticks.template.disabled = false;
    valueAxis.renderer.ticks.template.strokeOpacity = 0.4;
    valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text == "homens" || text == "mulheres" ? text : text;
    })

    // Create series
    var homens = chart.series.push(new am4charts.ColumnSeries());
    homens.dataFields.valueX = "homens";
    homens.dataFields.categoryY = "idade";
    homens.clustered = false;

    var homensLabel = homens.bullets.push(new am4charts.LabelBullet());
    homensLabel.label.text = "{valueX}";
    homensLabel.label.hideOversized = false;
    homensLabel.label.truncate = false;
    homensLabel.label.horizontalCenter = "right";
    homensLabel.label.dx = -10;

    var mulheres = chart.series.push(new am4charts.ColumnSeries());
    mulheres.dataFields.valueX = "mulheres";
    mulheres.dataFields.categoryY = "idade";
    mulheres.clustered = false;

    var mulheresLabel = mulheres.bullets.push(new am4charts.LabelBullet());
    mulheresLabel.label.text = "{valueX}";
    mulheresLabel.label.hideOversized = false;
    mulheresLabel.label.truncate = false;
    mulheresLabel.label.horizontalCenter = "left";
    mulheresLabel.label.dx = 10;

    var homensRange = valueAxis.axisRanges.create();
    homensRange.value = -10;
    homensRange.endValue = 0;
    homensRange.label.text = "Homens CIS";
    homensRange.label.fill = chart.colors.list[0];
    homensRange.label.dy = 20;
    homensRange.label.fontWeight = '600';
    homensRange.grid.strokeOpacity = 1;
    homensRange.grid.stroke = homens.stroke;

    var mulheresRange = valueAxis.axisRanges.create();
    mulheresRange.value = 0;
    mulheresRange.endValue = 10;
    mulheresRange.label.text = "Mulheres CIS";
    mulheresRange.label.fill = chart.colors.list[1];
    mulheresRange.label.dy = 20;
    mulheresRange.label.fontWeight = '600';
    mulheresRange.grid.strokeOpacity = 1;
    mulheresRange.grid.stroke = mulheres.stroke;
  });
//FAIXA ETÁRIA POR GÊNERO - FIM
});
</script>
@endsection
