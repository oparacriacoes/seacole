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
              <div>INTERNAÇÃO X DIAGNÓSTICO</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- INTERNAÇÃO X DIAGNÓSTICO - INÍCIO (GRÁFICO 60) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      INTERNAÇÃO X DIAGNÓSTICO
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="internacao_diagnostico"></div>
            </div>
        </div>
    </div>
    <!-- INTERNAÇÃO X DIAGNÓSTICO - FIM -->
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

//INTERNAÇÃO X DIAGNÓSTICO - INÍCIO
axios.get('/chart/internacao_diagnostico')
  .then(response => {
    //console.log(response.data);
    let dataSet = {};
    for(var i=0;i<response.data.length;i++){
      //console.log(response.data[i]);
      dataSet[response.data[i].sintomas_iniciais] = {
        'Branco':response.data[i].branca,
        'Indígena':response.data[i].indigena,
        'Amarelo':response.data[i].amarela,
        'Negro':response.data[i].negro,
        'Não info.':response.data[i].nao_info,
      }
    };
    //console.log('dataSet',dataSet);

    var chart = am4core.create("internacao_diagnostico", am4charts.XYChart);

    // some extra padding for range labels
    chart.paddingBottom = 50;

    chart.cursor = new am4charts.XYCursor();
    chart.scrollbarX = new am4core.Scrollbar();

    // will use this to store colors of the same items
    var colors = {};

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.minGridDistance = 60;
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataItems.template.text = "{realName}";
    categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
      return categoryAxis.tooltipDataItem.dataContext.realName;
    })

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.min = 0;

    // single column series for all data
    var columnSeries = chart.series.push(new am4charts.ColumnSeries());
    columnSeries.columns.template.width = am4core.percent(80);
    columnSeries.tooltipText = "{realName}: {valueY}";
    columnSeries.dataFields.categoryX = "category";
    columnSeries.dataFields.valueY = "value";

    // second value axis for quantity
    var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis2.renderer.opposite = true;
    valueAxis2.syncWithAxis = valueAxis;
    valueAxis2.tooltip.disabled = true;

    let label = categoryAxis.renderer.labels.template;
    label.wrap = true;
    label.maxWidth = 120;

    // fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
    columnSeries.columns.template.adapter.add("fill", function(fill, target) {
     var name = target.dataItem.dataContext.realName;
     if (!colors[name]) {
       colors[name] = chart.colors.next();
     }
     target.stroke = colors[name];
     return colors[name];
    })

    var rangeTemplate = categoryAxis.axisRanges.template;
    rangeTemplate.tick.disabled = false;
    rangeTemplate.tick.location = 0;
    rangeTemplate.tick.strokeOpacity = 0.6;
    rangeTemplate.tick.length = 60;
    rangeTemplate.grid.strokeOpacity = 0.5;
    rangeTemplate.label.tooltip = new am4core.Tooltip();
    rangeTemplate.label.tooltip.dy = -10;
    rangeTemplate.label.cloneTooltip = false;

    ///// DATA
    var chartData = [];
    var lineSeriesData = [];

    var data = dataSet;
    /*var data =
    {
      "Sim \n\n Confirmado":
        {"Branco": 45,"Indígena": 0,"Amarelo": 0,"Negro": 87,"Não info.": 0},
      "Não \n\n Confirmado":
        {"Branco": 312,"Indígena": 0,"Amarelo": 0,"Negro": 440,"Não info.": 0},
      "Sim \n\n Suspeito":
        {"Branco": 8,"Indígena": 0,"Amarelo": 0,"Negro": 0,"Não info.": 0},
      "Não \n\n Suspeito":
        {"Branco": 227,"Indígena": 0,"Amarelo": 0,"Negro": 440,"Não info.": 21},
      "Sim \n\n Descartado":
        {"Branco": 6,"Indígena": 0,"Amarelo": 0,"Negro": 0,"Não info.": 0},
      "Não \n\n Descartado":
        {"Branco": 16,"Indígena": 0,"Amarelo": 0,"Negro": 48,"Não info.": 8}
    }*/

    // process data ant prepare it for the chart
    for (var providerName in data) {
     var providerData = data[providerName];

     // add data of one provider to temp array
     var tempArray = [];
     var count = 0;
     // add items
     for (var itemName in providerData) {
       count++;
       // we generate unique category for each column (providerName + "_" + itemName) and store realName
       tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
     }
     // sort temp array
     tempArray.sort(function(a, b) {
       if (a.value > b.value) {
       return 1;
       }
       else if (a.value < b.value) {
       return -1
       }
       else {
       return 0;
       }
     })

     // push to the final data
     am4core.array.each(tempArray, function(item) {
       chartData.push(item);
     })

     // create range (the additional label at the bottom)
     var range = categoryAxis.axisRanges.create();
     range.category = tempArray[0].category;
     range.endCategory = tempArray[tempArray.length - 1].category;
     range.label.text = tempArray[0].provider;
     range.label.dy = 30;
     range.label.wrap = true;
     range.label.fontWeight = "bold";
     range.label.tooltipText = tempArray[0].provider;

     range.label.adapter.add("maxWidth", function(maxWidth, target){
       var range = target.dataItem;
       var startPosition = categoryAxis.categoryToPosition(range.category, 0);
       var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
       var startX = categoryAxis.positionToCoordinate(startPosition);
       var endX = categoryAxis.positionToCoordinate(endPosition);
       return endX - startX;
     })
    }

    chart.data = chartData;

    // last tick
    var range = categoryAxis.axisRanges.create();
    range.category = chart.data[chart.data.length - 1].category;
    range.label.disabled = true;
    range.tick.location = 1;
    range.grid.location = 1;
//INTERNAÇÃO X DIAGNÓSTICO - FIM
  });
});
</script>
@endsection