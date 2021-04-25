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
              <div>DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO (GRÁFICO 20) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="dias_sintoma_mais_menos_dez_dias"></div>
            </div>
        </div>
    </div>
    <!-- DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM -->
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

//DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO
axios.get('/admin/chart/dias_sintoma_mais_menos_dez_dias')
  .then(response => {
    //console.log(response.data);

    var chart = am4core.create("dias_sintoma_mais_menos_dez_dias", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = [
      {
        quantidade_dias: "Mais de dez dias",
        pacientes: 41
      },
      {
        quantidade_dias: "Menos de dez dias",
        pacientes: 189
      }
    ];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "pacientes";
    series.dataFields.category = "quantidade_dias";
  });
//DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM
});
</script>
@endsection
