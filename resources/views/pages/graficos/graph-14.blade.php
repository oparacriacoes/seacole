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
              <div>INSUMOS OFERECIDOS PELO PROJETO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- INSUMOS OFERECIDOS PELO PROJETO - INÍCIO (GRÁFICO 14) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      INSUMOS OFERECIDOS PELO PROJETO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="insumos_oferecidos_pelo_projeto"></div>
            </div>
        </div>
    </div>
    <!-- INSUMOS OFERECIDOS PELO PROJETO - FIM -->
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

//INSUMOS OFERECIDOS PELO PROJETO - INÍCIO
axios.get('/chart/insumos_oferecidos_pelo_projeto')
  .then(response => {
    //console.log(response.data);
    // Create chart instance
    var chart = am4core.create("insumos_oferecidos_pelo_projeto", am4charts.XYChart);

    // Add data
    chart.data = response.data[0];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "cor_raca";
    categoryAxis.title.text = "Local country offices";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.cellStartLocation = 0.1;
    categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.title.text = "Expenditure (M)";

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

    createSeries("sim_isolamento_residencial_N ", "Sim" , false);
    createSeries("nao_isolamento_residencial_N", "Não", true);
    createSeries("sem_info_isolamento_residencial_N", "Sem inf.", true);
    createSeries("sim_isolamento_residencial", "Sim2", false);
    createSeries("nao_isolamento_residencial", "Não2", true);
    createSeries("sem_info_isolamento_residencial", "Sem inf.2", true);
    createSeries("sim_alimentacao_disponivel_N", "Sim", false);
    createSeries("nao_alimentacao_disponivel_N", "Não", true);
    createSeries("sem_info_alimentacao_disponivel_N", "Sem inf.", true);
    createSeries("sim_alimentacao_disponivel", "Sim", false);
    createSeries("nao_alimentacao_disponivel", "Não", true);
    createSeries("sem_info_alimentacao_disponivel", "Sem inf.", true);
    createSeries("sim_auxilio_terceiros_N", "Sim", false);
    createSeries("nao_auxilio_terceiros_N", "Não", true);
    createSeries("sem_info_auxilio_terceiros_N", "Sem inf.", true);
    createSeries("sim_auxilio_terceiros", "Sim", false);
    createSeries("nao_auxilio_terceir", "Não", true);
    createSeries("sem_info_auxilio_terceiros", "Sem inf.", true);
    createSeries("sim_tarefas_autocuidado_N", "Sim", false);
    createSeries("nao_tarefas_autocuidado_N", "Não", true);
    createSeries("sem_info_tarefas_autocuidado_N", "Sem inf.", true);
    createSeries("sim_tarefas_autocuidado", "Sim", false);
    createSeries("nao_tarefas_autocuidado", "Não", true);
    createSeries("sem_info_tarefas_autocuidado", "Sem inf.", true);

    // Add legend
    chart.legend = new am4charts.Legend();
  });
//INSUMOS OFERECIDOS PELO PROJETO - FIM
});
</script>
@endsection
