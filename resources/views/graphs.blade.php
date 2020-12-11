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
                    <div>Gráficos
                        <!--<div class="page-title-subheading">This is an example dashboard created using build-in elements and components.</div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- CASOS MONITORADOS - INÍCIO (GRÁFICO 1) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            NOVOS CASOS MONITORADOS
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="novos_casos_monitorados"></div>
                    </div>
                </div>
            </div>
            <!-- CASOS MONITORADOS - FIM -->

            <!-- MONITORADOS X EXCLUSIVO PSICOLOGIA - INÍCIO (GRÁFICO 2) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              MONITORADOS X EXCLUSIVO PSICOLOGIA
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="monitorados_exclusivo_psicologia"></div>
                    </div>
                </div>
            </div>
            <!-- MONITORADOS X EXCLUSIVO PSICOLOGIA - FIM -->

            <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS - INÍCIO (GRÁFICO 3) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              SITUAÇÃO TOTAL DE CASOS MONITORADOS
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="situacao_total_casos_monitorados"></div>
                    </div>
                </div>
            </div>
            <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM -->

            <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS 1 - INÍCIO (GRÁFICO 4) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              SITUAÇÃO TOTAL DE CASOS MONITORADOS
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="situacao_total_casos_monitorados_1"></div>
                    </div>
                </div>
            </div>
            <!-- SITUAÇÃO TOTAL DE CASOS MONITORADOS 1 - FIM -->

            <!-- CASOS MONITORADOS POR CIDADE - INÍCIO (GRÁFICO 5) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              CASOS MONITORADOS POR CIDADE
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="casos_monitorados_por_cidade" style="height:700px !important"></div>
                    </div>
                </div>
            </div>
            <!-- CASOS MONITORADOS POR CIDADE - FIM -->

            <!-- RAÇA COR GERAL - INÍCIO (GRÁFICO 6) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              RAÇA-COR GERAL DAS PESSOAS ATENDIDAS
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="raca_cor_geral" style="height:700px !important"></div>
                      <div class="text-center"><p id="legenda"></p></div>
                    </div>
                </div>
            </div>
            <!-- RAÇA COR GERAL - FIM -->

            <!-- GENERO POR RAÇA-COR - INÍCIO (GRÁFICO 7) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              GÊNERO POR RAÇA-COR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="genero_por_raca_cor"></div>
                      <div class="text-center"><p id="legenda_genero_por_raca_cor"></p></div>
                    </div>
                </div>
            </div>
            <!-- GENERO POR RAÇA-COR - FIM -->

            <!-- FAIXA ETÁRIA POR GÊNERO - INÍCIO (GRÁFICO 8) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              FAIXA ETÁRIA POR GÊNERO
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="faixa_etaria_genero"></div>
                    </div>
                </div>
            </div>
            <!-- FAIXA ETÁRIA POR GÊNERO - FIM -->

            <!-- FAIXA ETÁRIA POR GÊNERO 2 - INÍCIO (GRÁFICO 9) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              FAIXA ETÁRIA POR GÊNERO
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="faixa_etaria_genero_2"></div>
                    </div>
                </div>
            </div>
            <!-- FAIXA ETÁRIA POR GÊNERO 2 - FIM -->

            <!-- FAIXA ETÁRIA POR RAÇA/COR - INÍCIO (GRÁFICO 10) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              FAIXA ETÁRIA POR RAÇA/COR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="faixa_etaria_raca_cor"></div>
                    </div>
                </div>
            </div>
            <!-- FAIXA ETÁRIA POR RAÇA/COR - FIM -->

            <!-- NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR - INÍCIO (GRÁFICO 11) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="numero_pessoas_residencia_raca_cor"></div>
                    </div>
                </div>
            </div>
            <!-- NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR - FIM -->

            <!-- CLASSE SOCIAL RENDA BRUTA FAMILIAR - INÍCIO (GRÁFICO 12) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              CLASSE SOCIAL POR RENDA BRUTA FAMILIAR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="classe_social_renda_bruta_familiar"></div>
                    </div>
                </div>
            </div>
            <!-- CLASSE SOCIAL RENDA BRUTA FAMILIAR - FIM -->

            <!-- CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR - INÍCIO (GRÁFICO 13_1) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="classe_social_renda_per_capta_raca_cor"></div>
                    </div>
                </div>
            </div>
            <!-- CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR - FIM -->

            <!-- RAÇA/COR POR AUXÍLIO EMERGENCIAL - INÍCIO (GRÁFICO 13_2) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              RAÇA/COR POR AUXÍLIO EMERGENCIAL
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="raca_cor_por_auxilio_emergencial"></div>
                    </div>
                </div>
            </div>
            <!-- RAÇA/COR POR AUXÍLIO EMERGENCIAL - FIM -->

            <!-- INSUMOS OFERECIDOS PELO PROJETO - INÍCIO (GRÁFICO 14) -->
            <div class="col-md-12 col-lg-6">
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

            <!-- TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO - INÍCIO (GRÁFICO 17) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="tratamento_prescrito_por_medico_projeto"></div>
                    </div>
                </div>
            </div>
            <!-- TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO - FIM -->

            <!-- TRATAMENTO FINANCIADO - INÍCIO (GRÁFICO 18) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              TRATAMENTO FINANCIADO
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="tratamento_financiado"></div>
                    </div>
                </div>
            </div>
            <!-- TRATAMENTO FINANCIADO - FIM -->

            <!-- DIAS DE SINTOMAS POR RAÇA/COR - INÍCIO (GRÁFICO 19) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              DIAS DE SINTOMAS POR RAÇA/COR
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="dias_sintoma_por_raca_cor"></div>
                    </div>
                </div>
            </div>
            <!-- DIAS DE SINTOMAS POR RAÇA/COR - FIM -->

            <!-- DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO (GRÁFICO 20) -->
            <div class="col-md-12 col-lg-6">
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

            <!-- TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - INÍCIO (GRÁFICO 21) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19)
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="total_dias_monitoramento_relacao_covid"></div>
                    </div>
                </div>
            </div>
            <!-- TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - FIM -->

            <!-- CASOS MONITORADOS POR AGENTES - INÍCIO (GRÁFICO 22) -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                              CASOS MONITORADOS POR AGENTES
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="chart" id="casos_monitorados_por_agente"></div>
                    </div>
                </div>
            </div>
            <!-- CASOS MONITORADOS POR AGENTES - INÍCIO - FIM -->

            <!-- CASOS AVALIADOS POR EQUIPE MÉDICA - INÍCIO (GRÁFICO 23) -->
            <div class="col-md-12 col-lg-6">
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

            <!-- ACOMPANHAMENTO PSICOLÓGICO - INÍCIO (GRÁFICO 24) -->
            <div class="col-md-12 col-lg-6">
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

//NOVOS CASOS MONITORADOS - INÍCIO
axios.get('/chart/novos_casos_monitorados')
    .then(response => {
        // Create chart instance
        var chart = am4core.create("novos_casos_monitorados", am4charts.XYChart);
        chart.language.locale = am4lang_pt_BR;
        chart.dateFormatter.language = new am4core.Language();
        chart.dateFormatter.language.locale = am4lang_pt_BR;
        chart.data = response.data;
        //console.log(chart.data);

        // Set input format for the dates
        chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "value";
        series.dataFields.dateX = "date";
        series.tooltipText = "{value}"
        series.strokeWidth = 2;
        series.minBulletDistance = 15;

        // Drop-shaped tooltips
        series.tooltip.background.cornerRadius = 20;
        series.tooltip.background.strokeOpacity = 0;
        series.tooltip.pointerOrientation = "vertical";
        series.tooltip.label.minWidth = 40;
        series.tooltip.label.minHeight = 40;
        series.tooltip.label.textAlign = "middle";
        series.tooltip.label.textValign = "middle";

        // Make bullets grow on hover
        var bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.strokeWidth = 2;
        bullet.circle.radius = 4;
        bullet.circle.fill = am4core.color("#fff");

        var bullethover = bullet.states.create("hover");
        bullethover.properties.scale = 1.3;

        // Make a panning cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panXY";
        chart.cursor.xAxis = dateAxis;
        chart.cursor.snapToSeries = series;
    });
    //NOVOS CASOS MONITORADOS - FIM

    //MONITORADOS_EXCLUSIVO_PSICOLOGIA - INICIO
    axios.get('/chart/monitorados_exclusivo_psicologia')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("monitorados_exclusivo_psicologia", am4charts.PieChart);

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "monitoramento";

        // Let's cut a hole in our Pie chart the size of 30% the radius
        chart.innerRadius = am4core.percent(30);

        // Put a thick white border around each Slice
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.slices.template
          // change the cursor on hover to make it apparent the object can be interacted with
          .cursorOverStyle = [
            {
              "property": "cursor",
              "value": "pointer"
            }
          ];

        pieSeries.alignLabels = false;
        pieSeries.labels.template.bent = true;
        pieSeries.labels.template.radius = 3;
        pieSeries.labels.template.padding(0,0,0,0);

        pieSeries.ticks.template.disabled = true;

        // Create a base filter effect (as if it's not there) for the hover to return to
        var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
        shadow.opacity = 0;

        // Create hover state
        var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

        // Slightly shift the shadow and make it more prominent on hover
        var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
        hoverShadow.opacity = 0.7;
        hoverShadow.blur = 5;

        // Add a legend
        chart.legend = new am4charts.Legend();

        chart.data = response.data;
      });
    //MONITORADOS_EXCLUSIVO_PSICOLOGIA - FIM

    //SITUAÇÃO TOTAL DE CASOS MONITORADOS - INÍCIO
    axios.get('/chart/situacao_total_casos_monitorados')
      .then(response => {
        console.log(response.data[0]);
        var chart = am4core.create("situacao_total_casos_monitorados", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data[0];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade_casos";
        series.dataFields.category = "situacao";
      });
    //SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM

    //SITUAÇÃO TOTAL DE CASOS MONITORADOS - INÍCIO
    axios.get('/chart/situacao_total_casos_monitorados_1')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("situacao_total_casos_monitorados_1", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

        // Add data
        chart.data = response.data;

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "situacao";

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "quantidade";
        series.dataFields.categoryX = "situacao";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        });

        // Cursor
        chart.cursor = new am4charts.XYCursor();
      });
    //SITUAÇÃO TOTAL DE CASOS MONITORADOS - FIM

    //CASOS MONITORADOS POR CIDADE - INICIO
    axios.get('/chart/casos_monitorados_por_cidade')
      .then(response => {
        //console.log(response.data);
        var chart = am4core.create("casos_monitorados_por_cidade", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data;

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade";
        series.dataFields.category = "endereco_cidade";
      });
    //CASOS MONITORADOS POR CIDADE - FIM

    //RAÇA COR GERAL - INÍCIO
    axios.get('/chart/raca_cor_geral')
      .then(response => {
        //console.log(response.data[0]);
        am4core.useTheme(am4themes_myTheme);
        function am4themes_myTheme(target) {
          if (target instanceof am4core.ColorSet) {
            target.list = [
              am4core.color("#d3d3d3"),//cinza
              am4core.color("#000000"),//preto
              am4core.color("#8b4513"),//marrom
              am4core.color("#0000ff"),//azul
              am4core.color("#ff0000"),//vermelho
              am4core.color("#ffff00")//amarelo
            ];
          }
        }
        var chart = am4core.create("raca_cor_geral", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data[0];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade";
        series.dataFields.category = "cor_raca";
        $('#legenda').text(response.data[1][0].legenda);
      });
    //RAÇA COR GERAL - FIM

    //GENERO POR RAÇA-COR - INÍCIO
    axios.get('/chart/genero_por_raca_cor')
      .then(response => {
        //console.log(response.data);
        function am4themes_myTheme(target) {
          if (target instanceof am4core.ColorSet) {
            target.list = [
              am4core.color("#000000"),
              am4core.color("#8b4513"),
              am4core.color("#d3d3d3"),
              am4core.color("#ffff00"),
              am4core.color("#ff0000"),
              am4core.color("#0000ff")
            ];
          }
        }
        am4core.useTheme(am4themes_myTheme);
        // Create chart instance
        var chart = am4core.create("genero_por_raca_cor", am4charts.XYChart3D);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "identidade_genero";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.title.text = "São 147 mulheres cis e 64 homens cis de Raça Negra (Preta + Parda)";

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
          series.dataFields.categoryX = "identidade_genero";
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
      });
    //GENERO POR RAÇA-COR - FIM

    //FAIXA ETÁRIA POR GÊNERO - INÍCIO
    axios.get('/chart/faixa_etaria_genero')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("faixa_etaria_genero", am4charts.XYChart);

        // Add data
        chart.data = response.data;

        // Use only absolute numbers
        chart.numberFormatter.numberFormat = "#.#s";

        // Create axes
        var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "idade";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.inversed = true;

        var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
        valueAxis.extraMin = 0.1;
        valueAxis.extraMax = 0.1;
        valueAxis.renderer.minGridDistance = 40;
        valueAxis.renderer.ticks.template.length = 5;
        valueAxis.renderer.ticks.template.disabled = false;
        valueAxis.renderer.ticks.template.strokeOpacity = 0.4;
        valueAxis.renderer.labels.template.adapter.add("text", function(text) {
          return text == "homens" || text == "mulheres" ? text : text;
        })

        // Create series
        var homens = chart.series.push(new am4charts.ColumnSeries());
        homens.dataFields.valueX = "homens";
        homens.dataFields.categoryY = "idade";
        homens.clustered = false;

        var homensLabel = homens.bullets.push(new am4charts.LabelBullet());
        homensLabel.label.text = "{valueX}";
        homensLabel.label.hideOversized = false;
        homensLabel.label.truncate = false;
        homensLabel.label.horizontalCenter = "right";
        homensLabel.label.dx = -10;

        var mulheres = chart.series.push(new am4charts.ColumnSeries());
        mulheres.dataFields.valueX = "mulheres";
        mulheres.dataFields.categoryY = "idade";
        mulheres.clustered = false;

        var mulheresLabel = mulheres.bullets.push(new am4charts.LabelBullet());
        mulheresLabel.label.text = "{valueX}";
        mulheresLabel.label.hideOversized = false;
        mulheresLabel.label.truncate = false;
        mulheresLabel.label.horizontalCenter = "left";
        mulheresLabel.label.dx = 10;

        var homensRange = valueAxis.axisRanges.create();
        homensRange.value = -10;
        homensRange.endValue = 0;
        homensRange.label.text = "Homens";
        homensRange.label.fill = chart.colors.list[0];
        homensRange.label.dy = 20;
        homensRange.label.fontWeight = '600';
        homensRange.grid.strokeOpacity = 1;
        homensRange.grid.stroke = homens.stroke;

        var mulheresRange = valueAxis.axisRanges.create();
        mulheresRange.value = 0;
        mulheresRange.endValue = 10;
        mulheresRange.label.text = "Mulheres";
        mulheresRange.label.fill = chart.colors.list[1];
        mulheresRange.label.dy = 20;
        mulheresRange.label.fontWeight = '600';
        mulheresRange.grid.strokeOpacity = 1;
        mulheresRange.grid.stroke = mulheres.stroke;
      });
    //FAIXA ETÁRIA POR GÊNERO - FIM

    //FAIXA ETÁRIA POR GÊNERO 2 - INÍCIO
    axios.get('/chart/faixa_etaria_genero_2')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("faixa_etaria_genero_2", am4charts.XYChart3D);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "idade";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

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
          series.dataFields.categoryX = "idade";
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

        createSeries("homens", "Homens");
        createSeries("mulheres", "Mulheres");
        createSeries("sem_informacao", "Sem informação");

        // Legend
        chart.legend = new am4charts.Legend();
      });
    //FAIXA ETÁRIA POR GÊNERO 2 - FIM

    //FAIXA ETÁRIA POR RAÇA/COR - INÍCIO
    axios.get('/chart/faixa_etaria_raca_cor')
      .then(response => {
        //console.log(response.data[1][0].legenda);
        function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
          target.list = [
            am4core.color("#000000"),
            am4core.color("#8b4513"),
            am4core.color("#d3d3d3"),
            am4core.color("#ffff00"),
            am4core.color("#ff0000"),
            am4core.color("#0000ff")
          ];
        }
      }
      am4core.useTheme(am4themes_myTheme);
      // Create chart instance
      var chart = am4core.create("faixa_etaria_raca_cor", am4charts.XYChart3D);


      // Add data
      chart.data = response.data[0];

      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "faixa_idade";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.title.text = response.data[1][0].legenda;

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
        series.dataFields.categoryX = "faixa_idade";
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
      });
    //FAIXA ETÁRIA POR RAÇA/COR - FIM

    //NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR - INÍCIO
    axios.get('/chart/numero_pessoas_residencia_raca_cor')
      .then(response => {
        //console.log(response.data[1][0].legenda);
        function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
          target.list = [
            am4core.color("#000000"),
            am4core.color("#8b4513"),
            am4core.color("#d3d3d3"),
            am4core.color("#ffff00"),
            am4core.color("#ff0000"),
            am4core.color("#0000ff")
          ];
        }
      }
      am4core.useTheme(am4themes_myTheme);
      // Create chart instance
      var chart = am4core.create("numero_pessoas_residencia_raca_cor", am4charts.XYChart3D);


      // Add data
      chart.data = response.data[0];

      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "numero_pessoas_residencia";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.title.text = response.data[1][0].legenda;

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
        series.dataFields.categoryX = "numero_pessoas_residencia";
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
      });
    //NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR - FIM

    //CLASSE SOCIAL RENDA BRUTA FAMILIAR - INÍCIO
    axios.get('/chart/classe_social_renda_bruta_familiar')
      .then(response => {
        //console.log(response.data);
        function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
          target.list = [
            am4core.color("#000000"),
            am4core.color("#8b4513"),
            am4core.color("#d3d3d3"),
            am4core.color("#ffff00"),
            am4core.color("#ff0000"),
            am4core.color("#0000ff")
          ];
        }
      }
      am4core.useTheme(am4themes_myTheme);
      // Create chart instance
      var chart = am4core.create("classe_social_renda_bruta_familiar", am4charts.XYChart3D);

      // Add data
      chart.data = response.data[0];

      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "renda_residencia";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.title.text = response.data[1][0].legenda;

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
        series.dataFields.categoryX = "renda_residencia";
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
      });
    //CLASSE SOCIAL RENDA BRUTA FAMILIAR - FIM

    //CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR - INÍCIO
    axios.get('/chart/classe_social_renda_per_capta_raca_cor')
      .then(response => {
        //console.log(response.data);
        function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
          target.list = [
            am4core.color("#000000"),
            am4core.color("#8b4513"),
            am4core.color("#d3d3d3"),
            am4core.color("#ffff00"),
            am4core.color("#ff0000"),
            am4core.color("#0000ff")
          ];
        }
      }
      am4core.useTheme(am4themes_myTheme);
      // Create chart instance
      var chart = am4core.create("classe_social_renda_per_capta_raca_cor", am4charts.XYChart3D);

      // Add data
      chart.data = response.data[0];

      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "renda_residencia";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.title.text = response.data[1][0].legenda;

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
        series.dataFields.categoryX = "renda_residencia";
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
      });
    //CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR - FIM

    //RAÇA/COR POR AUXÍLIO EMERGENCIAL - INÍCIO
    axios.get('/chart/raca_cor_por_auxilio_emergencial')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("raca_cor_por_auxilio_emergencial", am4charts.XYChart);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "cor_raca";
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
          series.dataFields.categoryX = "cor_raca";
          series.name = name;
          series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
          series.stacked = stacked;
          series.columns.template.width = am4core.percent(95);
        }

        createSeries("sim", "sim", true);
        createSeries("nao", "Não", true);
        createSeries("sim_preta", "Preta sim", true);
        createSeries("nao_preta", "Preta não", true);
        createSeries("sim_parda", "Parda sim", true);
        createSeries("nao_parda", "Parda não", true);

        // Add legend
        chart.legend = new am4charts.Legend();
      });
    //RAÇA/COR POR AUXÍLIO EMERGENCIAL - FIM

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

    //TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO - INÍCIO
    axios.get('/chart/tratamento_prescrito_por_medico_projeto')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("tratamento_prescrito_por_medico_projeto", am4charts.XYChart);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "cor_raca";
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
          series.dataFields.categoryX = "cor_raca";
          series.name = name;
          series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
          series.stacked = stacked;
          series.columns.template.width = am4core.percent(95);
        }

        createSeries("sim", "sim", true);
        createSeries("nao", "Não", true);
        createSeries("sim_preta", "Preta sim", true);
        createSeries("nao_preta", "Preta não", true);
        createSeries("sim_parda", "Parda sim", true);
        createSeries("nao_parda", "Parda não", true);

        // Add legend
        chart.legend = new am4charts.Legend();
      });
    //TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO - FIM

    //TRATAMENTO FINANCIADO - INÍCIO
    axios.get('/chart/tratamento_financiado')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("tratamento_financiado", am4charts.XYChart);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "cor_raca";
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
          series.dataFields.categoryX = "cor_raca";
          series.name = name;
          series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
          series.stacked = stacked;
          series.columns.template.width = am4core.percent(95);
        }

        createSeries("sim", "sim", true);
        createSeries("nao", "Não", true);
        createSeries("sim_preta", "Preta sim", true);
        createSeries("nao_preta", "Preta não", true);
        createSeries("sim_parda", "Parda sim", true);
        createSeries("nao_parda", "Parda não", true);

        // Add legend
        chart.legend = new am4charts.Legend();
      });
    //TRATAMENTO FINANCIADO - FIM

    //DIAS DE SINTOMAS POR RAÇA/COR - INÍCIO
    axios.get('/chart/dias_sintoma_por_raca_cor')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("dias_sintoma_por_raca_cor", am4charts.XYChart3D);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "dias";
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
          series.dataFields.categoryX = "dias";
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
      });
    //DIAS DE SINTOMAS POR RAÇA/COR - FIM

    //DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - INÍCIO
    axios.get('/chart/dias_sintoma_mais_menos_dez_dias')
      .then(response => {
        //console.log(response.data);
        // Create chart instance
        var chart = am4core.create("dias_sintoma_mais_menos_dez_dias", am4charts.XYChart);

        // Add data
        chart.data = response.data[0];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "cor_raca";
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
          series.dataFields.categoryX = "cor_raca";
          series.name = name;
          series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
          series.stacked = stacked;
          series.columns.template.width = am4core.percent(95);
        }

        createSeries("mais_10", "Mais de 10 dias", true);
        createSeries("menos_10", "Menos de 10 dias", true);
        createSeries("mais_10_preta", "Preta Mais de 10 dias", true);
        createSeries("menos_10_preta", "Preta Menos de 10 dias", true);
        createSeries("mais_10_parda", "Parda Mais de 10 dias", true);
        createSeries("menos_10_parda", "Parda Menos de 10 dias", true);

        // Add legend
        chart.legend = new am4charts.Legend();
      });
    //DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS - FIM

    //TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - INÍCIO
    axios.get('/chart/total_dias_monitoramento_relacao_covid')
      .then(response => {
        //console.log(response.data);
        function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
          target.list = [
            am4core.color("#000000"),
            am4core.color("#8b4513"),
            am4core.color("#d3d3d3"),
            am4core.color("#ffff00"),
            am4core.color("#ff0000"),
            am4core.color("#0000ff")
          ];
        }
      }
      am4core.useTheme(am4themes_myTheme);
      // Create chart instance
      var chart = am4core.create("total_dias_monitoramento_relacao_covid", am4charts.XYChart3D);

      // Add data
      chart.data = response.data[0];

      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "dias";
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
        series.dataFields.categoryX = "dias";
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
      });
    //TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19) - FIM

    //CASOS MONITORADOS POR AGENTES - INÍCIO
    axios.get('/chart/casos_monitorados_por_agente')
      .then(response => {
        //console.log(response.data);
        var chart = am4core.create("casos_monitorados_por_agente", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data[0];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade_pacientes";
        series.dataFields.category = "nome_agente";
      });
    //CASOS MONITORADOS POR AGENTES - FIM

    //CASOS AVALIADOS POR EQUIPE MÉDICA - INÍCIO
    axios.get('/chart/casos_avaliados_equipe_medica')
      .then(response => {
        //console.log(response.data);
        var chart = am4core.create("casos_avaliados_equipe_medica", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data[0];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade_pacientes";
        series.dataFields.category = "medicos";
      });
    //CASOS AVALIADOS POR EQUIPE MÉDICA - FIM'

    //ACOMPANHAMENTO PSICOLÓGICO - INÍCIO
    axios.get('/chart/acompanhamento_psicologico')
      .then(response => {
        //console.log(response.data);
        var chart = am4core.create("acompanhamento_psicologico", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = response.data[0];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "quantidade_pacientes";
        series.dataFields.category = "psicologo";
      });
    //ACOMPANHAMENTO PSICOLÓGICO - FIM



}); // end am4core.ready()
</script>
@endsection
