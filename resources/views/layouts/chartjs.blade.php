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
        DEFAULT_OPTIONS: {
            title: {
                text: '',
                display: true,
                position: 'top'
            },
            legend: {
                position: 'bottom'
            },
        },
        STACKED_OPTIONS: {
            title: {
                text: '',
                display: true,
                position: 'top'
            },
            legend: {
                position: 'bottom'
            },
            scales: {
                yAxes: [{
                    stacked: true
                }],
                xAxes: [{
                    stacked: true
                }]
            }
        },
        DATALABEL: {
            DEFAULT: {
                font: {
                    weight: 'bold'
                },
                color: 'white',
                padding: 2,
                backgroundColor: 'rgb(75, 192, 192)',
                borderRadius: 3,
                formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                display: function(context) {
                    return context.dataset.data[context.dataIndex] > 0 ? 'auto' : false;
                },
            },
            PERCENTUAL: {
                font: {
                    weight: 'bold'
                },
                color: 'white',
                padding: 2,
                borderRadius: 3,
                backgroundColor: 'rgb(75, 192, 192)',
                formatter: (value, ctx) => {
                    let sum = ctx.dataset._meta[0].total;
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
                display: function(context) {
                    return context.dataset.data[context.dataIndex] > 0 ? 'auto' : false;
                },
            }
        }
    }

</script>
