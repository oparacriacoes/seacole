<script type="text/javascript">
    const chart_data = @json($chart_data);

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chart_data.labels,
            datasets: chart_data.datasets,
        },
        options: {
            title: {
                display: true,
                text: 'FAIXA ETÁRIA POR GÊNERO',
                position: 'top'
            },
            legend: {
                position: 'bottom',
            },
            scales: {
                yAxes: [{
                    stacked: true
                }],
                xAxes: [{
                    stacked: false
                }]
            },
            plugins: {
                datalabels: {
                    borderRadius: 1,
                    color: 'black',
                    font: {
                        weight: 'normal'
                    },
                    padding: 2,
                    formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                }
            }
        }
    });
</script>
