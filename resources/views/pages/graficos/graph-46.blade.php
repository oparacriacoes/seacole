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
              <div>ACÚMULO DE SINTOMAS</div>
          </div>
      </div>
  </div>
  <x-chart-list/>
  <div class="row">
    <!-- ACÚMULO DE SINTOMAS - INÍCIO (GRÁFICO 46) -->
    <div class="col">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                      ACÚMULO DE SINTOMAS
                </div>
            </div>
            <div class="card-body">
              <div class="chart" id="acumulo_sintomas"></div>
            </div>
        </div>
    </div>
    <!-- ACÚMULO DE SINTOMAS - FIM -->
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

//ACÚMULO DE SINTOMAS - INÍCIO
axios.get('/admin/chart/acumulo_sintomas')
  .then(response => {
    console.log(response.data);
    let dataSet = {};
    for(var i=0;i<response.data.length;i++){
      //console.log(response.data[i]);
      dataSet[response.data[i].quantidade_sintomas] = {
        'Branco':response.data[i].branca,
        'Indígena':response.data[i].indigena,
        'Amarelo':response.data[i].amarela,
        'Negro':response.data[i].negro,
        'Não info.':response.data[i].nao_info,
      }
    };
    //console.log('dataSet',dataSet);

    // Create chart instance
    var chart = am4core.create("acumulo_sintomas", am4charts.XYChart);

    // Add data
    chart.data = response.data;
    /*chart.data = [ {
      "quantidade_sintomas": "1",
      "confirmado_leve": 315,
      "confirmado_grave": 30,
      "descartado_leve": 18,
      "descartado_grave": 6,
      "suspeito_leve": 324,
      "suspeito_grave": 11
    }, {
      "quantidade_sintomas": "2",
      "confirmado_leve": 141,
      "confirmado_grave": 38,
      "descartado_leve": 19,
      "descartado_grave": 0,
      "suspeito_leve": 184,
      "suspeito_grave": 9
    }, {
      "quantidade_sintomas": "3",
      "confirmado_leve": 71,
      "confirmado_grave": 18,
      "descartado_leve": 4,
      "descartado_grave": 0,
      "suspeito_leve": 64,
      "suspeito_grave": 2
    }, {
      "quantidade_sintomas": "4",
      "confirmado_leve": 40,
      "confirmado_grave": 0,
      "descartado_leve": 1,
      "descartado_grave": 0,
      "suspeito_leve": 32,
      "suspeito_grave": 5
    } , {
      "quantidade_sintomas": "5",
      "confirmado_leve": 9,
      "confirmado_grave": 0,
      "descartado_leve": 0,
      "descartado_grave": 0,
      "suspeito_leve": 4,
      "suspeito_grave": 1
    } , {
      "quantidade_sintomas": "6",
      "confirmado_leve": 2,
      "confirmado_grave": 0,
      "descartado_leve": 0,
      "descartado_grave": 0,
      "suspeito_leve": 0,
      "suspeito_grave": 1
    } , {
      "quantidade_sintomas": "Não info.",
      "confirmado_leve": 220,
      "confirmado_grave": 45,
      "descartado_leve": 13,
      "descartado_grave": 0,
      "suspeito_leve": 145,
      "suspeito_grave": 27
    }  ];*/

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "quantidade_sintomas";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.cellStartLocation = 0.1;
    categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;

    // Create series
    function createSeries(field, name, stacked) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "quantidade_sintomas";
      series.name = name;
      series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
      series.stacked = stacked;
      series.columns.template.width = am4core.percent(95);
    }

    createSeries("confirmado_leve", "Confirmado leve", false);
    createSeries("confirmado_grave", "Confirmado grave", false);
    createSeries("descartado_leve", "Descartado leve", false);
    createSeries("descartado_grave", "Descartado grave", false);
    createSeries("suspeito_leve", "Suspeito grave", false);
    createSeries("suspeito_grave", "Suspeito grave", false);

    // Add legend
    chart.legend = new am4charts.Legend();
//ACÚMULO DE SINTOMAS - FIM
  });
});
</script>
@endsection
