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
              <div>CASOS AVALIADOS POR EQUIPE MÉDICA</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- CASOS AVALIADOS POR EQUIPE MÉDICA - INÍCIO (GRÁFICO 23) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      CASOS AVALIADOS POR EQUIPE MÉDICA
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="casos_avaliados_equipe_medica"></div>
            </div>
        </div>
    </div>
    <!-- CASOS AVALIADOS POR EQUIPE MÉDICA - FIM -->
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

//CASOS AVALIADOS POR EQUIPE MÉDICA - INÍCIO
axios.get('/chart/casos_avaliados_equipe_medica')
  .then(response => {
    //console.log(response.data);

    var chart = am4core.create("casos_avaliados_equipe_medica", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data;
    /*chart.data = [
    {medicos: "Bruna Santo Silveira",quantidade_pacientes: 77},
    {medicos: "Cleber Firmino",quantidade_pacientes: 1},
    {medicos: "Gladys Prado",quantidade_pacientes: 8}
    ];*/

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade_pacientes";
    series.dataFields.category = "medicos";
  });
//CASOS AVALIADOS POR EQUIPE MÉDICA - FIM
});
</script>
@endsection
