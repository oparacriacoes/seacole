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
              <div>INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2)</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2) - INÍCIO (GRÁFICO 14) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2)
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="insumos_oferecidos_pelo_projeto_raca_cor_2"></div>
            </div>
        </div>
    </div>
    <!-- INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2) - FIM -->
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

//INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2) - INÍCIO
axios.get('/chart/insumos_oferecidos_pelo_projeto_raca_cor_2')
  .then(response => {
    //console.log(response.data);
    let dataSet = {};
    for(var i=0;i<response.data.length;i++){
      //console.log(response.data[i]);
      dataSet[response.data[i].pergunta] = {
        'Branco':response.data[i].branca,
        'Indígena':response.data[i].indigena,
        'Amarelo':response.data[i].amarela,
        'Negro':response.data[i].negro,
        'Não info.':response.data[i].nao_info,
      }
    };
    //console.log('dataSet',dataSet);

    var chart = am4core.create("insumos_oferecidos_pelo_projeto_raca_cor_2", am4charts.XYChart);

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
      "Sim \n\n Precisa de ajuda para comprar remédios de uso contínuo?":
        {"Branco": 7,"Indígena": 0,"Amarelo": 0,"Negro": 12,"Não info.": 0},
      "Não \n\n Precisa de ajuda para comprar remédios de uso contínuo?":
        {"Branco": 23,"Indígena": 0,"Amarelo": 0,"Negro": 31,"Não info.": 3},
      "Sim \n\n Precisa de ajuda para comprar remédios para o tratamento do quadro atual?":
        {"Branco": 8,"Indígena": 0,"Amarelo": 0,"Negro": 14,"Não info.": 2},
      "Não \n\n Precisa de ajuda para comprar remédios para o tratamento do quadro atual?":
        {"Branco": 22,"Indígena": 0,"Amarelo": 0,"Negro": 29,"Não info.": 1},
      "Sim \n\n Precisa de ajuda para comprar alimento ou outro produtos de necessidade básica?":
        {"Branco": 17,"Indígena": 0,"Amarelo": 0,"Negro": 20,"Não info.": 1},
      "Não \n\n Precisa de ajuda para comprar alimento ou outro produtos de necessidade básica?":
        {"Branco": 13,"Indígena": 0,"Amarelo": 0,"Negro": 23,"Não info.": 2},
      "Sim \n\n Precisa de ajuda para outros?":
        {"Branco": 0,"Indígena": 0,"Amarelo": 0,"Negro": 0,"Não info.": 0},
      "Não \n\n Precisa de ajuda para outros?":
        {"Branco": 30,"Indígena": 0,"Amarelo": 0,"Negro": 41,"Não info.": 3},
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
  });
//INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2) - FIM
});
</script>
@endsection
