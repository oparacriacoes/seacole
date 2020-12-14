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
              <div>SITUAÇÃO TOTAL DE CASOS MONITORADOS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS - INÍCIO (GRÁFICO 3) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      SITUAÇÃO TOTAL DE CASOS MONITORADOS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="situacao_total_casos_monitorados"></div>
            </div>
        </div>
    </div>
    <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM -->
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
axios.get('/chart/situacao_total_casos_monitorados')
  .then(response => {
    //console.log(response.data[0]);
    var chart = am4core.create("situacao_total_casos_monitorados", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data[0];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade_casos";
    series.dataFields.category = "situacao";
  });
//SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM
});
</script>
@endsection
