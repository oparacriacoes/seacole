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
axios.get('/chart/dias_sintoma_mais_menos_dez_dias')
  .then(response => {
    //console.log(response.data);
    let dataSet = [];
    let color = '';
    for(var i=0;i<response.data.length;i++){
      //console.log(response.data[i]);
      let raca = response.data[i].cor_raca;
      switch (raca) {
        case 'Negra':
          color = "#000000";
          break;
        case 'Branca':
          color = "#d3d3d3";
          break;
        case 'Sem info.':
          color = "#0000ff";
          break;
        case 'Indígena':
          color = "#ff0000";
          break;
        case 'Amarela':
          color = "#ffff00";
          break;

        default:
          console.log('not found');
      }
      //console.log(color);

      dataSet.push(
        {
        'type':response.data[i].cor_raca,
        'percent':response.data[i].total_raca,
        'color':color,
        'subs':[{
          'type':response.data[i].mais_10_label,
          'percent':response.data[i].mais_10,
        },{
          'type':response.data[i].menos_10_label,
          'percent':response.data[i].menos_10,
        }],
        }
    );
    };
    //console.log('dataSet',dataSet);

    // Create chart instance
    var chart = am4core.create("dias_sintoma_mais_menos_dez_dias", am4charts.PieChart);

    // Set data
    var selected;
    var types = dataSet;
    /*var types = [{
      type: "Negra", //raca_cor
      percent: 129,//total_raca
      color: "#000000",
      subs: [{
        type: "Mais de dez dias", //mais_10_label
        percent: 23 //mais_10
      }, {
        type: "Menos de dez dias", //menos_10_label
        percent: 106 //menos_10
      }]
    }, {
      type: "Branca",
      percent: 96,
      color: "#d3d3d3",
      subs: [{
        type: "Mais de dez dias",
        percent: 18
      }, {
        type: "Menos de dez dias",
        percent: 78
      }]
    }, {
      type: "Sem info.",
      percent: 5,
      color: "#0000ff",
      subs: [{
        type: "Mais de dez dias",
        percent: 0
      }, {
        type: "Menos de dez dias",
        percent: 5
      },]
    }, {
      type: "Indígena",
      percent: 0,
      color: "#ff0000",
      subs: [{
        type: "Mais de dez dias",
        percent: 0
      }, {
        type: "Menos de dez dias",
        percent: 0
      },]
    }, {
      type: "Amarela",
      percent: 0,
      color: "#ffff00",
      subs: [{
        type: "Mais de dez dias",
        percent: 0
      }, {
        type: "Menos de dez dias",
        percent: 0
      }]
    }];*/

    // Add data
    chart.data = generateChartData();

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "percent";
    pieSeries.dataFields.category = "type";
    pieSeries.slices.template.propertyFields.fill = "color";
    pieSeries.slices.template.propertyFields.isActive = "pulled";
    pieSeries.slices.template.strokeWidth = 0;

    function generateChartData() {
      var chartData = [];
      for (var i = 0; i < types.length; i++) {
        if (i == selected) {
          for (var x = 0; x < types[i].subs.length; x++) {
            chartData.push({
              type: types[i].subs[x].type,
              percent: types[i].subs[x].percent,
              color: types[i].color,
              pulled: true
            });
          }
        } else {
          chartData.push({
            type: types[i].type,
            percent: types[i].percent,
            color: types[i].color,
            id: i
          });
        }
      }
      return chartData;
    }

    pieSeries.slices.template.events.on("hit", function(event) {
      if (event.target.dataItem.dataContext.id != undefined) {
        selected = event.target.dataItem.dataContext.id;
      } else {
        selected = undefined;
      }
      chart.data = generateChartData();
    });
  });
//DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM
});
</script>
@endsection
