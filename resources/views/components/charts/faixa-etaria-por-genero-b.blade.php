<script type="text/javascript">
    const chart_data = @json($chart_data);

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
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
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            },
            plugins: {
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'normal'
                    },
                    formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                }
            }
        }
    });
</script>
