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
              <div>GÊNERO POR RAÇA-COR</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- GENERO POR RAÇA-COR - INÍCIO (GRÁFICO 7) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      GÊNERO POR RAÇA-COR
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="genero_por_raca_cor"></div>
              <div class="text-center"><p id="legenda_genero_por_raca_cor"></p></div>
            </div>
        </div>
    </div>
    <!-- GENERO POR RAÇA-COR - FIM -->
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



//GENERO POR RAÇA-COR - INÍCIO
axios.get('/admin/chart/genero_por_raca_cor')
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
    var chart = am4core.create("genero_por_raca_cor", am4charts.XYChart);

    // Add data
    chart.data = response.data[0];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "identidade_genero";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.title.text = "São 147 mulheres cis e 64 homens cis de Raça Negra (Preta + Parda)";

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inside = true;
    valueAxis.renderer.labels.template.disabled = true;
    valueAxis.min = 0;

    // Create series
    function createSeries(field, name) {
      // Set up series
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.name = name;
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "identidade_genero";
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

    var title = chart.titles.create();
    title.text = "GÊNERO POR RAÇA-COR";
    title.fontSize = 25;
    title.marginBottom = 30;

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
  });
//GENERO POR RAÇA-COR - FIM
});
</script>
@endsection
