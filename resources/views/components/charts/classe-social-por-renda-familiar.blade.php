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
                text: 'CLASSE SOCIAL POR RENDA BRUTA FAMILIAR',
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
                    stacked: true
                }]
            },
            plugins: {
                datalabels: {
                    borderRadius: 4,
                    color: 'white',
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
