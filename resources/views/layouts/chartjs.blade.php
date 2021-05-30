<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script>

<script type="text/javascript">
    Chart.plugins.register(ChartDataLabels);
    Chart.plugins.register({
        beforeDraw: function(c) {
            var ctx = c.chart.ctx;
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, c.chart.width, c.chart.height);
        }
    })

    $('#btn_download_chart').click((e) => {
        var url_base64jp = document.getElementById("chartjs").toDataURL("image/png", 1.0);
        e.currentTarget.href = url_base64jp
    })

    const CHARTJS_CONFIG = {
        datalabels_default: {
            backgroundColor: 'rgb(75, 192, 192)',
            borderRadius: 3,
            color: 'white',
            font: {
                weight: 'bold'
            },
            formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
            padding: 3
        }
    }

</script>
