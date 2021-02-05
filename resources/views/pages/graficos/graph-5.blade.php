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
              <div>CASOS MONITORADOS POR CIDADE</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- CASOS MONITORADOS POR CIDADE - INÍCIO (GRÁFICO 5) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      CASOS MONITORADOS POR CIDADE
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="casos_monitorados_por_cidade" style="height:700px !important"></div>
            </div>
        </div>
    </div>
    <!-- CASOS MONITORADOS POR CIDADE - FIM -->
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

//CASOS MONITORADOS POR CIDADE - INICIO
axios.get('/chart/casos_monitorados_por_cidade')
  .then(response => {
    //console.log(response.data);
    var chart = am4core.create("casos_monitorados_por_cidade", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    //chart.legend = new am4charts.Legend();

    chart.data = response.data;

    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "quantidade";
    series.dataFields.category = "endereco_cidade";
  });
//CASOS MONITORADOS POR CIDADE - FIM
});
</script>
@endsection
