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
              <div>ACOMPANHAMENTO DO SISTEMA DE SAÚDE</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- ACOMPANHAMENTO DO SISTEMA DE SAÚDE - INÍCIO (GRÁFICO 37) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      ACOMPANHAMENTO DO SISTEMA DE SAÚDE
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="acompanhamento_sistema_saude"></div>
            </div>
        </div>
    </div>
    <!-- ACOMPANHAMENTO DO SISTEMA DE SAÚDE - FIM -->
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

//ACOMPANHAMENTO DO SISTEMA DE SAÚDE - INÍCIO
axios.get('/chart/acompanhamento_sistema_saude')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    function am4themes_myTheme(target) {
    if (target instanceof am4core.ColorSet) {
      target.list = [
        //am4core.color("#0e0e0e"),
        //am4core.color("#0f0f0f"),
//        am4core.color("#aaff00"),//branca sim 395723
  //      am4core.color("#ff0000"),//branca nao fe0000
        am4core.color("#395723"),//branca sim 
        am4core.color("#fe0000"),//branca nao 
        am4core.color("#000000"),//preta sim d3d3d3
        am4core.color("#808080"),//preta nao ffff00
        am4core.color("#8b4513"),//parda sim
        am4core.color("#e06f1f")//parda nao
      ];
    }
  }
  am4core.useTheme(am4themes_myTheme);

    var chart = am4core.create("acompanhamento_sistema_saude", am4charts.XYChart);

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
//ACOMPANHAMENTO DO SISTEMA DE SAÚDE - FIM
});
</script>
@endsection
