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
              <div>IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS (PESSOAS PARDAS)</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS PESSOAS PARDAS - INÍCIO (GRÁFICO 55) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS (PESSOAS PARDAS)
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="idas_sistema_saude_x_prescricao_medicamentos_pardas"></div>
            </div>
        </div>
    </div>
    <!-- IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS PESSOAS PARDAS - FIM -->
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

//IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS PESSOAS PARDAS - INÍCIO
axios.get('/chart/idas_sistema_saude_x_prescricao_medicamentos_pardas')
  .then(response => {
    //console.log(response.data);

    var chart = am4core.create("idas_sistema_saude_x_prescricao_medicamentos_pardas", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = response.data;
    /*chart.data = [
    {medicamentos: "Somente outros medicamentos",quantidade: 7},
    {medicamentos: "Não recebeu nenhum medicamento",quantidade: 78},
    {medicamentos: "Não recebeu nenhum medicamento",quantidade: 7},
    {medicamentos: "Somente outros medicamentos",quantidade: 4}
  ];*/

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "quantidade";
    series.dataFields.category = "medicamentos";
  });
//IDAS AO SISTEMA DE SAÚDE X % DE PRESCRIÇÕES MEDICAMENTOS PESSOAS PARDAS - FIM
});
</script>
@endsection
