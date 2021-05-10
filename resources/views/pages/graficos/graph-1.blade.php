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
                    <i class="fas fa-user text-primary"></i>
                </div>
                <div>Novos Casos Monitorados</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        Novos Casos Monitorados
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" id="novos_casos_monitorados"></div>
                </div>
            </div>
        </div>
    </div>
    <x-chart-list />
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
        axios.get('/admin/chart/novos_casos_monitorados')
            .then(response => {
                console.log(response.data);
                // Create chart instance
                var chart = am4core.create("novos_casos_monitorados", am4charts.XYChart);
                chart.language.locale = am4lang_pt_BR;
                chart.dateFormatter.language = new am4core.Language();
                chart.dateFormatter.language.locale = am4lang_pt_BR;
                chart.data = response.data;
                //console.log(chart.data);
                // Set input format for the dates
                chart.dateFormatter.inputDateFormat = "yyyy-MM";
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
    });
</script>
@endsection
