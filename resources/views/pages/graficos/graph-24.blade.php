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
              <div>ACOMPANHAMENTO PSICOLÓGICO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- ACOMPANHAMENTO PSICOLÓGICO - INÍCIO (GRÁFICO 24) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      ACOMPANHAMENTO PSICOLÓGICO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="acompanhamento_psicologico"></div>
            </div>
        </div>
    </div>
    <!-- ACOMPANHAMENTO PSICOLÓGICO - FIM -->
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

//ACOMPANHAMENTO PSICOLÓGICO - INÍCIO
axios.get('/chart/acompanhamento_psicologico')
  .then(response => {
    //console.log(response.data);

    var chart = am4core.create("acompanhamento_psicologico", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data;
    /*chart.data = [
    {psicologo: "Cátia Cipriano",quantidade_pacientes: 57},
    {psicologo: "Mayra Ribeiro",quantidade_pacientes: 48},
    {psicologo: "Eliseu Oliveira dos Santos",quantidade_pacientes: 42},
    {psicologo: "Juliana",quantidade_pacientes: 49}
    ];*/

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade_pacientes";
    series.dataFields.category = "psicologo";
  });
//ACOMPANHAMENTO PSICOLÓGICO - FIM
});
</script>
@endsection
