<script src="{{asset('js/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('js/chartjs/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{asset('js/chartjs/chartjs-plugin-colorschemes.js')}}"></script>

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

    const STACKED_RACE_OPTIONS = (labels = [], sublabels = []) => {
        let xAxesLabels = []

        sublabels.forEach((index) => {
            xAxesLabels = xAxesLabels.concat(labels)
        })


        return {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            scales: {
                xAxes: [{
                        id: 'labels',
                        labels: xAxesLabels
                    },
                    {
                        id: 'sublabels',
                        type: 'category',
                        offset: true,
                        gridLines: {
                            offsetGridLines: true,
                            lineWidth: 2
                        },
                        labels: sublabels
                    },
                ]
            }
        }
    }

</script>
