<script type="text/javascript">
    const chart_data = @json($chart_data);

    for(let dataset of chart_data.datasets) {
        dataset.backgroundColor = peopleColor(dataset.label)
    }

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
                text: 'DIAS DE SINTOMAS POR RAÇA/COR',
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
