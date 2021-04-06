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
              <div>CASOS MONITORADOS POR AGENTES</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- CASOS MONITORADOS POR AGENTES - INÍCIO (GRÁFICO 22) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      CASOS MONITORADOS POR AGENTES
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="casos_monitorados_por_agente"></div>
            </div>
        </div>
    </div>
    <!-- CASOS MONITORADOS POR AGENTES - INÍCIO - FIM -->
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

//CASOS MONITORADOS POR AGENTES - INÍCIO
axios.get('/chart/casos_monitorados_por_agente')
  .then(response => {
    console.log(response.data);

    var chart = am4core.create("casos_monitorados_por_agente", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data;
    /*chart.data = [
    {nome_agente: "Letícia dos Santos", quantidade_pacientes: 57},
    {nome_agente: "Sandra Regina Ap. dos Santos", quantidade_pacientes: 89},
    {nome_agente: "Lika", quantidade_pacientes: 18},
    {nome_agente: "Murilo", quantidade_pacientes: 21},
    {nome_agente: "Alessandra", quantidade_pacientes: 59},
    {nome_agente: "Elis", quantidade_pacientes: 27}
    ];*/

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade_pacientes";
    series.dataFields.category = "nome_agente";
  });
//CASOS MONITORADOS POR AGENTES - FIM
});
</script>
@endsection
