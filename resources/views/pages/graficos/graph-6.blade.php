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
              <div>RAÇA-COR GERAL DAS PESSOAS ATENDIDAS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- RAÇA COR GERAL - INÍCIO (GRÁFICO 6) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      RAÇA-COR GERAL DAS PESSOAS ATENDIDAS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="raca_cor_geral" style="height:700px !important"></div>
              <div class="text-center"><p id="legenda"></p></div>
            </div>
        </div>
    </div>
    <!-- RAÇA COR GERAL - FIM -->
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

//RAÇA COR GERAL - INÍCIO
axios.get('/chart/raca_cor_geral')
  .then(response => {
    //console.log(response.data[0]);
    am4core.useTheme(am4themes_myTheme);
    function am4themes_myTheme(target) {
      if (target instanceof am4core.ColorSet) {
        target.list = [
          am4core.color("#d3d3d3"),//cinza
          am4core.color("#000000"),//preto
          am4core.color("#8b4513"),//marrom
          am4core.color("#0000ff"),//azul
          am4core.color("#ff0000"),//vermelho
          am4core.color("#ffff00")//amarelo
        ];
      }
    }
    var chart = am4core.create("raca_cor_geral", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data[0];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade";
    series.dataFields.category = "cor_raca";
    $('#legenda').text(response.data[1][0].legenda);
  });
//RAÇA COR GERAL - FIM
});
</script>
@endsection
