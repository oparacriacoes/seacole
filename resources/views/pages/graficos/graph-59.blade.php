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
              <div>TEMPO DE INTERNAÇÃO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- TEMPO DE INTERNAÇÃO - INÍCIO (GRÁFICO 56) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      TEMPO DE INTERNAÇÃO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="tempo_de_internacao"></div>
            </div>
        </div>
    </div>
    <!-- TEMPO DE INTERNAÇÃO - FIM -->
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

//TEMPO DE INTERNAÇÃO - INÍCIO
axios.get('/chart/tempo_de_internacao')
  .then(response => {
    //console.log(response.data);
    /*let dataSet = {};
    for(var i=0;i<response.data.length;i++){
      //console.log(response.data[i]);
      dataSet[response.data[i].pergunta] = {
        'Branco':response.data[i].branca,
        'Indígena':response.data[i].indigena,
        'Amarelo':response.data[i].amarela,
        'Negro':response.data[i].negro,
        'Não info.':response.data[i].nao_info,
      }
    };*/
    //console.log('dataSet',dataSet);

    // Create chart instance
    var chart = am4core.create("tempo_de_internacao", am4charts.XYChart3D);

    // Add data
    chart.data = response.data;
    /*chart.data = [
    {tempo_internacao: "1", preta: 1, parda: 0, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "2", preta: 0, parda: 0, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "4", preta: 1, parda: 0, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "5", preta: 2, parda: 0, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "6", preta: 0, parda: 1, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "8", preta: 2, parda: 0, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "10", preta: 0, parda: 0, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "11", preta: 0, parda: 1, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "12", preta: 1, parda: 1, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "13", preta: 1, parda: 0, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "16", preta: 0, parda: 1, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "17", preta: 0, parda: 1, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "24", preta: 1, parda: 0, branca: 0, amarela: 0, indigena: 0, sem_informacao: 0},
    {tempo_internacao: "32", preta: 0, parda: 0, branca: 1, amarela: 0, indigena: 0, sem_informacao: 0}
    ];*/

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "tempo_internacao";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.title.text = "*Negras e negros (pretos + pardos)";

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inside = true;
    valueAxis.renderer.labels.template.disabled = true;
    valueAxis.min = 0;

    // Create series
    function createSeries(field, name) {

      // Set up series
      var series = chart.series.push(new am4charts.ColumnSeries3D());
      series.name = name;
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "tempo_internacao";
      series.sequencedInterpolation = true;

      // Make it stacked
      series.stacked = true;

      // Configure columns
      series.columns.template.width = am4core.percent(60);
      series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

      // Add label
      var labelBullet = series.bullets.push(new am4charts.LabelBullet());
      labelBullet.label.text = "{valueY}";
      labelBullet.locationY = 0.5;
      labelBullet.label.hideOversized = true;

      return series;
    }

    createSeries("preta", "Preta");
    createSeries("parda", "Parda");
    createSeries("branca", "Branca");
    createSeries("amarela", "Amarela");
    createSeries("indigena", "Indígena");
    createSeries("sem_informacao", "Sem informação");

    // Legend
    chart.legend = new am4charts.Legend();
//TEMPO DE INTERNAÇÃO - FIM
  });
});
</script>
@endsection
